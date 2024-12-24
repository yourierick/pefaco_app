<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\Enseignement;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EnseignementController extends Controller
{
    public function list_des_enseignements(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'enseignements')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'enseignements')->where('user_id', $request->user()->id)->first();
        $enseignements = [];
        if ($autorisation !== null) {
            if ($autorisation->autorisation_en_lecture){
                if (in_array('peux voir tous les enseignements', json_decode($autorisation->autorisation_en_lecture, true))) {
                    $enseignements = Enseignement::with('auteur')->where('statut', 'validé')->get();
                }else{
                    $enseignements = Enseignement::with('auteur')->where('statut', 'validé')->where('auteur_id', $request->user()->id)->get();
                }
            }
        }

        return view('private_layouts.enseignements_folder.list_des_enseignements', ['current_user'=>$request->user(), 'enseignements'=>$enseignements, 'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisation_speciale]);
    }

    public function nouvel_enseignement(Request $request):View
    {
        return view('private_layouts.enseignements_folder.ajouter_un_enseignement', ['current_user' => $request->user()]);
    }


    public function voir_mes_drafts_enseignement(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'enseignements')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'enseignements')->where('user_id', $request->user()->id)->first();
        $enseignements = Enseignement::with('auteur')->where('statut', 'draft')->where('auteur_id', $request->user()->id)->get();
        return view('private_layouts.enseignements_folder.list_des_enseignements', ['current_user'=>$request->user(), 'enseignements'=>$enseignements, 'autorisation'=>$autorisation, "autorisation_speciale"=>$autorisation_speciale]);
    }


    public function voir_les_attentes_en_validation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'enseignements')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'enseignements')->where('user_id', $request->user()->id)->first();
        $enseignements = Enseignement::with('auteur')->where('statut', 'en attente de validation')->get();
        return view('private_layouts.enseignements_folder.list_des_enseignements', ['current_user'=>$request->user(), 'enseignements'=>$enseignements, 'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisation_speciale]);
    }

    public function save_enseignement(Request $request)
    {
        $request->validate(
            [
                'titre'=>['required'],
                'reference'=>['required'],
            ],
            [
                'titre.required'=>'ce champs est obligatoire',
                'reference.required'=>'ce champs est obligatoire',
            ]
        );

        if ($request->hasFile('affiche_photo')) {
            $path = $request->affiche_photo->store('medias', 'public');
            $photo = $path;
        }


        if ($request->hasFile('audio')) {
            $path = $request->audio->store('medias', 'public');
            $audio = $path;
        }

        if ($request->hasFile('video')) {
            $path = $request->video->store('medias', 'public');
            $video = $path;
        }


        $action = $request->input('action');
        $message = '';
        $statut = 'draft';
        if ($action == 'soumission') {
            $statut = 'en attente de validation';
            $message = "L'enseignement a été soumis";
        }
        if ($action == 'draft') {
            $statut = 'draft';
            $message = "L'enseignement a été enregistré en tant que draft";
        }


        $enseignement = Enseignement::create([
            'auteur_id'=>$request->user()->id,
            'titre'=>$request->get('titre'),
            'reference'=>$request->get('reference'),
            'enseignement'=>$request->get('enseignement'),
            'affiche_photo'=>$photo,
            'audio'=>$audio,
            'video'=>$video,
            'statut'=>$statut,
        ]);

        return redirect()->route('enseignement.list_des_enseignements')->with('success', $message);
    }

    public function afficher_un_enseignement($enseignement_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'enseignements')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisationspeciales = AutorisationSpeciale::where('table_name', 'enseignements')->where('user_id', $request->user()->id)->first();
        $enseignement = Enseignement::with('auteur')->find($enseignement_id);
        return view('private_layouts.enseignements_folder.afficher_enseignement', ['enseignement'=>$enseignement, 'current_user'=>$request->user(), 'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisationspeciales]);
    }


    public function supprimer_un_enseignement(Request $request)
    {
        $enseignement = $request->get('enseignement_id');
        $enseignement = Enseignement::find($enseignement_id);
        $enseignement->delete();

        $action = $request->input('action');
        if ($action === 'suppression_draft') {
            return redirect()->route('enseignement.voir_mes_drafts_enseignement')->with('success', "le draft a été supprimé");
        }else {
            return redirect()->route('enseignement.list_des_enseignements')->with('success', "l'enseignement a été supprimé");
        }
    }


    public function traitement_enseignement($enseignement_id, Request $request)
    {
        $enseignement = Enseignement::find($enseignement_id);
        $action = $request->input('action');
        if ($action === "soumission") {
            $enseignement->statut = "en attente de validation";
            $enseignement->update();
        }elseif ($action === 'validation') {
            $enseignement->statut = "validé";
            $enseignement->update();
        }elseif ($action === 'publication') {
            $enseignement->audience = "public";
            $enseignement->update();
        }
        elseif ($action === 'prive') {
            $enseignement->audience = "privé";
            $enseignement->update();
        }

        return redirect()->route('enseignement.afficher_un_enseignement', $enseignement_id)->with('success', 'le traitement a été appliqué');
    }


    public function edit_un_enseignement($enseignement_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'enseignements')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $enseignement = Enseignement::find($enseignement_id);
        return view('private_layouts.enseignements_folder.editer_un_enseignement', ['enseignement'=>$enseignement, 'current_user'=>$request->user(), 'autorisation'=>$autorisation]);
    }

    public function save_edition_enseignement($enseignement_id, Request $request)
    {
        $request->validate([
            'titre'=>['required'],
            'reference'=>['required'],
        ], [
            'titre.required'=>'ce champs est obligatoire',
            'reference.required'=>'ce champs est obligatoire',
        ]);

        $enseignement = Enseignement::find($enseignement_id);

        if ($request->hasFile('affiche_photo')) {
            $path = $request->file('affiche_photo')->store('medias', 'public');
            if ($enseignement->affiche_photo){
                Storage::disk('public')->delete($enseignement->affiche_photo);
            }
            $enseignement->affiche_photo = $path;
        }else {
            if ($request->has("delete_affiche_photo")) {
                Storage::disk('public')->delete($enseignement->affiche_photo);
                $enseignement->affiche_photo = null;
            }
        }


        if ($request->hasFile('audio')) {
            $path = $request->file('audio')->store('medias', 'public');
            if ($enseignement->audio){
                Storage::disk('public')->delete($enseignement->audio);
            }
            $enseignement->audio = $path;
        }else {
            if ($request->has("delete_audio")) {
                Storage::disk('public')->delete($enseignement->audio);
                $enseignement->audio = null;
            }
        }

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('medias', 'public');
            if ($enseignement->video){
                Storage::disk('public')->delete($enseignement->video);
            }
            $enseignement->video = $path;
        }else {
            if ($request->has("delete_video")) {
                Storage::disk('public')->delete($enseignement->video);
                $enseignement->video = null;
            }
        }


        $enseignement->titre = $request->get('titre');
        $enseignement->reference = $request->get('reference');
        $enseignement->enseignement = $request->get('enseignement');

        $enseignement->update();

        return redirect()->route('enseignement.afficher_un_enseignement', $enseignement_id )->with('success', 'les mises à jours ont été appliqués');
    }
}
