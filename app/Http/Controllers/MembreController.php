<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutorisationSpeciale;
use App\Models\Membre;
use App\Models\Invites;
use App\Models\Baptemes;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class MembreController extends Controller
{
    //LES MEMBRES
    public function list_des_membres(Request $request):View
    {
        $autorisations = AutorisationSpeciale::where('table_name', 'membres')->where('user_id', $request->user()->id)->first();
        $membres = Membre::all();

        return view('private_layouts.membres.list_des_membres', ['current_user'=>$request->user(), 'membres'=>$membres, 'autorisations'=>$autorisations]);
    }

    public function nouveau_membre(Request $request):View
    {
        return view('private_layouts.membres.ajouter_un_membre', ['current_user' => $request->user()]);
    }

    public function save_membre(Request $request)
    {
        $request->validate(
            [
                'paroisse_id'=>['required'],
                'nom'=>['required'],
                'sexe'=>['required'],
                'nationalite'=>['required'],
                'lieu_de_naissance'=>['required'],
                'date_de_naissance'=>['required'],
                'adresse_de_residence_actuelle'=>['required'],
                'adresse_de_residence_permanente'=>['required'],
                'etat_civil'=>['required'],
                'profession'=>['required'],
                'baptise'=>['required'],
                'statut'=>['required'],
            ],
            [
                'paroisse_id'=>'ce champs est obligatoire',
                'nom.required'=>'ce champs est obligatoire',
                'sexe.required'=>"ce champs est obligatoire",
                'nationalite.required'=>"ce champs est obligatoire",
                'lieu_de_naissance.required'=>"ce champs est obligatoire",
                'date_de_naissance.required'=>"ce champs est obligatoire",
                'adresse_de_residence_actuelle.required'=>"ce champs est obligatoire",
                'adresse_de_residence_permanente.required'=>"ce champs est obligatoire",
                'etat_civil.required'=>"ce champs est obligatoire",
                'profession.required'=>"ce champs est obligatoire",
                'baptise.required'=>"ce champs est obligatoire",
                'statut.required'=>"ce champs est obligatoire",
            ]
        );

        $imagePath = "";
        if ($request->hasFile('photo')){
            /** @var UploadedFile $photo */
            $image = $request->photo;
            $imagePath = $image->store('medias', 'public');
        }

        $membre = Membre::create([
            'photo'=>$imagePath,
            'paroisse_id'=>$request->get('paroisse_id'),
            'nom'=>$request->get('nom'),
            'sexe'=>$request->get('sexe'),
            'nationalite'=>$request->get('nationalite'),
            'lieu_de_naissance'=>$request->get('lieu_de_naissance'),
            'date_de_naissance'=>$request->get('date_de_naissance'),
            'adresse_de_residence_actuelle'=>$request->get('adresse_de_residence_actuelle'),
            'adresse_de_residence_permanente'=>$request->get('adresse_de_residence_permanente'),
            'etat_civil'=>$request->get('etat_civil'),
            'partenaire'=>$request->get('partenaire'),
            'nombre_enfants'=>$request->get('nombre_enfants', 0),
            'profession'=>$request->get('profession'),
            'contacts'=>$request->get('contacts'),
            'email'=>$request->get('email'),
            'baptise'=>$request->get('baptise'),
            'date_de_bapteme'=>$request->get('date_de_bapteme'),
            'statut'=>$request->get('statut'),
            'fonction'=>$request->get('fonction'),
            'responsabilites'=>$request->get('responsabilites'),
        ]);

        return redirect()->route('membres.list_des_membres')->with('success', "le membre a été ajouté");
    }

    public function afficher_membre($membre_id, Request $request):View
    {
        $autorisations = AutorisationSpeciale::where('table_name', 'membres')->where('user_id', $request->user()->id)->first();
        $membre = Membre::find($membre_id);
        return view('private_layouts.membres.afficher_un_membre', ['membre'=>$membre, 'current_user'=>$request->user(), 'autorisations'=>$autorisations]);
    }

    public function supprimer_membre(Request $request)
    {
        $membre_id = $request->get("membre_id");
        $membre = Membre::find($membre_id);
        $membre->delete();

        return redirect()->route('membres.list_des_membres')->with('success', "le membre a été supprimé");
    }

    public function edit_membre($membre_id, Request $request):View
    {
        $membre = Membre::find($membre_id);
        return view('private_layouts.membres.editer_un_membre', ['membre'=>$membre, 'current_user'=>$request->user()]);
    }

    public function save_edition_membre($membre_id, Request $request)
    {
        $request->validate(
            [
                'paroisse_id'=>['required'],
                'nom'=>['required'],
                'sexe'=>['required'],
                'nationalite'=>['required'],
                'lieu_de_naissance'=>['required'],
                'date_de_naissance'=>['required'],
                'adresse_de_residence_actuelle'=>['required'],
                'adresse_de_residence_permanente'=>['required'],
                'etat_civil'=>['required'],
                'profession'=>['required'],
                'baptise'=>['required'],
                'statut'=>['required'],
            ],
            [
                'paroisse_id'=>'ce champs est obligatoire',
                'nom.required'=>'ce champs est obligatoire',
                'sexe.required'=>"ce champs est obligatoire",
                'nationalite.required'=>"ce champs est obligatoire",
                'lieu_de_naissance.required'=>"ce champs est obligatoire",
                'date_de_naissance.required'=>"ce champs est obligatoire",
                'adresse_de_residence_actuelle.required'=>"ce champs est obligatoire",
                'adresse_de_residence_permanente.required'=>"ce champs est obligatoire",
                'etat_civil.required'=>"ce champs est obligatoire",
                'profession.required'=>"ce champs est obligatoire",
                'baptise.required'=>"ce champs est obligatoire",
                'statut.required'=>"ce champs est obligatoire",
            ]
        );

        $membre = Membre::find($membre_id);


        $photo_init = $membre->photo;
        if ($request->hasFile('photo')){
            /** @var UploadedFile $photo */
            $image = $request->photo;
            $imagePath = $image->store('medias', 'public');
            Storage::disk('public')->delete($photo_init);
            $membre->photo = $imagePath;
        }

        if ($request->get('etat') === "en service") {
            $membre->motif_de_suspension = "";
        }else {
            $membre->motif_de_suspension = $request->get('motif_de_suspension');
        }


        $membre->paroisse_id= $request->get('paroisse_id');
        $membre->nom = $request->get('nom');
        $membre->sexe = $request->get('sexe');
        $membre->nationalite = $request->get('nationalite');
        $membre->lieu_de_naissance = $request->get('lieu_de_naissance');
        $membre->date_de_naissance = $request->get('date_de_naissance');
        $membre->adresse_de_residence_actuelle = $request->get('adresse_de_residence_actuelle');
        $membre->adresse_de_residence_permanente = $request->get('adresse_de_residence_permanente');
        $membre->etat_civil = $request->get('etat_civil');
        $membre->partenaire = $request->get('partenaire');
        $membre->nombre_enfants = $request->get('nombre_enfants');
        $membre->profession = $request->get('profession');
        $membre->contacts = $request->get('contacts');
        $membre->email = $request->get('email');
        $membre->baptise = $request->get('baptise');
        $membre->date_de_bapteme = $request->get('date_de_bapteme');
        $membre->statut = $request->get('statut');
        $membre->fonction = $request->get('fonction');
        $membre->responsabilites = $request->get('responsabilites');
        $membre->etat = $request->get('etat');
        

        $membre->update();

        return redirect()->back()->with('success', 'les mises à jours ont été appliqués');
    }

    //LES INVITES
    public function list_des_invites(Request $request):View
    {
        $autorisations = AutorisationSpeciale::where('table_name', 'invites')->where('user_id', $request->user()->id)->first();
        $invites = Invites::all();

        return view('private_layouts.invites.list_des_invites', ['current_user'=>$request->user(), 'invites'=>$invites, 'autorisations'=>$autorisations]);
    }

    public function nouvel_invite(Request $request):View
    {
        return view('private_layouts.invites.ajouter_un_invite', ['current_user' => $request->user()]);
    }

    public function save_invite(Request $request)
    {
        $request->validate(
            [
                'nom'=>['required'],
                'sexe'=>['required'],
                'adresse_de_residence'=>['required'],
                'eglise_de_provenance'=>['required'],
            ],
            [
                'nom'=>'ce champs est obligatoire',
                'sexe'=>'ce champs est obligatoire',
                'adresse_de_residence.required'=>'ce champs est obligatoire',
                'eglise_de_provenance.required'=>"ce champs est obligatoire",
            ]
        );

        $invite = Invites::create([
            'nom'=>$request->get('nom'),
            'sexe'=>$request->get('sexe'),
            'telephone'=>$request->get('telephone'),
            'adresse_de_residence'=>$request->get('adresse_de_residence'),
            'eglise_de_provenance'=>$request->get('eglise_de_provenance'),
        ]);

        return redirect()->route('invites.list_des_invites')->with('success', "l'invité a été ajouté");
    }

    public function supprimer_invite(Request $request)
    {
        $invite_id = $request->get("invite_id");
        $invite = Invites::find($invite_id);
        $invite->delete();

        return redirect()->route('invites.list_des_invites')->with('success', "l'invité a été supprimé");
    }

    public function edit_invite($invite_id, Request $request):View
    {
        $invite = Invites::find($invite_id);
        return view('private_layouts.invites.editer_un_invite', ['invite'=>$invite, 'current_user'=>$request->user()]);
    }

    public function save_edition_invite($invite_id, Request $request)
    {
        $request->validate(
            [
                'nom'=>['required'],
                'sexe'=>['required'],
                'adresse_de_residence'=>['required'],
                'eglise_de_provenance'=>['required'],
            ],
            [
                'nom'=>'ce champs est obligatoire',
                'sexe'=>'ce champs est obligatoire',
                'adresse_de_residence.required'=>'ce champs est obligatoire',
                'eglise_de_provenance.required'=>"ce champs est obligatoire",
            ]
        );

        $invite = Invites::find($invite_id);

        $invite->nom= $request->get('nom');
        $invite->sexe= $request->get('sexe');
        $invite->telephone= $request->get('telephone');
        $invite->adresse_de_residence = $request->get('adresse_de_residence');
        $invite->eglise_de_provenance = $request->get('eglise_de_provenance');

        $invite->update();

        return redirect()->back()->with('success', 'les mises à jours ont été appliqués');
    }


    //LES BAPTISES
    public function list_des_baptises(Request $request):View
    {
        $autorisations = AutorisationSpeciale::where('table_name', 'baptemes')->where('user_id', $request->user()->id)->first();
        $baptises = Baptemes::all();

        return view('private_layouts.baptemes.list_des_baptises', ['current_user'=>$request->user(), 'baptises'=>$baptises, 'autorisations'=>$autorisations]);
    }

    public function nouveau_baptise(Request $request):View
    {
        return view('private_layouts.baptemes.ajouter_un_baptise', ['current_user' => $request->user()]);
    }

    public function save_baptise(Request $request)
    {
        $request->validate(
            [
                'nom'=>['required'],
                'sexe'=>['required'],
                'adresse_de_residence'=>['required'],
                'date_de_naissance'=>['required'],
                'date_de_bapteme'=>['required'],
                'nom_de_bapteme'=>['required'],
            ],
            [
                'nom'=>'ce champs est obligatoire',
                'sexe.required'=>'ce champs est obligatoire',
                'adresse_de_residence.required'=>'ce champs est obligatoire',
                'date_de_naissance.required'=>"ce champs est obligatoire",
                'date_de_bapteme.required'=>"ce champs est obligatoire",
                'nom_de_bapteme.required'=>"ce champs est obligatoire",
            ]
        );

        $imagePath = "";
        if ($request->hasFile('photo')){
            /** @var UploadedFile $photo */
            $image = $request->photo;
            $imagePath = $image->store('medias', 'public');
        }

        $baptise = Baptemes::create([
            'photo'=>$imagePath,
            'nom'=>$request->get('nom'),
            'sexe'=>$request->get('sexe'),
            'adresse_de_residence'=>$request->get('adresse_de_residence'),
            'date_de_naissance'=>$request->get('date_de_naissance'),
            'date_de_bapteme'=>$request->get('date_de_bapteme'),
            'nom_de_bapteme'=>$request->get('nom_de_bapteme'),
        ]);

        return redirect()->route('baptemes.list_des_baptises')->with('success', "le baptisé a été ajouté");
    }

    public function afficher_baptise($baptise_id, Request $request):View
    {
        $autorisations = AutorisationSpeciale::where('table_name', 'baptemes')->where('user_id', $request->user()->id)->first();
        $baptise = Baptemes::find($baptise_id);
        return view('private_layouts.baptemes.afficher_un_baptise', ['baptise'=>$baptise, 'current_user'=>$request->user(), 'autorisations'=>$autorisations]);
    }

    public function supprimer_baptise(Request $request)
    {
        $baptise_id = $request->get("baptise_id");
        $baptise = Baptemes::find($baptise_id);
        $baptise->delete();

        return redirect()->route('baptemes.list_des_baptises')->with('success', "le baptisé a été supprimé");
    }

    public function edit_baptise($baptise_id, Request $request):View
    {
        $baptise = Baptemes::find($baptise_id);
        return view('private_layouts.baptemes.editer_un_baptise', ['baptise'=>$baptise, 'current_user'=>$request->user()]);
    }

    public function save_edition_baptise($baptise_id, Request $request)
    {
        $request->validate(
            [
                'nom'=>['required'],
                'sexe'=>['required'],
                'adresse_de_residence'=>['required'],
                'date_de_naissance'=>['required'],
                'date_de_bapteme'=>['required'],
                'nom_de_bapteme'=>['required'],
            ],
            [
                'nom'=>'ce champs est obligatoire',
                'sexe.required'=>'ce champs est obligatoire',
                'adresse_de_residence.required'=>'ce champs est obligatoire',
                'date_de_naissance.required'=>"ce champs est obligatoire",
                'date_de_bapteme.required'=>"ce champs est obligatoire",
                'nom_de_bapteme.required'=>"ce champs est obligatoire",
            ]
        );

        $baptise = Baptemes::find($baptise_id);


        $photo_init = $baptise->photo;
        if ($request->hasFile('photo')){
            /** @var UploadedFile $photo */
            $image = $request->photo;
            $imagePath = $image->store('medias', 'public');
            Storage::disk('public')->delete($photo_init);
            $baptise->photo = $imagePath;
        }


        $baptise->nom= $request->get('nom');
        $baptise->sexe = $request->get('sexe');
        $baptise->adresse_de_residence = $request->get('adresse_de_residence');
        $baptise->date_de_naissance = $request->get('date_de_naissance');
        $baptise->date_de_bapteme = $request->get('date_de_bapteme');
        $baptise->nom_de_bapteme = $request->get('nom_de_bapteme');

        $baptise->update();

        return redirect()->back()->with('success', 'les mises à jours ont été appliqués');
    }
}
