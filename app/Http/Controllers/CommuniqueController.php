<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutorisationSpeciale;
use App\Models\Communique;
use Illuminate\View\View;

class CommuniqueController extends Controller
{
    public function list_des_communiques(Request $request):View
    {
        $autorisationspeciales = AutorisationSpeciale::where('table_name', 'communiques')->where('user_id', $request->user()->id)->first();
        $communiques = Communique::with("communiquant")->get();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/communique/list'), 'label'=>'Liste des communiqués', 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.communiques_folder.list_des_communiques', ['current_user'=>$request->user(), 
        'communiques'=>$communiques, 'autorisationspeciales'=>$autorisationspeciales, "breadcrumbs"=>$breadcrumbs]);
    }

    public function nouveau_communique(Request $request):View
    {
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/communique/list'), 'label'=>'Liste des communiqués', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/communique/nouveau_communique'), 'label'=>'Ajouter', 'icon'=>'bi-plus-circle fs-5'],
        ];
        return view('private_layouts.communiques_folder.ajouter_un_communique', ['current_user' => $request->user(), 
        "breadcrumbs"=>$breadcrumbs]);
    }


    public function save_communique(Request $request)
    {
        $request->validate(
            [
                'date'=>['required'],
                'titre'=>['required'],
                'communique'=>['required'],
            ],
            [
                'date'=>'ce champs est obligatoire',
                'titre.required'=>'ce champs est obligatoire',
                'communique.required'=>"aucun communiqué n'a été renseigné",
            ]
        );

        $data = request()->all();
        $communiques = [];

        if (array_key_exists('communique', $data)) {
            $communiques = array_filter($data['communique']);
        }

        $communique = Communique::create([
            'date'=>$request->get('date'),
            'communiquant_id'=>$request->user()->id,
            'titre'=>$request->get('titre'),
            'contenu'=>json_encode($communiques),
        ]);

        return redirect()->route('communique.list_des_communiques')->with('success', "le communiqué a été partagé");
    }


    public function afficher_un_communique($communique_id, Request $request):View
    {
        $autorisationspeciales = AutorisationSpeciale::where('table_name', 'communiques')->where('user_id', $request->user()->id)->first();
        $communique = Communique::find($communique_id);
        if ($communique->communiquant_id !== $request->user()->id){
            if (!in_array($request->user()->id, json_decode(json_decode($communique->accuse_de_reception, true) ?? []))){
                $existing_accuses = json_decode($communique->accuse_de_reception, true) ?? [];
                $existing_accuses[] = $request->user()->id;
                $communique->accuse_de_reception = json_encode($existing_accuses);
                $communique->update();
            }
        }

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/communique/list'), 'label'=>'Liste des communiqués', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/communique/afficher_un_communique'), 'label'=>'Afficher', 'icon'=>'bi-eye fs-5'],
        ];

        return view('private_layouts.communiques_folder.afficher_communique', ['communique'=>$communique, 
        'current_user'=>$request->user(), 'autorisationspeciales'=>$autorisationspeciales, "breadcrumbs"=>$breadcrumbs]);
    }


    public function supprimer_un_communique(Request $request)
    {
        $communique_id = $request->get("communique_id");
        $communique = Communique::find($communique_id);
        $communique->delete();

        return redirect()->route('communique.list_des_communiques')->with('success', "le communiqué a été supprimé");
    }


    public function edit_un_communique($communique_id, Request $request):View
    {
        $communique = Communique::find($communique_id);

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/communique/list'), 'label'=>'Liste des communiqués', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/communique/edit_un_enseignement'), 'label'=>'Editer', 'icon'=>'bi-pencil-square fs-5'],
        ];
        return view('private_layouts.communiques_folder.editer_un_communique', ['communique'=>$communique, 
        'current_user'=>$request->user(), "breadcrumbs"=>$breadcrumbs]);
    }

    public function save_edition_communique($communique_id, Request $request)
    {
        $request->validate([
            'date'=>['required'],
            'titre'=>['required'],
            'communique'=>['required'],
        ], [
            'date'=>'ce champs est obligatoire',
            'titre.required'=>'ce champs est obligatoire',
            'communique.required'=>"aucun communiqué n'a été renseigné",
        ]);

        $communique = Communique::find($communique_id);

        $data = request()->all();
        $communiques = [];

        if (array_key_exists('communique', $data)) {
            $communiques = array_filter($data['communique']);
        }


        $communique->titre = $request->get('titre');
        $communique->date = $request->get('date');
        $communique->contenu = json_encode($communiques);

        $communique->update();

        return redirect()->route('communique.afficher_un_communique', $communique_id )->with('success', 'les mises à jours ont été appliqués');
    }

    public function audience_communique($communique_id, Request $request) {
        $communique = Communique::find($communique_id);
        $action = $request->input('action');
        $message = "";
        if ($action == 'publier') {
            $communique->audience = 'public';
            $message = "le communiqué a été publié";
        }else {
            $communique->audience = 'privé';
            $message = "le communiqué a été dépublié";
        }
        $communique->update();

        return Redirect()->back()->with('status', $message);
    }
}
