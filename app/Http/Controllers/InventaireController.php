<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\Inventaire;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Illuminate\View\View;

class InventaireController extends Controller
{
    public function list_des_biens(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'inventaires')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $biens = Inventaire::all();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/inventaire/list'), 'label'=>"Liste Inventaire", 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.inventaire_folder.inventaire', ['biens' => $biens, 
        'current_user' => $request->user(), 'autorisation'=>$autorisation, "breadcrumbs"=>$breadcrumbs]);
    }

    public function ajouter_nouveau_bien(Request $request): View
    {
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/inventaire/list'), 'label'=>"Liste Inventaire", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/inventaire/ajouter_nouveau'), 'label'=>"Ajouter", 'icon'=>'bi-plus-circle fs-5'],
        ];
        return view('private_layouts.inventaire_folder.ajouter_bien', ['current_user' => $request->user(), 
        "breadcrumbs"=>$breadcrumbs]);
    }

    public function sauvegarder_le_bien(Request $request)
    {
        $request->validate([
            'designation' => ['required'],
            'date_acquisition'=> ['required'],
            'prix_unitaire' => ['required', 'numeric'],
            'quantite' => ['required', 'numeric'],
            'affectation' => ['required'],
            'etat' => ['required'],
        ], [
            'designation.required'=>'Ce champs est obligatoire',
            'date_acquisition.required'=>'Ce champs est obligatoire',
            'prix_unitaire.required'=>'Ce champs est obligatoire',
            'prix_unitaire.numeric'=>'Seules les valeurs numériques sont autorisées',
            'quantite.required'=>'Ce champs est obligatoire',
            'quantite.numeric'=>'Seules les valeurs numériques sont autorisées',
            'affectation.required'=>'Ce champs est obligatoire',
            'etat.required'=>'Ce champs est obligatoire',
        ]);


        $bien = Inventaire::create([
            'designation'=>$request->get('designation'),
            'date_acquisition'=>$request->get('date_acquisition'),
            'prix_unitaire'=>$request->get('prix_unitaire'),
            'quantite'=>$request->get('quantite'),
            'affectation'=>$request->get('affectation'),
            'etat'=>$request->get('etat'),
        ]);

        return redirect()->route('inventaire.list_des_biens')->with('success', "le bien a été enregistré");
    }

    public function edit_bien($bien_id, Request $request): View
    {
        $bien = Inventaire::find($bien_id);

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/inventaire/list'), 'label'=>"Liste Inventaire", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/inventaire/edit_bien'), 'label'=>"Editer", 'icon'=>'bi-pencil-square fs-5'],
        ];

        return view('private_layouts.inventaire_folder.edit_bien',
            ['bien'=>$bien, 'current_user'=>$request->user(), "breadcrumbs"=>$breadcrumbs]);
    }

    public function save_edition_bien($bien_id, Request $request)
    {
        $request->validate([
            'designation' => ['required'],
            'date_acquisition'=> ['required'],
            'prix_unitaire' => ['required', 'numeric'],
            'quantite' => ['required', 'numeric'],
            'affectation' => ['required'],
            'etat' => ['required'],
        ], [
            'designation.required'=>'Ce champs est obligatoire',
            'date_acquisition.required'=>'Ce champs est obligatoire',
            'prix_unitaire.required'=>'Ce champs est obligatoire',
            'prix_unitaire.numeric'=>'Seules les valeurs numériques sont autorisées',
            'quantite.required'=>'Ce champs est obligatoire',
            'quantite.numeric'=>'Seules les valeurs numériques sont autorisées',
            'affectation.required'=>'Ce champs est obligatoire',
            'etat.required'=>'Ce champs est obligatoire',
        ]);

        $bien = Inventaire::find($bien_id);
        $bien->designation = $request->get('designation');
        $bien->date_acquisition = $request->get('date_acquisition');
        $bien->prix_unitaire = $request->get('prix_unitaire');
        $bien->quantite = $request->get('quantite');
        $bien->affectation = $request->get('affectation');
        $bien->etat = $request->get('etat');
        $bien->update();

        return redirect()->route('inventaire.list_des_biens')->with('success', 'les informations ont été mises à jour');
    }

    public function supprimer_bien(Request $request)
    {
        $bien_id = $request->get('bien_id');
        $bien = Inventaire::find($bien_id);
        $bien->delete();
        return redirect()->route('inventaire.list_des_biens')->with('success', 'le bien a été supprimé');
    }
}
