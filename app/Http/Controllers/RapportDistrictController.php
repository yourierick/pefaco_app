<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RapportDistrictController extends Controller
{
    public function list_des_rapports(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_mensuels')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_mensuels')->where('user_id', $request->user()->id)->first();
        $rapports = [];
        $current_user = User::with("groupe_utilisateur")->find($request->user()->id);
        if ($autorisation){
            if ($autorisation->autorisation_en_lecture){
                if (in_array('peux voir tous les rapports', json_decode($autorisation->autorisation_en_lecture, true))) {
                    $rapports = RapportMensuel::with("user", "departement")->where('statut', 'validé')->get();
                }else {
                    $rapports = RapportMensuel::with("user", "departement")->where('statut', 'validé')->where("departement_id", $current_user->departement_id)->get();
                }
            }
        }
        return view('private_layouts.rapport_mensuel.list_des_rapports', compact("autorisation",
            "current_user", "autorisation_speciale", "rapports"));
    }

    public function voir_mes_drafts(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_mensuels')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportMensuel::with("user", "departement")->where('statut', 'draft')->where('rapporteur_principal_id', $request->user()->id)->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_mensuels')->where('user_id', $request->user()->id)->first();
        return view('private_layouts.rapport_mensuel.list_des_rapports', compact("autorisation", "rapports", "current_user", "autorisation_speciale"));
    }

    public function les_attentes_en_completion(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_mensuels')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportMensuel::with("user", "departement")->where('statut', 'en attente de completion')->where('departement_id', $request->user()->departement_id)->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_mensuels')->where('user_id', $request->user()->id)->first();
        return view('private_layouts.rapport_mensuel.list_des_rapports', compact("rapports", "autorisation", "current_user", "autorisation_speciale"));
    }

    public function les_attentes_en_validation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_mensuels')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportMensuel::where('statut', 'en attente de validation')->where('departement_id', $request->user()->departement_id)->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_mensuels')->where('user_id', $request->user()->id)->first();
        return view('private_layouts.rapport_mensuel.list_des_rapports', compact("autorisation_speciale", "autorisation", "current_user", "rapports"));
    }

    public function ajouter_nouveau_rapport(Request $request):View
    {
        $current_user = $request->user();
        $autorisation = Autorisations::where('table_name', 'rapport_mensuels')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_mensuels')->where('user_id', $request->user()->id)->first();
        return view('private_layouts.rapport_mensuel.ajouter_un_rapport', compact("current_user", "autorisation_speciale", 'autorisation'));
    }

    public function chargement_rapport_semaine_et_caisse($mois, $departement_id) {
        [$annee, $mois] = explode('-', $mois);
        $tous_les_cultes = RapportDeCulte::where('departement_id', $departement_id)->where("statut", "validé")->whereYear('date',
            $annee)->whereMonth('date', $mois)->get();
        $nombre_total_des_cultes_tenus = $tous_les_cultes->count();
        $moyenne_mensuelle_des_pers_dans_le_culte = $tous_les_cultes->map(function ($cultes) {
            return $cultes->total_pers_dans_le_culte;
        })->average() ?? 0;
        $moyenne_mensuelle_des_hommes = $tous_les_cultes->map(function ($cultes) {
            return $cultes->total_papas;
        })->average() ?? 0;
        $moyenne_mensuelle_des_mamans = $tous_les_cultes->map(function ($cultes) {
            return $cultes->total_mamans;
        })->average() ?? 0;
        $moyenne_mensuelle_des_jeunes = $tous_les_cultes->map(function ($cultes) {
            return $cultes->total_jeunes;
        })->average() ?? 0;
        $moyenne_mensuelle_des_enfants = $tous_les_cultes->map(function ($cultes) {
            return $cultes->total_enfants;
        })->average() ?? 0;

        $caisse = Caisse::where("departement_id", $departement_id)->first();
        $solde_caisse = $caisse ? $caisse->montant_total_net:0;


        return response()->json(compact("nombre_total_des_cultes_tenus",
            "moyenne_mensuelle_des_pers_dans_le_culte", "moyenne_mensuelle_des_hommes",
        "moyenne_mensuelle_des_mamans", "moyenne_mensuelle_des_jeunes", "moyenne_mensuelle_des_enfants",
        "solde_caisse"));
    }

    public function sauvegarder_le_rapport(Request $request)
    {
        $validated = $request->validate([
            'departement_id'=>['required', 'numeric'],
            'mois_de_rapportage'=>['required', 'date_format:Y-m'],
            'objectifs'=>['required'],
            'vision'=>['required'],
            'mission'=>['required'],
            'situation_actuelle'=>['required'],
            'difficultes_defis'=>['required'],
            'recommandations'=>['required'],
        ], [
            'departement_id.required'=>'ce champs est obligatoire',
            'mois_de_rapportage.required'=>'ce champs est obligatoire',
            'objectifs.required'=>'ce champs est obligatoire',
            'vision.required'=>'ce champs est obligatoire',
            'mission.required'=>"Aucune référence n'a été renseigné",
            'situation_actuelle.required'=>'ce champs est obligatoire',
            'difficultes_defis.required'=>'ce champs est obligatoire',
            'recommandations.required'=>'ce champs est obligatoire',
        ]);

        $date = $validated['mois_de_rapportage']."-01";

        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_mensuels')->where('user_id', $request->user()->id)->first();

        if(!is_null($autorisation_speciale)) {
            if($autorisation_speciale->autorisation_speciale) {
                if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true))) {
                    $request->validate([
                        "situation_caisse"=>['required', 'numeric'],
                    ], [
                        'situation_caisse.required'=>"ce champs est obligatoire",
                        'situation_caisse.numeric'=>"seules les valeurs numériques sont acceptées",
                    ]);
                }
            }
        }

        $data = request()->all();
        $previsions_mois_de_rapportage = [];
        $realisations = [];
        $previsions_mois_prochain = [];

        if (array_key_exists('previsions_pour_ce_mois', $data)) {
            $previsions_mois_de_rapportage = array_filter($data['previsions_pour_ce_mois']);
        }

        if (array_key_exists('realisations_de_ce_mois', $data)) {
            $realisations = array_filter($data['realisations_de_ce_mois']);
        }

        if (array_key_exists('previsions_mois_prochain', $data)) {
            $previsions_mois_prochain = array_filter($data['previsions_mois_prochain']);
        }

        $action = $request->input('action');
        $message = '';
        $statut = 'draft';

        if ($action == 'soumission_validation') {
            $statut = 'en attente de validation';

            $rapport = RapportMensuel::create([
                'departement_id'=>$request->get('departement_id'),
                'mois_de_rapportage'=>$date,
                'rapporteur_principal_id'=>$request->user()->id,
                'objectifs'=>$request->get('objectifs'),
                'vision'=>$request->get('vision'),
                'mission'=>$request->get('mission'),
                'previsions_pour_ce_mois'=>json_encode($previsions_mois_de_rapportage),
                'realisations_de_ce_mois'=>json_encode($realisations),
                'autres_a_rapporter'=>$request->get('autres_a_rapporter'),
                'situation_actuelle'=>$request->get('situation_actuelle'),
                'situation_de_la_logistique'=>$request->get('situation_de_la_logistique'),
                'nombre_des_cultes_tenus'=>$request->get('nombre_des_cultes_tenus', 0),
                'effectif_total'=>$request->get('effectif_total', 0),
                'effectif_hommes'=>$request->get('effectif_hommes', 0),
                'effectif_femmes'=>$request->get('effectif_femmes', 0),
                'effectif_jeunes'=>$request->get('effectif_jeunes', 0),
                'effectif_enfants'=>$request->get('effectif_enfants', 0),
                'moyenne_mensuel_total'=>$request->get('moyenne_mensuel_total', 0),
                'moyenne_mensuel_hommes'=>$request->get('moyenne_mensuel_hommes', 0),
                'moyenne_mensuel_femmes'=>$request->get('moyenne_mensuel_femmes', 0),
                'moyenne_mensuel_jeunes'=>$request->get('moyenne_mensuel_jeunes', 0),
                'moyenne_mensuel_enfants'=>$request->get('moyenne_mensuel_enfants', 0),
                'nombre_des_personnes_baptises'=>$request->get('nombre_des_personnes_baptises', 0),
                'situation_caisse'=>$request->get('situation_caisse', 0),
                'autres_contributions_a_renseigner'=>$request->get('autres_contributions_a_renseigner'),
                'difficultes_defis'=>$request->get('difficultes_defis'),
                'recommandations'=>$request->get('recommandations'),
                'previsions_mois_prochain'=>json_encode($previsions_mois_prochain),
                'statut'=>$statut,
            ]);
            $message = 'Le rapport a été soumis et est en attente de validation';
        }else {
            if ($action == 'soumission_completion') {
                $statut = 'en attente de complétion';
                $message = 'Le rapport a été soumis à la caisse pour sa complétion';
            }
            if ($action == 'draft') {
                $statut = 'draft';
                $message = 'Le rapport a été enregistré en tant que draft';
            }

            $rapport = RapportMensuel::create([
                'departement_id'=>$request->get('departement_id'),
                'mois_de_rapportage'=>$date,
                'rapporteur_principal_id'=>$request->user()->id,
                'objectifs'=>$request->get('objectifs'),
                'vision'=>$request->get('vision'),
                'mission'=>$request->get('mission'),
                'previsions_pour_ce_mois'=>json_encode($previsions_mois_de_rapportage),
                'realisations_de_ce_mois'=>json_encode($realisations),
                'autres_a_rapporter'=>$request->get('autres_a_rapporter'),
                'situation_actuelle'=>$request->get('situation_actuelle'),
                'situation_de_la_logistique'=>$request->get('situation_de_la_logistique'),
                'nombre_des_cultes_tenus'=>$request->get('nombre_des_cultes_tenus', 0),
                'effectif_total'=>$request->get('effectif_total', 0),
                'effectif_hommes'=>$request->get('effectif_hommes', 0),
                'effectif_femmes'=>$request->get('effectif_femmes', 0),
                'effectif_jeunes'=>$request->get('effectif_jeunes', 0),
                'effectif_enfants'=>$request->get('effectif_enfants', 0),
                'moyenne_mensuel_total'=>$request->get('moyenne_mensuel_total', 0),
                'moyenne_mensuel_hommes'=>$request->get('moyenne_mensuel_hommes', 0),
                'moyenne_mensuel_femmes'=>$request->get('moyenne_mensuel_femmes', 0),
                'moyenne_mensuel_jeunes'=>$request->get('moyenne_mensuel_jeunes', 0),
                'moyenne_mensuel_enfants'=>$request->get('moyenne_mensuel_enfants', 0),
                'nombre_des_personnes_baptises'=>$request->get('nombre_des_personnes_baptises', 0),
                'difficultes_defis'=>$request->get('difficultes_defis'),
                'recommandations'=>$request->get('recommandations'),
                'previsions_mois_prochain'=>json_encode($previsions_mois_prochain),
                'statut'=>$statut,
            ]);
        }
        return redirect()->route('rapportmensuel.list_des_rapports')->with('success', $message);
    }

    public function afficher_rapport_mensuel($rapport_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_mensuels')->where('groupe_id',
            $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name',
            'rapport_mensuels')->where('user_id', $request->user()->id)->first();
        $rapport = RapportMensuel::with("departement", "user")->find($rapport_id);

        $caisse = Caisse::where("departement_id", $rapport->departement->id)->first();
        $mois = $rapport->mois_de_rapportage->month;
        $annee = $rapport->mois_de_rapportage->year;

        $releve_des_transactions_mensuelles = Transactions::where("caisse_id", $caisse->id)->whereYear('date_de_la_transaction', $annee)->whereMonth('date_de_la_transaction', $mois)->get();
        $current_user = $request->user();
        return view('private_layouts.rapport_mensuel.afficher_un_rapport', compact("autorisation", "autorisation_speciale",
        "rapport", "caisse", "releve_des_transactions_mensuelles", "current_user"));
    }

    public function edit_le_rapport($rapport_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_mensuels')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_mensuels')->where('user_id', $request->user()->id)->first();
        $rapport = RapportMensuel::find($rapport_id);
        $current_user = $request->user();
        return view('private_layouts.rapport_mensuel.editer_un_rapport', compact("rapport", "autorisation", "autorisation_speciale", "current_user"));
    }


    public function save_edition_rapport($rapport_id, Request $request)
    {
        $rapport = RapportMensuel::find($rapport_id);
        $validated = $request->validate([
            'departement_id'=>['required', 'numeric'],
            'mois_de_rapportage'=>['required', 'date_format:Y-m'],
            'objectifs'=>['required'],
            'vision'=>['required'],
            'mission'=>['required'],
            'situation_actuelle'=>['required'],
            'difficultes_defis'=>['required'],
            'recommandations'=>['required'],
        ], [
            'departement_id.required'=>'ce champs est obligatoire',
            'mois_de_rapportage.required'=>'ce champs est obligatoire',
            'objectifs.required'=>'ce champs est obligatoire',
            'vision.required'=>'ce champs est obligatoire',
            'mission.required'=>"Aucune référence n'a été renseigné",
            'situation_actuelle.required'=>'ce champs est obligatoire',
            'difficultes_defis.required'=>'ce champs est obligatoire',
            'recommandations.required'=>'ce champs est obligatoire',
        ]);

        $date = $validated['mois_de_rapportage']."-01";

        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_mensuels')->where('user_id', $request->user()->id)->first();

        if(!is_null($autorisation_speciale)) {
            if($autorisation_speciale->autorisation_speciale) {
                if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true))) {
                    $request->validate([
                        "situation_caisse"=>['required', 'numeric'],
                    ], [
                        'situation_caisse.required'=>"ce champs est obligatoire",
                        'situation_caisse.numeric'=>"seules les valeurs numériques sont acceptées",
                    ]);

                    $rapport->situation_caisse=$request->get('situation_caisse', 0);
                    $rapport->autres_contributions_a_renseigner=$request->get('autres_contributions_a_renseigner');
                }
            }
        }

        $data = request()->all();
        $previsions_mois_de_rapportage = [];
        $realisations = [];
        $previsions_mois_prochain = [];

        if (array_key_exists('previsions_pour_ce_mois', $data)) {
            $previsions_mois_de_rapportage = array_filter($data['previsions_pour_ce_mois']);
        }

        if (array_key_exists('realisations_de_ce_mois', $data)) {
            $realisations = array_filter($data['realisations_de_ce_mois']);
        }

        if (array_key_exists('previsions_mois_prochain', $data)) {
            $previsions_mois_prochain = array_filter($data['previsions_mois_prochain']);
        }

        $rapport->departement_id=$request->get('departement_id');
        $rapport->mois_de_rapportage=$date;
        $rapport->rapporteur_principal_id=$request->user()->id;
        $rapport->objectifs=$request->get('objectifs');
        $rapport->vision=$request->get('vision');
        $rapport->mission=$request->get('mission');
        $rapport->previsions_pour_ce_mois=json_encode($previsions_mois_de_rapportage);
        $rapport->realisations_de_ce_mois=json_encode($realisations);
        $rapport->autres_a_rapporter=$request->get('autres_a_rapporter');
        $rapport->situation_actuelle=$request->get('situation_actuelle');
        $rapport->situation_de_la_logistique=$request->get('situation_de_la_logistique');
        $rapport->nombre_des_cultes_tenus=$request->get('nombre_des_cultes_tenus', 0);
        $rapport->effectif_total=$request->get('effectif_total', 0);
        $rapport->effectif_hommes=$request->get('effectif_hommes', 0);
        $rapport->effectif_femmes=$request->get('effectif_femmes', 0);
        $rapport->effectif_jeunes=$request->get('effectif_jeunes', 0);
        $rapport->effectif_enfants=$request->get('effectif_enfants', 0);
        $rapport->moyenne_mensuel_total=$request->get('moyenne_mensuel_total', 0);
        $rapport->moyenne_mensuel_hommes=$request->get('moyenne_mensuel_hommes', 0);
        $rapport->moyenne_mensuel_femmes=$request->get('moyenne_mensuel_femmes', 0);
        $rapport->moyenne_mensuel_jeunes=$request->get('moyenne_mensuel_jeunes', 0);
        $rapport->moyenne_mensuel_enfants=$request->get('moyenne_mensuel_enfants', 0);
        $rapport->nombre_des_personnes_baptises=$request->get('nombre_des_personnes_baptises', 0);
        $rapport->difficultes_defis=$request->get('difficultes_defis');
        $rapport->recommandations=$request->get('recommandations');
        $rapport->previsions_mois_prochain=json_encode($previsions_mois_prochain);

        $rapport->update();

        return redirect()->route('rapportmensuel.afficher_rapport_mensuel', $rapport_id)->with('success', 'les mises à jours ont été appliqués');
    }

    public function supprimer_rapport(Request $request)
    {
        $rapport_id = $request->rapport_id;
        $rapport = RapportMensuel::find($rapport_id);
        $rapport->delete();
        return redirect()->back()->with('success', 'le rapport a été supprimé');
    }

    public function traitement_du_rapport($rapport_id, Request $request)
    {
        $rapport = RapportMensuel::find($rapport_id);
        $action = $request->input('action');
        $message = '';
        $statut = 'draft';
        if ($action == 'soumission') {
            $statut = 'en attente de complétion';
            $message = 'Le rapport a été soumis à la caisse pour sa complétion';
        }

        if ($action == 'validation') {
            $statut = 'validé';
            $message = 'Le rapport a été validé';
        }

        if ($action == 'soumettre_pour_validation') {
            $statut = 'en attente de validation';
            $message = 'Le rapport a été soumis et est en attente de validation';
        }
        $rapport->statut = $statut;
        $rapport->update();
        return redirect()->back()->with('success', $message);
    }
}
