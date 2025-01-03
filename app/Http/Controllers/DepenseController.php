<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\Caisse;
use App\Models\Depense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Redirect;
use App\CustomSystemNotificationTrait;

class DepenseController extends Controller
{
    use CustomSystemNotificationTrait;
    public function liste_des_depenses(Request $request)
    {
        $groupe_id = $request->user()->groupe_utilisateur_id;
        $autorisation = Autorisations::where('table_name', 'depenses')->where('groupe_id', $groupe_id)->first();
        $depenses = [];
        if ($autorisation !== null) {
            if ($autorisation->autorisation_en_lecture) {
                if (in_array('peux voir toutes les dépenses', json_decode($autorisation->autorisation_en_lecture, true))) {
                    $depenses = Depense::with(['departement', 'caisse'])->get();
                }else {
                    $depenses = Depense::with(['departement', 'caisse'])->where('departement_id', $request->user()->departement_id)->orderByDesc('id')->get();
                }
            }
        }

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/depenses/list'), 'label'=>"Dépenses", 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.depenses_folder.depenses', ['depenses' => $depenses,
        'current_user' => $request->user(), 'autorisation'=>$autorisation, 'breadcrumbs'=>$breadcrumbs]);
    }

    public function add_new_depense(Request $request)
    {
        $current_user = $request->user();
        $caisse = Caisse::with('departement')->where("departement_id", $current_user->departement_id)->first();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/depenses/list'), 'label'=>"Dépenses", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/depenses/add_new_depense'), 'label'=>"Ajouter", 'icon'=>'bi-plus-circle fs-5'],
        ];
        return view('private_layouts.depenses_folder.adddepense', compact('caisse', 'current_user', "breadcrumbs"));
    }

    public function generate_depense_code()
    {
        $faker = Faker::create();
        do {
            $code = 'DEP_'. $faker->numerify('######');
            $codeExiste = Depense::where('code_de_depense', $code)->exists();
        } while ($codeExiste);

        return response()->json($code);
    }

    public function save_new_depense(Request $request)
    {
        $request->validate([
            'motif'=> 'required|max:255',
            'code_de_depense' => ['required', Rule::unique(Depense::class)],
            'montant'=> ['required', 'numeric'],
            'source_a_imputer_id'=>['required'],
        ], [
            'montant.required'=>'Ce champs est obligatoire',
            'montant.numeric'=>'Ce champs doit être numérique',
            'source_a_imputer_id.required'=>'Ce champs est obligatoire',
            'motif.required'=>'Ce champs est obligatoire',
            'code_de_depense.required'=>'Ce champs est obligatoire',
            'code_de_depense.unique'=>"Le code de dépense n'est pas unique"
        ]);

        $depense = Depense::create([
            'departement_id'=>$request->user()->departement_id,
            'requerant_id'=>$request->user()->id,
            'requerant'=>$request->user()->nom.' '.$request->user()->postnom.' '.$request->user()->prenom,
            'source_a_imputer_id' => $request->source_a_imputer_id,
            'code_de_depense'=>$request->code_de_depense,
            'context'=>$request->context,
            'motif'=>$request->motif,
            'montant'=>$request->montant,
            'statut'=>'en attente de validation',
        ]);

        $autorisations = AutorisationSpeciale::where('table_name', 'depenses')->get();

        $userstonotify = [];
        foreach ($autorisations as $autorisation) {
            $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
            if (!is_null($autorisations_speciales)) {
                if (in_array("peux valider une dépense", $autorisations_speciales)) {
                    $user = User::find($autorisation->user_id);
                    if ($user->departement_id == $depense->departement_id) {
                        $userstonotify[] = $user;
                    }
                }
            }
        }

        $url = route('depense.afficher', $depense->id);

        if ($userstonotify) {
            $this->triggerNotification($depense, 'App\Models\Depense', 'Demande de validation',
        "La dépense codée " . $depense->code_de_depense . " est en attente de validation",$url, $userstonotify) ;
        }

        return redirect()->route('depense.list', ['current_user' => $request->user()])->with('success', "la dépense a été soumise");
    }

    public function edit_depense($depense_id, Request $request)
    {
        $current_user = $request->user();
        $caisse = Caisse::with('departement')->where("departement_id", $current_user->departement_id)->first();
        $depense = Depense::find($depense_id);

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/depenses/list'), 'label'=>"Dépenses", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/depenses/edit_depense'), 'label'=>"Editer", 'icon'=>'bi-pencil-square fs-5'],
        ];
        return view('private_layouts.depenses_folder.editdepense', compact("current_user", "caisse",
        "depense", "breadcrumbs"));
    }

    public function save_edit_depense($depense_id, Request $request)
    {
        $request->validate([
            'context' => ['required'],
            'motif' => ['required'],
            'code_de_depense' => ['required'],
            'montant' => ['required', 'numeric'],
            'source_a_imputer_id' => ['required'],
        ], [
            'montant.required' => 'Ce champs est obligatoire',
            'montant.numeric' => 'Ce champs doit être numérique',
            'source_a_imputer_id.required' => 'Ce champs est obligatoire',
            'context.required' => 'Ce champs est obligatoire',
            'motif.required' => 'Ce champs est obligatoire',
            'code_de_depense.required' => 'Ce champs est obligatoire',
        ]);

        $depense = Depense::find($depense_id);
        $depense->source_a_imputer_id = $request->source_a_imputer_id;
        $depense->code_de_depense = $request->code_de_depense;
        $depense->context = $request->context;
        $depense->motif = $request->motif;
        $depense->montant = $request->montant;
        $depense->update();
        return redirect()->route('depense.afficher', $depense_id)->with('success', 'les modifications ont été enregistrés');
    }

    public function afficher_la_depense($depense_id, Request $request):View
    {
        $depense = Depense::with(['departement', 'caisse'])->find($depense_id);
        $autorisation = Autorisations::where('table_name', 'depenses')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisations_speciales = AutorisationSpeciale::where('user_id', $request->user()->id)->where('table_name', 'depenses')->first();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/depenses/list'), 'label'=>"Dépenses", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/depenses/afficher'), 'label'=>"Afficher", 'icon'=>'bi-eye fs-5'],
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
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_id')) COLLATE utf8_general_ci = ?", [$depense_id])
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_type')) COLLATE utf8_general_ci = ?", get_class($depense))->first();

            if ($notification) {
                $notification->markAsRead();
            }
        }

        return view('private_layouts.depenses_folder.display_depenses', ['depense' => $depense,
        'current_user' => $request->user(), 'autorisation'=>$autorisation,
        'autorisations_speciales'=>$autorisations_speciales, "breadcrumbs"=>$breadcrumbs]);
    }

    public function traitement_depense($depense_id, Request $request)
    {
        $depense = Depense::find($depense_id);
        $action = $request->input('action');
        $message = "";
        if ($action == 'mettre en attente') {
            $depense->statut = 'en attente';
            $message = "la dépense a été mise en attente";

            $userstonotify = [];
            $user = User::find($depense->requerant_id);
            if (!is_null($user)) {
                $userstonotify[] = $user;
            }

            $url = route('depense.afficher', $depense->id);

            if ($userstonotify) {
                $this->triggerNotification($depense, 'App\Models\Depense', 'Mise en attente',
            "Votre dépense codée " . $depense->code_de_depense . " a été mise en attente",$url, $userstonotify) ;
            }
        }elseif ($action == 'valider'){
            $depense->statut = 'en attente de confirmation';
            $message = "la dépense a été soumise et est en attente de confirmation";

            $autorisations = AutorisationSpeciale::where('table_name', 'depenses')->get();

            $userstonotify = [];
            foreach ($autorisations as $autorisation) {
                $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
                if (!is_null($autorisations_speciales)) {
                    if (in_array("peux confirmer une dépense", $autorisations_speciales)) {
                        $user = User::find($autorisation->user_id);
                        if ($user->departement_id == $depense->departement_id) {
                            $userstonotify[] = $user;
                        }
                    }
                }
            }

            $url = route('depense.afficher', $depense->id);

            if ($userstonotify) {
                $this->triggerNotification($depense, 'App\Models\Depense', 'Demande de confirmation',
            "La dépense codée " . $depense->code_de_depense . " est en attente de confirmation",$url, $userstonotify) ;
            }

            $userstonotify = [];
            $user = User::find($depense->requerant_id);
            if (!is_null($user)) {
                $userstonotify[] = $user;
            }

            $url = route('depense.afficher', $depense->id);

            if ($userstonotify) {
                $this->triggerNotification($depense, 'App\Models\Depense', 'Confirmation de validation',
            "Votre dépense codée " . $depense->code_de_depense . " a été validé et est maintenant en attente de confirmation",$url, $userstonotify) ;
            }
        }elseif ($action == 'rejeter'){
            $depense->statut = 'rejeté';
            $message = "la dépense a été rejeté";

            $userstonotify = [];
            $user = User::find($depense->requerant_id);
            if (!is_null($user)) {
                $userstonotify[] = $user;
            }

            $url = route('depense.afficher', $depense->id);

            if ($userstonotify) {
                $this->triggerNotification($depense, 'App\Models\Depense', 'Dépense rejetée',
            "Votre dépense codée " . $depense->code_de_depense . " a été rejetée",$url, $userstonotify) ;
            }
        }elseif ($action == 'confirmer'){
            $depense->statut = 'validé';
            $message = "la dépense a été validée";

            $userstonotify = [];
            $user = User::find($depense->requerant_id);
            if (!is_null($user)) {
                $userstonotify[] = $user;
            }

            $url = route('depense.afficher', $depense->id);

            if ($userstonotify) {
                $this->triggerNotification($depense, 'App\Models\Depense', "Confirmation d'approbation",
            "Votre dépense codée " . $depense->code_de_depense . " a été approuvé",$url, $userstonotify) ;
            }
        }elseif ($action == 'soumettre'){
            $depense->statut = 'en attente de validation';
            $message = "la dépense a été soumise";

            $autorisations = AutorisationSpeciale::where('table_name', 'depenses')->get();

            $userstonotify = [];
            foreach ($autorisations as $autorisation) {
                $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
                if (!is_null($autorisations_speciales)) {
                    if (in_array("peux valider une dépense", $autorisations_speciales)) {
                        $user = User::find($autorisation->user_id);
                        if ($user->departement_id == $depense->departement_id) {
                            $userstonotify[] = $user;
                        }
                    }
                }
            }

            $url = route('depense.afficher', $depense->id);

            if ($userstonotify) {
                $this->triggerNotification($depense, 'App\Models\Depense', 'Demande de validation',
            "La dépense codée " . $depense->code_de_depense . " est en attente de validation",$url, $userstonotify) ;
            }
        }
        $depense->date_de_traitement = \Symfony\Component\Clock\now();
        $depense->update();

        return Redirect()->back()->with('status', $message);
    }

    public function supprimer_depense($id)
    {
        $depense = Depense::find($id);
        $depense->delete();
        return Redirect::route('depense.list')->with('status', 'la dépense a été supprimé');
    }

    public function annuler_action($id)
    {
        $depense = Depense::find($id);
        $depense->statut = "en attente de validation";
        $depense->update();

        $userstonotify = [];
        $user = User::find($depense->requerant_id);
        if (!is_null($user)) {
            $userstonotify[] = $user;
        }

        $url = route('depense.afficher', $depense->id);

        if ($userstonotify) {
            $this->triggerNotification($depense, 'App\Models\Depense', "Annulation d'opération",
        "La dernière action sur votre dépense codée " . $depense->code_de_depense . " a été annulé",$url, $userstonotify) ;
        }

        return Redirect::route('depense.afficher', $depense->id)->with('status', "l'action a été annulé");
    }
}
