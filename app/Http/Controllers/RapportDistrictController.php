<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RapportDeDistrict;
use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\Caisse;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class RapportDistrictController extends Controller
{
    public function list_des_rapports(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_districts')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_districts')->where('user_id', $request->user()->id)->first();
        $current_user = User::with("groupe_utilisateur")->find($request->user()->id);
        $rapports = RapportDeDistrict::with("rapporteur")->where('statut', 'validé')->get();
        
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportdistrict/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.rapport_district.list_des_rapports', compact("autorisation",
            "current_user", "autorisation_speciale", "rapports", "breadcrumbs"));
    }

    public function voir_mes_drafts(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_districts')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportDeDistrict::with("rapporteur")->where('statut', 'draft')->where('rapporteur_id', $request->user()->id)->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_districts')->where('user_id', $request->user()->id)->first();
        
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportdistrict/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportdistrict/voir_mes_drafts'), 'label'=>'Mes drafts', 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.rapport_district.list_des_rapports', compact("autorisation", 
        "rapports", "current_user", "autorisation_speciale", "breadcrumbs"));
    }

    public function les_attentes_en_validation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_districts')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportDeDistrict::with('rapporteur')->where('statut', 'en attente de validation')->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_districts')->where('user_id', $request->user()->id)->first();
        
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportdistrict/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportdistrict/les_attentes_en_validation'), 'label'=>'Rapports en attente', 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.rapport_district.list_des_rapports', compact("autorisation_speciale", 
        "autorisation", "current_user", "rapports", "breadcrumbs"));
    }

    public function les_attentes_en_approbation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_districts')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportDeDistrict::with('rapporteur')->where('statut', "en attente d'approbation")->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_districts')->where('user_id', $request->user()->id)->first();
        
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportdistrict/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportdistrict/les_attentes_en_approbation'), 'label'=>'Rapports en attente', 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.rapport_district.list_des_rapports', compact("autorisation_speciale", 
        "autorisation", "current_user", "rapports", "breadcrumbs"));
    }

    public function les_attentes_en_confirmation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_districts')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportDeDistrict::with('rapporteur')->where('statut', 'en attente de confirmation')->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_districts')->where('user_id', $request->user()->id)->first();
        
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportdistrict/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportdistrict/les_attentes_en_confirmation'), 'label'=>'Rapports en attente', 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.rapport_district.list_des_rapports', compact("autorisation_speciale", 
        "autorisation", "current_user", "rapports", "breadcrumbs"));
    }

    public function ajouter_nouveau_rapport(Request $request):View
    {
        $current_user = $request->user();
        $autorisation = Autorisations::where('table_name', 'rapport_de_districts')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_districts')->where('user_id', $request->user()->id)->first();
        
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportdistrict/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportdistrict/ajouter_nouveau_rapport'), 'label'=>'Ajouter', 'icon'=>'bi-plus-circle fs-5'],
        ];
        return view('private_layouts.rapport_district.ajouter_un_rapport', compact("current_user", 
        "autorisation_speciale", 'autorisation', "breadcrumbs"));
    }

    public function sauvegarder_le_rapport(Request $request)
    {
        $validated = $request->validate([
            'mois'=>['required', 'date_format:Y-m'],
            'zone'=>['required'],
            'paroisses_concernees'=>['required'],
            'contexte'=>['required'],
            'nombre_des_cultes_tenus'=>['required', 'numeric'],
            'moyenne_de_frequentation'=>['required', 'numeric'],
            'nombre_des_personnes_baptises'=>['required', 'numeric'],
            'autres_evenements_a_rapporter'=>['required'],
            'dime_des_dimes'=>['required', 'numeric'],
            'total_offrande'=>['required', 'numeric'],
            'autres_contributions_a_renseigner'=>['required'],
            'observation'=>['required'],
            'difficultes_defis'=>['required'],
            'recommandations'=>['required'],
            'previsions_mois_prochain'=>['required'],
            'besoins_a_signaler'=>['required'],
        ], [
            'mois.required'=>'ce champs est obligatoire',
            'zone.required'=>'ce champs est obligatoire',
            'paroisses_concernees.required'=>'ce champs est obligatoire',
            'contexte.required'=>"Aucune référence n'a été renseigné",
            'nombre_des_cultes_tenus.required'=>'ce champs est obligatoire',
            'moyenne_de_frequentation.required'=>'ce champs est obligatoire',
            'nombre_des_personnes_baptises.required'=>'ce champs est obligatoire',
            'autres_evenements_a_rapporter.required'=>'ce champs est obligatoire',
            'dime_des_dimes.required'=>'ce champs est obligatoire',
            'total_offrande.required'=>'ce champs est obligatoire',
            'autres_contributions_a_renseigner.required'=>'ce champs est obligatoire',
            'observation.required'=>'ce champs est obligatoire',
            'difficultes_defis.required'=>'ce champs est obligatoire',
            'recommandations.required'=>'ce champs est obligatoire',
            'previsions_mois_prochain.required'=>'ce champs est obligatoire',
            'besoins_a_signaler.required'=>'ce champs est obligatoire',
            'nombre_des_cultes_tenus.numeric'=>'seules les valeurs numériques sont acceptées',
            'moyenne_de_frequentation.numeric'=>'seules les valeurs numériques sont acceptées',
            'nombre_des_personnes_baptises.numeric'=>'seules les valeurs numériques sont acceptées',
            'dime_des_dimes.numeric'=>'ce champs est obligatoire',
            'total_offrande.numeric'=>'seules les valeurs numériques sont acceptées',
        ]);

        $date = $validated['mois']."-01";

        $action = $request->input('action');
        $message = '';
        $statut = 'draft';

        if ($action == 'soumettre_pour_approbation') {
            $statut = "en attente d'approbation";

            $rapport = RapportDeDistrict::create([
                'rapporteur_id'=>$request->user()->id,
                'mois'=>$date,
                'zone'=>$request->get('zone'),
                'paroisses_concernees'=>$request->get('paroisses_concernees'),
                'contexte'=>$request->get('contexte'),
                'nombre_des_cultes_tenus'=>$request->get('nombre_des_cultes_tenus', 0),
                'moyenne_de_frequentation'=>$request->get('moyenne_de_frequentation', 0),
                'nombre_des_personnes_baptises'=>$request->get('nombre_des_personnes_baptises', 0),
                'autres_evenements_a_rapporter'=>$request->get('autres_evenements_a_rapporter'),
                'dime_des_dimes'=>$request->get('dime_des_dimes', 0),
                'total_offrande'=>$request->get('total_offrande', 0),
                'autres_contributions_a_renseigner'=>$request->get('autres_contributions_a_renseigner'),
                'observation'=>$request->get('observation'),
                'difficultes_defis'=>$request->get('difficultes_defis'),
                'recommandations'=>$request->get('recommandations'),
                'previsions_mois_prochain'=>$request->get('previsions_mois_prochain'),
                'besoins_a_signaler'=>$request->get('besoins_a_signaler'),
                'statut'=>$statut,
            ]);
            $message = "Le rapport a été soumis et est en attente d'approbation";
        }else {
            $rapport = RapportDeDistrict::create([
                'rapporteur_id'=>$request->user()->id,
                'mois'=>$date,
                'zone'=>$request->get('zone'),
                'paroisses_concernees'=>$request->get('paroisses_concernees'),
                'contexte'=>$request->get('contexte'),
                'nombre_des_cultes_tenus'=>$request->get('nombre_des_cultes_tenus', 0),
                'moyenne_de_frequentation'=>$request->get('moyenne_de_frequentation', 0),
                'nombre_des_personnes_baptises'=>$request->get('nombre_des_personnes_baptises', 0),
                'autres_evenements_a_rapporter'=>$request->get('autres_evenements_a_rapporter'),
                'dime_des_dimes'=>$request->get('dime_des_dimes', 0),
                'total_offrande'=>$request->get('total_offrande', 0),
                'autres_contributions_a_renseigner'=>$request->get('autres_contributions_a_renseigner'),
                'observation'=>$request->get('observation'),
                'difficultes_defis'=>$request->get('difficultes_defis'),
                'recommandations'=>$request->get('recommandations'),
                'previsions_mois_prochain'=>$request->get('previsions_mois_prochain'),
                'besoins_a_signaler'=>$request->get('besoins_a_signaler'),
                'statut'=>$statut,
            ]);
            $message = "Le rapport a été enregistré en tant que draft";
        }
        return redirect()->route('rapportdistrict.list_des_rapports')->with('success', $message);
    }

    public function afficher_rapport($rapport_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_districts')->where('groupe_id',
            $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name',
            'rapport_de_districts')->where('user_id', $request->user()->id)->first();
        $rapport = RapportDeDistrict::with("rapporteur")->find($rapport_id);

        $current_user = $request->user();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportdistrict/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportdistrict/afficher_rapport'), 'label'=>'Afficher', 'icon'=>'bi-eye fs-5'],
        ];
        return view('private_layouts.rapport_district.afficher_un_rapport', compact("autorisation", "autorisation_speciale",
        "rapport", "current_user", "breadcrumbs"));
    }

    public function edit_le_rapport($rapport_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_districts')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_districts')->where('user_id', $request->user()->id)->first();
        $rapport = RapportDeDistrict::find($rapport_id);
        $current_user = $request->user();
        
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/rapportdistrict/list'), 'label'=>'Rapports validés', 'icon'=>'bi-list fs-5'],
            ['url'=>url('/rapportdistrict/les_attentes_en_approbation'), 'label'=>'Rapports en attente', 'icon'=>'bi-pencil-square fs-5'],
        ];
        return view('private_layouts.rapport_district.editer_un_rapport', compact("rapport", "autorisation", 
        "autorisation_speciale", "current_user", "breadcrumbs"));
    }


    public function save_edition_rapport($rapport_id, Request $request)
    {
        $rapport = RapportDeDistrict::find($rapport_id);
        $validated = $request->validate([
            'mois'=>['required', 'date_format:Y-m'],
            'zone'=>['required'],
            'paroisses_concernees'=>['required'],
            'contexte'=>['required'],
            'nombre_des_cultes_tenus'=>['required', 'numeric'],
            'moyenne_de_frequentation'=>['required', 'numeric'],
            'nombre_des_personnes_baptises'=>['required', 'numeric'],
            'autres_evenements_a_rapporter'=>['required'],
            'dime_des_dimes'=>['required', 'numeric'],
            'total_offrande'=>['required', 'numeric'],
            'autres_contributions_a_renseigner'=>['required'],
            'observation'=>['required'],
            'difficultes_defis'=>['required'],
            'recommandations'=>['required'],
            'previsions_mois_prochain'=>['required'],
            'besoins_a_signaler'=>['required'],
        ], [
            'mois.required'=>'ce champs est obligatoire',
            'zone.required'=>'ce champs est obligatoire',
            'paroisses_concernees.required'=>'ce champs est obligatoire',
            'contexte.required'=>"Aucune référence n'a été renseigné",
            'nombre_des_cultes_tenus.required'=>'ce champs est obligatoire',
            'moyenne_de_frequentation.required'=>'ce champs est obligatoire',
            'nombre_des_personnes_baptises.required'=>'ce champs est obligatoire',
            'autres_evenements_a_rapporter.required'=>'ce champs est obligatoire',
            'dime_des_dimes.required'=>'ce champs est obligatoire',
            'total_offrande.required'=>'ce champs est obligatoire',
            'autres_contributions_a_renseigner.required'=>'ce champs est obligatoire',
            'observation.required'=>'ce champs est obligatoire',
            'difficultes_defis.required'=>'ce champs est obligatoire',
            'recommandations.required'=>'ce champs est obligatoire',
            'previsions_mois_prochain.required'=>'ce champs est obligatoire',
            'besoins_a_signaler.required'=>'ce champs est obligatoire',
            'nombre_des_cultes_tenus.numeric'=>'seules les valeurs numériques sont acceptées',
            'moyenne_de_frequentation.numeric'=>'seules les valeurs numériques sont acceptées',
            'nombre_des_personnes_baptises.numeric'=>'seules les valeurs numériques sont acceptées',
            'dime_des_dimes.numeric'=>'ce champs est obligatoire',
            'total_offrande.numeric'=>'seules les valeurs numériques sont acceptées',
        ]);

        $date = $validated['mois']."-01";

        $rapport->mois=$date;
        $rapport->zone=$request->get('zone');
        $rapport->paroisses_concernees=$request->get('paroisses_concernees');
        $rapport->contexte=$request->get('contexte');
        $rapport->nombre_des_cultes_tenus=$request->get('nombre_des_cultes_tenus');
        $rapport->moyenne_de_frequentation=$request->get('moyenne_de_frequentation');
        $rapport->nombre_des_personnes_baptises=$request->get('nombre_des_personnes_baptises');
        $rapport->autres_evenements_a_rapporter=$request->get('autres_evenements_a_rapporter');
        $rapport->dime_des_dimes=$request->get('dime_des_dimes');
        $rapport->total_offrande=$request->get('total_offrande');
        $rapport->autres_contributions_a_renseigner=$request->get('autres_contributions_a_renseigner');
        $rapport->observation=$request->get('observation');
        $rapport->difficultes_defis=$request->get('difficultes_defis');
        $rapport->recommandations=$request->get('recommandations');
        $rapport->previsions_mois_prochain=$request->get('previsions_mois_prochain');
        $rapport->besoins_a_signaler=$request->get('besoins_a_signaler');
        $rapport->update();

        return redirect()->route('rapportdistrict.afficher_rapport', $rapport_id)->with('success', 'les mises à jours ont été appliqués');
    }

    public function supprimer_rapport(Request $request)
    {
        $rapport_id = $request->rapport_id;
        $rapport = RapportDeDistrict::find($rapport_id);
        $rapport->delete();
        return redirect()->back()->with('success', 'le rapport a été supprimé');
    }

    public function traitement_du_rapport($rapport_id, Request $request)
    {
        $rapport = RapportDeDistrict::find($rapport_id);
        $action = $request->input('action');
        $message = '';
        $statut = 'draft';
        if ($action === 'soumettre_pour_approbation') {
            $statut = "en attente d'approbation";
            $message = "Le rapport a été soumis et est en attente d'approbation";
        }

        if ($action === 'soumettre_pour_validation') {
            $statut = 'en attente de validation';
            $message = 'Le rapport a été soumis et est en attente de validation';
        }

        if ($action === 'soumettre_pour_confirmation') {
            $caisse_eglise = Caisse::first('departement_id', 1)->first();
            if (is_null($caisse_eglise)) {
                $message = "La requête n'a pas été appliqué car il n'y a pas de caisse pour revecoir cette action";
            }else {
                $montant_net_total_eglise = $caisse_eglise->montant_net_actuel + $rapport->dime_des_dimes + $rapport->total_offrande;
                $caisse_eglise->montant_net_actuel = $montant_net_total_eglise;
                $caisse_eglise->update();

                $transaction = Transactions::create([
                    'caisse_id' => $caisse_eglise->id,
                    'date_de_la_transaction'=> Carbon::now(),
                    'type_de_transaction'=> "crédit",
                    'montant'=> $rapport->dime_des_dimes,
                    'source'=> "rapport de district/dime des dimes",
                    'pourcentage_eglise'=> 0,
                    'montant_net_restant'=>$montant_net_total_eglise,
                ]);
                $transaction = Transactions::create([
                    'caisse_id' => $caisse_eglise->id,
                    'date_de_la_transaction'=> Carbon::now(),
                    'type_de_transaction'=> "crédit",
                    'montant'=> $rapport->total_offrande,
                    'source'=> "rapport de district/offrande",
                    'pourcentage_eglise'=> 0,
                    'montant_net_restant'=>$montant_net_total_eglise,
                ]);
                $statut = 'en attente de confirmation';
                $message = 'le rapport a été soumis pour confirmation';
            }
        }

        if ($action === 'valider') {
            $statut = 'validé';
            $message = 'Le rapport a été validé';
        }
        $rapport->statut = $statut;
        $rapport->update();
        return redirect()->back()->with('success', $message);
    }
}
