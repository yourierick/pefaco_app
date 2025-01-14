<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\Annonce;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\CustomSystemNotificationTrait;

class AnnonceController extends Controller
{
    use CustomSystemNotificationTrait;
    public function list_des_annonces(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'annonces')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'annonces')->where('user_id', $request->user()->id)->first();
        $current_user = $request->user();
        $annonces = Annonce::where('statut', 'validé')->get();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/annonces/list'), 'label'=>"Annonces", 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.annonces_folder.list_des_annonces', compact("current_user",
        "autorisation", "annonces", "autorisation_speciale", "breadcrumbs"));
    }

    public function nouvelle_annonce(Request $request):View
    {
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/annonces/list'), 'label'=>"Annonces", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/annonces/nouvelle_annonce'), 'label'=>"Ajouter", 'icon'=>'bi-plus-circle fs-5'],
        ];
        return view('private_layouts.annonces_folder.ajouter_une_annonce', ['current_user' => $request->user(), 'breadcrumbs'=>$breadcrumbs]);
    }


    public function voir_mes_drafts(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'annonces')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'annonces')->where('user_id', $request->user()->id)->first();
        $annonces = Annonce::where('statut', 'draft')->where('annonceur_id', $request->user()->id)->get();
        $current_user = $request->user();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/annonces/list'), 'label'=>"Annonces", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/annonces/voir_mes_drafts'), 'label'=>"Mes drafs", 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.annonces_folder.list_des_annonces', compact("current_user",
        "autorisation", "annonces", "autorisation_speciale", "breadcrumbs"));
    }


    public function voir_les_attentes_en_validation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'annonces')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'annonces')->where('user_id', $request->user()->id)->first();
        $annonces = Annonce::where('statut', 'en attente de validation')->get();
        $current_user = $request->user();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/annonces/list'), 'label'=>"Annonces", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/annonces/voir_les_attentes_en_validation'), 'label'=>"Annonces en attente", 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.annonces_folder.list_des_annonces',compact("current_user",
        "autorisation", "annonces", "autorisation_speciale", "breadcrumbs") );
    }

    public function save_annonce(Request $request)
    {
        $request->validate([
            'date'=>['required'],
            'titre'=>['required'],
            'photo_descriptive'=>'required|file|mimes:jpg, jpeg, png, jfif|max:102400',
            'description'=>['required'],
        ],
        [
            'date.required'=>'ce champs est obligatoire',
            'titre.required'=>'ce champs est obligatoire',
            'description.required'=>'ce champs est obligatoire',
            'photo_descriptive.required'=>'ce champs est obligatoire',
        ]);


        $photo = "";
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

        if ($statut === "en attente de validation") {
            $autorisations = AutorisationSpeciale::all();

            $userstonotify = [];
            foreach ($autorisations as $autorisation) {
                $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
                if ($autorisation->table_name === "annonces") {
                    if (!is_null($autorisations_speciales)) {
                        if (in_array("peux valider", $autorisations_speciales)) {
                            $userstonotify[] = User::find($autorisation->user_id);
                        }
                    }
                }
            }

            $url = route('annonce.afficher_annonce', $annonce->id);

            if ($userstonotify) {
                $this->triggerNotification($annonce, 'App\Models\Annonce', 'Demande de validation',
            "L'annonce titrée : " . $annonce->titre . "est en attente de validation",
            $url, $userstonotify) ;
            }
        }

        return redirect()->route('annonce.list_des_annonces')->with('success', $message);
    }

    public function afficher_annonce($annonce_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'annonces')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisationspeciales = AutorisationSpeciale::where('table_name', 'annonces')->where('user_id', $request->user()->id)->first();
        $annonce = Annonce::with('annonceur')->find($annonce_id);

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/annonces/list'), 'label'=>"Annonces", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/annonces/afficher_une_annonce'), 'label'=>"Afficher une annonce", 'icon'=>'bi-eye fs-5'],
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
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_id')) COLLATE utf8_general_ci = ?", [$annonce_id])
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_type')) COLLATE utf8_general_ci = ?", get_class($annonce))->first();

            if ($notification) {
                $notification->markAsRead();
            }
        }

        return view('private_layouts.annonces_folder.afficher_annonce', ['annonce'=>$annonce,
        'current_user'=>$request->user(), 'autorisation'=>$autorisation,
        'autorisation_speciale'=>$autorisationspeciales, 'breadcrumbs'=>$breadcrumbs]);
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

            $autorisations = AutorisationSpeciale::all();
            $userstonotify = [];
            foreach ($autorisations as $autorisation) {
                $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
                if ($autorisation->table_name === "annonces") {
                    if (!is_null($autorisations_speciales)) {
                        if (in_array("peux valider", $autorisations_speciales)) {
                            $userstonotify[] = User::find($autorisation->user_id);
                        }
                    }
                }
            }

            $url = route('annonce.afficher_annonce', $annonce->id);

            if ($userstonotify) {
                $this->triggerNotification($annonce, 'App\Models\Annonce', 'Demande de validation',
            "L'annonce titrée : " . $annonce->titre . "est en attente de validation",
            $url, $userstonotify) ;
            }


        }elseif ($action === 'validation') {
            $annonce->statut = "validé";
            $annonce->update();

            try {
                $user = User::find($annonce->annonceur_id);
                $userstonotify[] = $user;

                $url = route('annonce.afficher_annonce', $annonce->id);

                if ($userstonotify) {
                    $this->triggerNotification($annonce, 'App\Models\Annonce', 'Validation',
                "Votre annonce titrée : " . $annonce->titre . "a été validé",
                $url, $userstonotify) ;
                }
            } catch (\Exception $e) {
                return response()->json([
                    "error"=> $e->getMessage(),
                ]);
            }
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

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/annonces/list'), 'label'=>"Annonces", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/annonces/edit_une_annonce'), 'label'=>"Editer une annonce", 'icon'=>'bi-pencil-square fs-5'],
        ];
        return view('private_layouts.annonces_folder.editer_une_annonce', ['annonce'=>$annonce,
        'current_user'=>$request->user(), 'autorisation'=>$autorisation, "breadcrumbs"=>$breadcrumbs]);
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

        $photo_init = $annonce->photo_descriptive;
        if ($request->hasFile('photo_descriptive')) {
            $path = $request->file('photo_descriptive')->store('medias', 'public');
            if (Storage::disk('public')->exists($photo_init)) {
                Storage::disk('public')->delete($photo_init);
            }
            $annonce->photo_descriptive = $path;
        }


        $annonce->date = $request->get('date');
        $annonce->titre = $request->get('titre');
        $annonce->description = $request->get('description');

        $annonce->update();

        return redirect()->route('annonce.afficher_annonce', $annonce_id )->with('success', 'les mises à jours ont été appliqués');
    }
}
