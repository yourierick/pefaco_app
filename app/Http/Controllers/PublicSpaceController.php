<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BulletinInfo;
use App\Models\ConfigurationGenerale;
use App\Models\messageEtCommentaire;
use App\Models\ProgrammeDuPasteur;
use App\Models\Communique;
use App\Models\Articles;
use App\Models\Annonce;
use App\Models\Membre;
use App\Models\Enseignement;
use App\Models\ProgrammeDeCulte;

class PublicSpaceController extends Controller
{
    public function home()
    {
        $parametres = ConfigurationGenerale::first();
        $programmedeculte = ProgrammeDeCulte::all();
        $programmedupasteur = ProgrammeDuPasteur::all();
        $articles = Articles::where('statut', 'validé')->where('audience', 'public')->orderBy('id', 'desc')->get();
        $lastest_articles = [];
        $latestarticle = $articles->first();
        for ($i = 0; $i < $articles->count(); $i++) {
            if ($i < 3) {
                $lastest_articles[] = $articles[$i];
            }else {
                break;
            }
        }
        $articles = $lastest_articles;
        $annonces = Annonce::where('statut', 'validé')->where('audience', 'public')->orderBy('id', 'desc')->get();
        $communiques = Communique::with('communiquant')->where('audience', 'public')->orderBy('id', 'desc')->get();
        $serviteurs = Membre::where('statut', 'serviteur')->where('etat', 'en service')->get();
        $enseignements = Enseignement::with('auteur')->where('statut', 'validé')->where('audience', 'public')->orderBy('id', 'desc')->get();
        $latestenseignements = [];
        for ($i = 0; $i < $enseignements->count(); $i++) {
            if ($i < 3) {
                $latestenseignements[] = $enseignements[$i];
            }else {
                break;
            }
        }

        $enseignements = $latestenseignements;
        
        return view('public_layouts.index', compact('parametres', 'programmedeculte', 'enseignements',
        'programmedupasteur', 'articles', 'latestarticle', 'annonces', 'communiques', 'serviteurs'));
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

        $message = "merci pour votre message";

        return redirect()->back()->with('success', $message);
    }
}
