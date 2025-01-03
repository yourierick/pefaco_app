<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutorisationSpeciale;
use App\Models\User;
use App\Models\Communique;
use Illuminate\View\View;
use App\CustomSystemNotificationTrait;

class CommuniqueController extends Controller
{
    use CustomSystemNotificationTrait;
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

        $autorisations = AutorisationSpeciale::where('table_name', 'communiques')->get();

        $userstonotify = [];
        foreach ($autorisations as $autorisation) {
            $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
            if (!is_null($autorisations_speciales)) {
                if (in_array("peux lire", $autorisations_speciales)) {
                    $userstonotify[] = User::find($autorisation->user_id);
                }
            }
        }

        $url = route('communique.afficher_un_communique', $communique->id);

        if ($userstonotify) {
            $this->triggerNotification($communique, 'App\Models\Communique', 'Communiqué 00'. $communique->id,
        "Un nouveau communiqué a été publié, cliquez pour voir ",$url, $userstonotify) ;
        }

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

        $notification_id = $request->query('notification_id');
        //Si notification_id a été fournie, alors marqué la notification comme lue
        if ($notification_id) {
            $notification = auth()->user()->notifications()->find($notification_id);
            if ($notification) {
                $notification->markAsRead();
            }
        }else {

            //si pas de notification_id, chercher une notification liée à cet objet
            $notification = auth()->user()->unreadNotifications()
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_id')) COLLATE utf8_general_ci = ?", [$communique_id])
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_type')) COLLATE utf8_general_ci = ?", get_class($communique))->first();

            if ($notification) {
                $notification->markAsRead();
            }
        }

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

        $autorisations = AutorisationSpeciale::where('table_name', 'communiques')->get();

        $userstonotify = [];
        foreach ($autorisations as $autorisation) {
            $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
            if (!is_null($autorisations_speciales)) {
                if (in_array("peux lire", $autorisations_speciales)) {
                    $userstonotify[] = User::find($autorisation->user_id);
                }
            }
        }

        $url = route('communique.afficher_un_communique', $communique->id);

        if ($userstonotify) {
            $this->triggerNotification($communique, 'App\Models\Communique', 'Communiqué 00'. $communique->id,
        "Le communiqué a été modifié, cliquez pour voir ",$url, $userstonotify) ;
        }

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
