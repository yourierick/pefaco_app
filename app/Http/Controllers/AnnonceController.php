<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AnnonceController extends Controller
{
    public function list_des_annonces(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'annonces')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'annonces')->where('user_id', $request->user()->id)->first();
        $current_user = $request->user();
        $annonces = Annonce::where('statut', 'validé')->get();

        return view('private_layouts.annonces_folder.list_des_annonces', compact("current_user", "autorisation", "annonces", "autorisation_speciale"));
    }

    public function nouvelle_annonce(Request $request):View
    {
        return view('private_layouts.annonces_folder.ajouter_une_annonce', ['current_user' => $request->user()]);
    }


    public function voir_mes_drafts(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'annonces')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'annonces')->where('user_id', $request->user()->id)->first();
        $annonces = Annonce::where('statut', 'draft')->where('annonceur_id', $request->user()->id)->get();
        $current_user = $request->user();
        return view('private_layouts.annonces_folder.list_des_annonces', compact("current_user", "autorisation", "annonces", "autorisation_speciale"));
    }


    public function voir_les_attentes_en_validation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'annonces')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'annonces')->where('user_id', $request->user()->id)->first();
        $annonces = Annonce::where('statut', 'en attente de validation')->get();
        $current_user = $request->user();
        return view('private_layouts.annonces_folder.list_des_annonces',compact("current_user", "autorisation", "annonces", "autorisation_speciale") );
    }

    public function save_annonce(Request $request)
    {
        $request->validate([
            'date'=>['required'],
            'titre'=>['required'],
            'description'=>['required'],
        ],
            [
                'date.required'=>'ce champs est obligatoire',
                'titre.required'=>'ce champs est obligatoire',
                'description.required'=>'ce champs est obligatoire',
            ]);


        if ($request->hasFile('photo_descriptive')) {
            $path = $request->photo_descriptive->store('medias', 'public');
            $photo = $path;
        }


        $action = $request->input('action');
        $message = '';
        $statut = 'draft';
        if ($action == 'soumission') {
            $statut = 'en attente de validation';
            $message = "L'annonce a été soumise";
        }
        if ($action == 'draft') {
            $statut = 'draft';
            $message = "L'annonce a été enregistré en tant que draft";
        }


        $annonce = Annonce::create([
            'annonceur_id'=>$request->user()->id,
            'date'=>$request->get('date'),
            'titre'=>$request->get('titre'),
            'description'=>$request->get('description'),
            'photo_descriptive'=>$photo,
            'statut'=>$statut,
        ]);

        return redirect()->route('annonce.list_des_annonces')->with('success', $message);
    }

    public function afficher_annonce($annonce_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'annonces')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisationspeciales = AutorisationSpeciale::where('table_name', 'annonces')->where('user_id', $request->user()->id)->first();
        $annonce = Annonce::with('annonceur')->find($annonce_id);
        return view('private_layouts.annonces_folder.afficher_annonce', ['annonce'=>$annonce, 'current_user'=>$request->user(), 'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisationspeciales]);
    }


    public function supprimer_une_annonce(Request $request)
    {
        $annonce_id = $request->get('annonce_id');
        $annonce = Annonce::find($annonce_id);
        $annonce->delete();

        $action = $request->input('action');
        if ($action === 'suppression_draft') {
            return redirect()->route('annonce.voir_mes_drafts')->with('success', "le draft a été supprimé");
        }else {
            return redirect()->route('annonce.list_des_annonces')->with('success', "l'annonce a été supprimé");
        }
    }


    public function traitement_annonce($annonce_id, Request $request)
    {
        $annonce = Annonce::find($annonce_id);
        $action = $request->input('action');
        if ($action === "soumission") {
            $annonce->statut = "en attente de validation";
            $annonce->update();
        }elseif ($action === 'validation') {
            $annonce->statut = "validé";
            $annonce->update();
        }elseif ($action === 'publication') {
            $annonce->audience = "public";
            $annonce->update();
        }
        elseif ($action === 'prive') {
            $annonce->audience = "privé";
            $annonce->update();
        }

        return redirect()->route('annonce.afficher_annonce', $annonce_id)->with('success', 'le traitement a été appliqué');
    }


    public function edit_une_annonce($annonce_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'annonces')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $annonce = Annonce::find($annonce_id);
        return view('private_layouts.annonces_folder.editer_une_annonce', ['annonce'=>$annonce, 'current_user'=>$request->user(), 'autorisation'=>$autorisation]);
    }

    public function save_edition_annonce($annonce_id, Request $request)
    {
        $request->validate([
            'date'=>['required'],
            'titre'=>['required'],
            'description'=>['required'],
        ], [
            'date.required'=>'ce champs est obligatoire',
            'titre.required'=>'ce champs est obligatoire',
            'description.required'=>'ce champs est obligatoire',
        ]);

        $annonce = Annonce::find($annonce_id);


        if ($request->hasFile('photo_descriptive')) {
            $path = $request->file('photo_descriptive')->store('medias', 'public');
            Storage::disk('public')->delete($annonce->photo_descriptive);
            $annonce->photo_descriptive = $path;
        }


        $annonce->date = $request->get('date');
        $annonce->titre = $request->get('titre');
        $annonce->description = $request->get('description');

        $annonce->update();

        return redirect()->route('annonce.afficher_annonce', $annonce_id )->with('success', 'les mises à jours ont été appliqués');
    }
}
