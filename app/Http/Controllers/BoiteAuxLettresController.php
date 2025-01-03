<?php

namespace App\Http\Controllers;
use App\Models\MessageEtCommentaire;
use App\Models\AutorisationSpeciale;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\UploadedFile;
use App\Jobs\SendMailBoiteAuxLettreJob;


class BoiteAuxLettresController extends Controller
{
    public function list_des_lettres(Request $request) {
        $liste_des_lettres = MessageEtCommentaire::orderBy('id', 'desc')->get(); 
        $current_user = $request->user();   
        $autorisationspeciales = AutorisationSpeciale::where('table_name', 'message_et_commentaires')->where('user_id', $request->user()->id)->first(); 
        return view('private_layouts.boites_aux_lettres.boite_aux_lettres', compact('liste_des_lettres', 'autorisationspeciales', 'current_user'));  
    }

    public function supprimer_message(Request $request) {
        $message_id = $request->get('message_id');
        $message = MessageEtCommentaire::find($message_id);
        $message->delete();
        return redirect()->back()->with('success', "le message a été supprimé");
    }

    public function repondre_message(Request $request) {
        $request->validate([
            'destinataire' => 'required',
            'reponse' => 'required',
            'piece_jointe' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:5120'
        ], [
            'destinataire.required' => "Aucun déstinataire n'a été sélectionné",
            'reponse.required' => "ce champs est obligatoire",
            'piece_jointe.file' => "la pièce jointe doit être un fichier",
            'piece_jointe.mime' => "type incorrect pour la pièce jointe",
            'piece_jointe.max' => "la pièce jointe dépasse la taille maximale autorisée",
        ]);

        $destinataire = $request->get('destinataire');
        $reponse = $request->get('reponse');

        $details = [
            'title' => 'Réponse à votre message',
            'subject' => 'Réponse à votre message',
            'body' => $reponse
        ];

        $attachmentPath = null;
        if ($request->hasFile('piece_jointe')) {
            /** @var UploadedFile $photo */
            $attachmentPath = $request->file('piece_jointe')->store('attachments', 'public');
        }

        SendMailBoiteAuxLettreJob::dispatch($destinataire, $details, $attachmentPath);
        
        return redirect()->back()->with("success", "le mail a été envoyé");
    }
}
