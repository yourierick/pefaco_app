<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\RapportInspection;
use App\Models\User;
use Illuminate\View\View;
use App\CustomSystemNotificationTrait;

class RapportInspectionController extends Controller
{
    use CustomSystemNotificationTrait;
    public function list_des_rapports(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_inspections')->where('user_id', $request->user()->id)->first();
        $rapports = RapportInspection::with('rapporteur')->where('statut', 'validé')->get();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportinspection/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.rapport_inspection.list_des_rapports', ['current_user'=>$request->user(),
        'rapports'=>$rapports, 'autorisation'=>$autorisation,
        'autorisation_speciale'=>$autorisation_speciale, "breadcrumbs"=>$breadcrumbs]);
    }

    public function voir_mes_drafts(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportInspection::with('rapporteur')->where('statut', 'draft')->where('rapporteur_id', $request->user()->id)->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_inspections')->where('user_id', $request->user()->id)->first();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportinspection/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportinspection/voir_mes_drafts'), 'label'=>'Mes drafts', 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.rapport_inspection.list_des_rapports', compact("autorisation",
        "rapports", "current_user", "autorisation_speciale", "breadcrumbs"));
    }

    public function les_attentes_en_validation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportInspection::with('rapporteur')->where('statut', 'en attente de validation')->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_inspections')->where('user_id', $request->user()->id)->first();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportinspection/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportinspection/les_attentes_en_validation'), 'label'=>'Rapports en attente', 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.rapport_inspection.list_des_rapports', compact("autorisation_speciale",
        "autorisation", "current_user", "rapports", "breadcrumbs"));
    }

    public function ajouter_nouveau_rapport(Request $request):View
    {
        $current_user = $request->user();
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_inspections')->where('user_id', $request->user()->id)->first();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportinspection/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportinspection/ajouter_nouveau_rapport'), 'label'=>'Ajouter', 'icon'=>'bi-plus-circle fs-5'],
        ];
        return view('private_layouts.rapport_inspection.ajouter_un_rapport', compact("current_user",
        "autorisation_speciale", 'autorisation', "breadcrumbs"));
    }

    public function sauvegarder_le_rapport(Request $request)
    {
        $validated = $request->validate([
            'rapporteur_id'=>['required'],
            'mois'=>['required'],
            'contexte'=>['required'],
            'paroisses_concernees'=>['required'],
            'constats'=>['required'],
            'conclusions'=>['required'],
            'difficultes_rencontrees'=>['required'],
            'recommandations'=>['required'],
        ], [
            'mois.required'=>'ce champs est obligatoire',
            'contexte.required'=>'ce champs est obligatoire',
            'paroisses_concernees.required'=>'ce champs est obligatoire',
            'constats.required'=>'ce champs est obligatoire',
            'conclusions.required'=>'ce champs est obligatoire',
            'difficultes_rencontrees.required'=>"Aucune référence n'a été renseigné",
            'recommandations.required'=>'ce champs est obligatoire',
        ]);


        $action = $request->input('action');
        $message = '';
        if ($action == 'draft') {
            $statut = 'draft';
            $message = 'le rapport a été enregistré comme draft';
        }else {
            $statut = "en attente de validation";
            $message = "le rapport a été soumis et est en attente de validation";
        }

        $mois = $validated['mois']."-01";
        $rapport = RapportInspection::create([
            'rapporteur_id'=>$request->get('rapporteur_id'),
            'mois'=>$mois,
            'contexte'=>$request->get('contexte'),
            'paroisses_concernees'=>$request->get('paroisses_concernees'),
            'constats'=>$request->get('constats'),
            'conclusions'=>$request->get('conclusions'),
            'difficultes_rencontrees'=>$request->get('difficultes_rencontrees'),
            'recommandations'=>$request->get('recommandations'),
            'statut'=>$statut,
        ]);

        if ($statut === "en attente de validation") {
            $autorisations = AutorisationSpeciale::where('table_name', 'rapport_inspections')->get();

            $userstonotify = [];
            foreach ($autorisations as $autorisation) {
                $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
                if (!is_null($autorisations_speciales)) {
                    if (in_array("peux valider", $autorisations_speciales)) {
                        $user = User::find($autorisation->user_id);
                        $userstonotify[] = $user;
                    }
                }
            }

            $url = route('rapportinspection.afficher_rapport', $rapport->id);

            if ($userstonotify) {
                $this->triggerNotification($rapport, 'App\Models\RapportInspection', 'Demande de validation',
            "Vous avez un nouveau rapport d'inspection en attente de validation",$url, $userstonotify) ;
            }
        }

        return redirect()->route('rapportinspection.list_des_rapports')->with('success', $message);
    }

    public function afficher_rapport($rapport_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id',
            $request->user()->groupe_utilisateur_id)->first();
        $autorisationspeciales = AutorisationSpeciale::where('table_name',
            'rapport_inspections')->where('user_id', $request->user()->id)->first();
        $rapport = RapportInspection::with("rapporteur")->find($rapport_id);
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportinspection/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportinspection/afficher_rapport'), 'label'=>'Afficher', 'icon'=>'bi-eye fs-5'],
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
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_id')) COLLATE utf8_general_ci = ?", [$rapport_id])
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_type')) COLLATE utf8_general_ci = ?", get_class($rapport))->first();

            if ($notification) {
                $notification->markAsRead();
            }
        }

        return view('private_layouts.rapport_inspection.afficher_un_rapport', ['rapport'=>$rapport,
        'current_user'=>$request->user(), 'autorisation'=>$autorisation,
        'autorisation_speciale'=>$autorisationspeciales, "breadcrumbs"=>$breadcrumbs]);
    }

    public function traitement_du_rapport($rapport_id, Request $request)
    {
        $rapport = RapportInspection::find($rapport_id);
        $action = $request->input('action');
        $message = '';
        $statut = 'draft';

        if ($action == 'validation') {
            $statut = 'validé';
            $message = 'Le rapport a été validé';
            $rapport->statut = $statut;
            $rapport->update();

            $autorisations = AutorisationSpeciale::where('table_name', 'rapport_inspections')->get();

            $userstonotify = [];
            $user = User::find($rapport->rapporteur_id);

            if (!is_null($user)) {
                $userstonotify[] = $user;
            }

            $url = route('rapportinspection.afficher_rapport', $rapport->id);

            if ($userstonotify) {
                $this->triggerNotification($rapport, 'App\Models\RapportInspection', 'Demande de validation',
            "Votre rapport d'inspection a été validé, cliquez pour voir",$url, $userstonotify) ;
            }
        }

        if ($action == 'soumettre_pour_validation') {
            $statut = 'en attente de validation';
            $message = 'Le rapport a été soumis et est en attente de validation';
            $rapport->statut = $statut;
            $rapport->update();

            $autorisations = AutorisationSpeciale::where('table_name', 'rapport_inspections')->get();

            $userstonotify = [];
            foreach ($autorisations as $autorisation) {
                $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
                if (!is_null($autorisations_speciales)) {
                    if (in_array("peux valider", $autorisations_speciales)) {
                        $user = User::find($autorisation->user_id);
                        $userstonotify[] = $user;
                    }
                }
            }

            $url = route('rapportinspection.afficher_rapport', $rapport->id);

            if ($userstonotify) {
                $this->triggerNotification($rapport, 'App\Models\RapportInspection', 'Demande de validation',
            "Vous avez un nouveau rapport d'inspection en attente de validation",$url, $userstonotify) ;
            }
        }

        return redirect()->back()->with('success', $message);
    }

    public function edit_le_rapport($rapport_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_inspections')->where('user_id', $request->user()->id)->first();
        $rapport = RapportInspection::find($rapport_id);
        $current_user = $request->user();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportinspection/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportinspection/edit_le_rapport'), 'label'=>'Editer', 'icon'=>'bi-pencil-square fs-5'],
        ];
        return view('private_layouts.rapport_inspection.editer_un_rapport', compact("rapport",
        "autorisation", "autorisation_speciale", "current_user", "breadcrumbs"));
    }

    public function save_edition_rapport($rapport_id, Request $request)
    {
        $rapport = RapportInspection::find($rapport_id);
        $validated = $request->validate([
            'rapporteur_id'=>['required'],
            'mois'=>['required'],
            'contexte'=>['required'],
            'paroisses_concernees'=>['required'],
            'constats'=>['required'],
            'conclusions'=>['required'],
            'difficultes_rencontrees'=>['required'],
            'recommandations'=>['required'],
        ], [
            'mois.required'=>'ce champs est obligatoire',
            'contexte.required'=>'ce champs est obligatoire',
            'paroisses_concernees.required'=>'ce champs est obligatoire',
            'constats.required'=>'ce champs est obligatoire',
            'conclusions.required'=>'ce champs est obligatoire',
            'difficultes_rencontrees.required'=>"Aucune référence n'a été renseigné",
            'recommandations.required'=>'ce champs est obligatoire',
        ]);

        $mois = $validated['mois']."-01";
        $rapport->rapporteur_id = $request->get('rapporteur_id');
        $rapport->mois = $mois;
        $rapport->contexte = $request->get('contexte');
        $rapport->paroisses_concernees = $request->get('paroisses_concernees');
        $rapport->constats = $request->get('constats');
        $rapport->conclusions = $request->get('conclusions');
        $rapport->difficultes_rencontrees = $request->get('difficultes_rencontrees');
        $rapport->recommandations = $request->get('recommandations');
        $rapport->update();

        return redirect()->route('rapportinspection.afficher_rapport', $rapport_id)->with('success', 'les mises à jours ont été appliqués');
    }

    public function supprimer_rapport(Request $request)
    {
        $rapport_id = $request->rapport_id;
        $rapport = RapportInspection::find($rapport_id);
        $rapport->delete();
        return redirect()->back()->with('success', 'le rapport a été supprimé');
    }
}
