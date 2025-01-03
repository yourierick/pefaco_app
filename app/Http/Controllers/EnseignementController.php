<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\Enseignement;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\CustomSystemNotificationTrait;

class EnseignementController extends Controller
{
    use CustomSystemNotificationTrait;
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

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/enseignement/list'), 'label'=>"Liste d'enseignements", 'icon'=>'bi-list fs-5'],
        ];

        return view('private_layouts.enseignements_folder.list_des_enseignements', ['current_user'=>$request->user(),
        'enseignements'=>$enseignements, 'autorisation'=>$autorisation,
        'autorisation_speciale'=>$autorisation_speciale, "breadcrumbs"=>$breadcrumbs]);
    }

    public function nouvel_enseignement(Request $request):View
    {
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/enseignement/list'), 'label'=>"Liste d'enseignements", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/enseignement/nouvel_enseignement'), 'label'=>"Ajouter", 'icon'=>'bi-plus-circle fs-5'],
        ];

        return view('private_layouts.enseignements_folder.ajouter_un_enseignement', ['current_user'=>$request->user(),
        "breadcrumbs"=>$breadcrumbs]);
    }


    public function voir_mes_drafts_enseignement(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'enseignements')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'enseignements')->where('user_id', $request->user()->id)->first();
        $enseignements = Enseignement::with('auteur')->where('statut', 'draft')->where('auteur_id', $request->user()->id)->get();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/enseignement/list'), 'label'=>"Liste d'enseignements", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/enseignement/voir_mes_drafts_enseignement'), 'label'=>"Mes drafts", 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.enseignements_folder.list_des_enseignements', ['current_user'=>$request->user(),
        'enseignements'=>$enseignements, 'autorisation'=>$autorisation,
        "autorisation_speciale"=>$autorisation_speciale, "breadcrumbs"=>$breadcrumbs]);
    }


    public function voir_les_attentes_en_validation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'enseignements')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'enseignements')->where('user_id', $request->user()->id)->first();
        $enseignements = Enseignement::with('auteur')->where('statut', 'en attente de validation')->get();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/enseignement/list'), 'label'=>"Liste d'enseignements", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/enseignement/voir_les_attentes_en_validation'), 'label'=>"Rapports en attente", 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.enseignements_folder.list_des_enseignements', ['current_user'=>$request->user(),
        'enseignements'=>$enseignements, 'autorisation'=>$autorisation,
        'autorisation_speciale'=>$autorisation_speciale, "breadcrumbs"=>$breadcrumbs]);
    }

    public function save_enseignement(Request $request)
    {
        $request->validate(
            [
                'titre'=>['required'],
                'reference'=>['required'],
                'enseignement'=>['required'],
                'affiche_photo'=>'nullable|file|mimes:jpg, jpeg, png|max:2048',
            ],
            [
                'titre.required'=>'ce champs est obligatoire',
                'reference.required'=>'ce champs est obligatoire',
                'enseignement.required'=>'ce champs est obligatoire',
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

        if ($statut === "en attente de validation") {
            $autorisations = AutorisationSpeciale::where('table_name', 'enseignements')->get();

            $userstonotify = [];
            foreach ($autorisations as $autorisation) {
                $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
                if (!is_null($autorisations_speciales)) {
                    if (in_array("peux valider", $autorisations_speciales)) {
                        $userstonotify[] = User::find($autorisation->user_id);
                    }
                }
            }

            $url = route('enseignement.afficher_un_enseignement', $enseignement->id);

            if ($userstonotify) {
                $this->triggerNotification($enseignement, 'App\Models\Enseignement', 'Demande de validation',
            "Un nouvel enseignement a été enregistré et est en attente de validation ",$url, $userstonotify) ;
            }
        }

        return redirect()->route('enseignement.list_des_enseignements')->with('success', $message);
    }

    public function afficher_un_enseignement($enseignement_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'enseignements')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisationspeciales = AutorisationSpeciale::where('table_name', 'enseignements')->where('user_id', $request->user()->id)->first();
        $enseignement = Enseignement::with('auteur')->find($enseignement_id);

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/enseignement/list'), 'label'=>"Liste d'enseignements", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/enseignement/afficher_un_enseignement'), 'label'=>"Afficher", 'icon'=>'bi-eye fs-5'],
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
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_id')) COLLATE utf8_general_ci = ?", [$enseignement_id])
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_type')) COLLATE utf8_general_ci = ?", get_class($enseignement))->first();

            if ($notification) {
                $notification->markAsRead();
            }
        }

        return view('private_layouts.enseignements_folder.afficher_enseignement', ['enseignement'=>$enseignement,
        'current_user'=>$request->user(), 'autorisation'=>$autorisation,
        'autorisation_speciale'=>$autorisationspeciales, "breadcrumbs"=>$breadcrumbs]);
    }


    public function supprimer_un_enseignement(Request $request)
    {
        $enseignement_id = $request->get('enseignement_id');
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

            $autorisations = AutorisationSpeciale::where('table_name', 'enseignements')->get();

            $userstonotify = [];
            foreach ($autorisations as $autorisation) {
                $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
                if (!is_null($autorisations_speciales)) {
                    if (in_array("peux valider", $autorisations_speciales)) {
                        $userstonotify[] = User::find($autorisation->user_id);
                    }
                }
            }

            $url = route('enseignement.afficher_un_enseignement', $enseignement->id);

            if ($userstonotify) {
                $this->triggerNotification($enseignement, 'App\Models\Enseignement', 'Demande de validation',
            "Un nouvel enseignement a été enregistré et est en attente de validation ",$url, $userstonotify) ;
            }
        }elseif ($action === 'validation') {
            $enseignement->statut = "validé";
            $enseignement->update();

            $autorisations = AutorisationSpeciale::where('table_name', 'enseignements')->get();

            $userstonotify = [];
            $userstonotify[] = User::find($enseignement->auteur_id);

            $url = route('enseignement.afficher_un_enseignement', $enseignement->id);

            if ($userstonotify) {
                $this->triggerNotification($enseignement, 'App\Models\Enseignement', 'Confirmation de validation',
            "Votre enseignement a été validé",$url, $userstonotify) ;
            }
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
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/enseignement/list'), 'label'=>"Liste d'enseignements", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/enseignement/edit_un_enseignement'), 'label'=>"Editer", 'icon'=>'bi-pencil-square fs-5'],
        ];
        return view('private_layouts.enseignements_folder.editer_un_enseignement', ['enseignement'=>$enseignement,
        'current_user'=>$request->user(), 'autorisation'=>$autorisation, "breadcrumbs"=>$breadcrumbs]);
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
