<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BulletinInfo;
use App\Models\ConfigurationGenerale;
use App\Models\messageEtCommentaire;

class PublicSpaceController extends Controller
{
    public function home()
    {
        $parametres = ConfigurationGenerale::first();
        return view('public_layouts.index', compact('parametres'));
    }

    public function subscribeToNewsLetter(Request $request) {
        $request->validate([
            'email'
        ]);

        $scan = BulletinInfo::where('email', $request->get('email'))->get();
        if (!$scan->isEmpty()) {
            return redirect()->back()->with('error', "cette adresse mail est déjà inscrite au bulletin d'information");
        }else {
            $subscriber = BulletinInfo::create([
                'email'=>$request->get('email'),
            ]);
        }

        return redirect()->back()->with('success', 'merci pour votre souscription');
    }

    public function messageEtCommentaire(Request $request) {
        $request->validate([
            'email',
            'nom',
            'telephone',
            'message',
        ]);

        $message_commentaire = messageEtCommentaire::create([
            'email'=>$request->get('email'),
            'nom'=>$request->get('nom'),
            'telephone'=>$request->get('telephone'),
            'message'=>$request->get('message'),
        ]);

        $message = ["success", "merci pour votre message"];

        return redirect()->back()->with();
    }
}
