<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\Departements;
use App\Models\RapportDeCulte;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Mockery\Exception;

class RapportCulteController extends Controller
{
    public function list_des_rapports(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_cultes')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_cultes')->where('user_id', $request->user()->id)->first();
        $rapports = [];
        if ($autorisation){
            if ($autorisation->autorisation_en_lecture){
                if(in_array('peux voir tous les rapports', json_decode($autorisation->autorisation_en_lecture, true))){
                    $rapports = RapportDeCulte::where('statut', 'validé')->get();
                }else {
                    $rapports = RapportDeCulte::where('statut', 'validé')->where("departement_id", $request->user()->departement_id)->get();
                }
            }
        }
        return view('private_layouts.rapport_de_culte_folder.list_des_rapports', ['current_user'=>$request->user(), 'rapports'=>$rapports, 'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisation_speciale]);
    }

    public function voir_mes_drafts(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_cultes')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportDeCulte::where('statut', 'draft')->where('rapporteur_id', $request->user()->id)->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_cultes')->where('user_id', $request->user()->id)->first();
        return view('private_layouts.rapport_de_culte_folder.list_des_rapports', compact("autorisation", "rapports", "current_user", "autorisation_speciale"));
    }

    public function les_attentes_en_completion(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_cultes')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportDeCulte::where('statut', 'en attente de completion')->where('departement_id', $request->user()->departement_id)->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_cultes')->where('user_id', $request->user()->id)->first();
        return view('private_layouts.rapport_de_culte_folder.list_des_rapports', compact("rapports", "autorisation", "current_user", "autorisation_speciale"));
    }

    public function les_attentes_en_validation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_cultes')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportDeCulte::where('statut', 'en attente de validation')->where('departement_id', $request->user()->departement_id)->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_cultes')->where('user_id', $request->user()->id)->first();
        return view('private_layouts.rapport_de_culte_folder.list_des_rapports', compact("autorisation_speciale", "autorisation", "current_user", "rapports"));
    }

    public function ajouter_nouveau_rapport(Request $request):View
    {
        $current_user = $request->user();
        $autorisation = Autorisations::where('table_name', 'rapport_de_cultes')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_cultes')->where('user_id', $request->user()->id)->first();
        return view('private_layouts.rapport_de_culte_folder.ajouter_un_rapport', compact("current_user", "autorisation_speciale", 'autorisation'));
    }

    public function sauvegarder_le_rapport(Request $request)
    {
        $request->validate([
           'date'=>['required'],
           'moderateur'=>['required'],
           'orateur'=>['required'],
           'theme'=>['required'],
           'reference'=>['required'],
           'total_pers_dans_le_culte'=>['required', 'numeric'],
            'total_papas'=>['required', 'numeric'],
            'total_mamans'=>['required', 'numeric'],
            'total_jeunes'=>['required', 'numeric'],
            'total_enfants'=>['required', 'numeric'],
        ], [
            'date.required'=>'ce champs est obligatoire',
            'moderateur.required'=>'ce champs est obligatoire',
            'orateur.required'=>'ce champs est obligatoire',
            'theme.required'=>'ce champs est obligatoire',
            'reference.required'=>"Aucune référence n'a été renseigné",
            'total_pers_dans_le_culte.required'=>'ce champs est obligatoire',
            'total_papas.required'=>'ce champs est obligatoire',
            'total_mamans.required'=>'ce champs est obligatoire',
            'total_jeunes.required'=>'ce champs est obligatoire',
            'total_enfants.required'=>'ce champs est obligatoire',
            'total_pers_dans_le_culte.numeric'=>'seules les valeurs numériques sont autorisées',
            'total_papas.required.numeric'=>'seules les valeurs numériques sont autorisées',
            'total_mamans.required.numeric'=>'seules les valeurs numériques sont autorisées',
            'total_jeunes.required.numeric'=>'seules les valeurs numériques sont autorisées',
            'total_enfants.required.numeric'=>'seules les valeurs numériques sont autorisées',
        ]);

        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_cultes')->where('user_id', $request->user()->id)->first();

        if(!is_null($autorisation_speciale)) {
            if($autorisation_speciale->autorisation_speciale) {
                if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true))) {
                    $request->validate([
                       "offrande"=>['required', 'numeric'],
                    ], [
                        'offrande.required'=>"ce champs est obligatoire",
                        'offrande.numeric'=>"seules les valeurs numériques sont acceptées",
                    ]);
                }
            }
        }

        $data = request()->all();
        $references = [];
        $don_special = [];
        $autres_faits = [];

        if (array_key_exists('reference', $data)) {
            $references = array_filter($data['reference']);
        }

        if (array_key_exists('don_special', $data)) {
            $don_special = array_filter($data['don_special']);
        }

        if (array_key_exists('autres_faits_a_renseigner', $data)) {
            $autres_faits = array_filter($data['autres_faits_a_renseigner']);
        }

        $action = $request->input('action');
        $message = '';
        $statut = 'draft';

        if ($action == 'soumission_validation') {
            $statut = 'en attente de validation';

            $offrande = $request->offrande;
            $rapport = RapportDeCulte::create([
                'date'=>$request->get('date'),
                'rapporteur_id'=>$request->user()->id,
                'rapporteur'=>$request->user()->nom.' '.$request->user()->postnom.' '.$request->user()->prenom,
                'departement_id'=>$request->get('departement_id'),
                'moderateur'=>$request->get('moderateur'),
                'orateur'=>$request->get('orateur'),
                'theme'=>$request->get('theme'),
                'reference'=>json_encode($references),
                'synthese'=>$request->get('synthese'),
                'total_pers_dans_le_culte'=>$request->get('total_pers_dans_le_culte'),
                'total_papas'=>$request->get('total_papas'),
                'total_mamans'=>$request->get('total_mamans'),
                'total_jeunes'=>$request->get('total_jeunes'),
                'total_enfants'=>$request->get('total_enfants'),
                'don_special'=>json_encode($don_special),
                'autres_faits_a_renseigner'=>json_encode($autres_faits),
                'total_offrande'=>$offrande,
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

            $rapport = RapportDeCulte::create([
                'date'=>$request->get('date'),
                'rapporteur_id'=>$request->user()->id,
                'rapporteur'=>$request->user()->nom.' '.$request->user()->postnom.' '.$request->user()->prenom,
                'departement_id'=>$request->get('departement_id'),
                'moderateur'=>$request->get('moderateur'),
                'orateur'=>$request->get('orateur'),
                'theme'=>$request->get('theme'),
                'reference'=>json_encode($references),
                'synthese'=>$request->get('synthese'),
                'total_pers_dans_le_culte'=>$request->get('total_pers_dans_le_culte'),
                'total_papas'=>$request->get('total_papas'),
                'total_mamans'=>$request->get('total_mamans'),
                'total_jeunes'=>$request->get('total_jeunes'),
                'total_enfants'=>$request->get('total_enfants'),
                'don_special'=>json_encode($don_special),
                'autres_faits_a_renseigner'=>json_encode($autres_faits),
                'statut'=>$statut,
            ]);
        }

        return redirect()->route('rapportculte.list_des_rapports')->with('success', $message);
    }

    public function afficher_rapport_culte($rapport_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_cultes')->where('groupe_id',
            $request->user()->groupe_utilisateur_id)->first();
        $autorisationspeciales = AutorisationSpeciale::where('table_name',
            'rapport_de_cultes')->where('user_id', $request->user()->id)->first();
        $rapport = RapportDeCulte::with("departement", "user_rapporteur")->find($rapport_id);
        return view('private_layouts.rapport_de_culte_folder.afficher_un_rapport', ['rapport'=>$rapport, 'current_user'=>$request->user(), 'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisationspeciales]);
    }

    public function traitement_du_rapport($rapport_id, Request $request)
    {
        $rapport = RapportDeCulte::find($rapport_id);
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

    public function edit_le_rapport($rapport_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_cultes')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_cultes')->where('user_id', $request->user()->id)->first();
        $rapport = RapportDeCulte::find($rapport_id);
        $departements = Departements::where("designation", "!=", "comité de soutien")->where("designation", "!=",
            "comité d'assistance et vie sociale")->where("designation", "!=", "protocole")->where("designation", "!=",
            "coordination provinciale")->get();
        $current_user = $request->user();
        return view('private_layouts.rapport_de_culte_folder.editer_un_rapport', compact("rapport", "autorisation", "autorisation_speciale", "current_user", "departements"));
    }

    public function save_edition_rapport($rapport_id, Request $request)
    {
        $rapport = RapportDeCulte::find($rapport_id);
        if ($rapport->statut !== "en attente de complétion") {
            $request->validate([
                'departement_id'=>['required'],
                'date'=>['required'],
                'moderateur'=>['required'],
                'orateur'=>['required'],
                'theme'=>['required'],
                'reference'=>['required'],
                'total_pers_dans_le_culte'=>['required', 'numeric'],
                'total_papas'=>['required', 'numeric'],
                'total_mamans'=>['required', 'numeric'],
                'total_jeunes'=>['required', 'numeric'],
                'total_enfants'=>['required', 'numeric'],
            ], [
                'departement_id'=>'Ce champs est obligatoire',
                'date.required'=>'ce champs est obligatoire',
                'moderateur.required'=>'ce champs est obligatoire',
                'orateur.required'=>'ce champs est obligatoire',
                'theme.required'=>'ce champs est obligatoire',
                'reference.required'=>"Aucune référence n'a été renseigné",
                'total_pers_dans_le_culte.required'=>'ce champs est obligatoire',
                'total_papas.required'=>'ce champs est obligatoire',
                'total_mamans.required'=>'ce champs est obligatoire',
                'total_jeunes.required'=>'ce champs est obligatoire',
                'total_enfants.required'=>'ce champs est obligatoire',
                'total_pers_dans_le_culte.numeric'=>'seules les valeurs numériques sont autorisées',
                'total_papas.required.numeric'=>'seules les valeurs numériques sont autorisées',
                'total_mamans.required.numeric'=>'seules les valeurs numériques sont autorisées',
                'total_jeunes.required.numeric'=>'seules les valeurs numériques sont autorisées',
                'total_enfants.required.numeric'=>'seules les valeurs numériques sont autorisées',
            ]);

            $data = request()->all();
            $references = [];
            $don_special = [];
            $autres_faits = [];

            if (array_key_exists('reference', $data)) {
                $references = array_filter($data['reference']);
            }

            if (array_key_exists('don_special', $data)) {
                $don_special = array_filter($data['don_special']);
            }

            if (array_key_exists('autres_faits_a_renseigner', $data)) {
                $autres_faits = array_filter($data['autres_faits_a_renseigner']);
            }

            $rapport->date = $request->get('date');
            $rapport->departement_id = $request->get('departement_id');
            $rapport->moderateur = $request->get('moderateur');
            $rapport->orateur = $request->get('orateur');
            $rapport->theme = $request->get('theme');
            $rapport->reference = json_encode($references);
            $rapport->synthese = $request->get('synthese');
            $rapport->total_pers_dans_le_culte = $request->get('total_pers_dans_le_culte');
            $rapport->total_papas = $request->get('total_papas');
            $rapport->total_mamans = $request->get('total_mamans');
            $rapport->total_jeunes = $request->get('total_jeunes');
            $rapport->total_enfants = $request->get('total_enfants');

            $rapport->don_special = json_encode($don_special);
            $rapport->autres_faits_a_renseigner = json_encode($autres_faits);
        }else {
            $request->validate([
                'total_offrande'=>['required', 'numeric']
            ], [
                'total_offrande.required'=>"Veuillez renseigner l'offrande du jour",
                'total_offrande.numeric'=>"Seules les valeurs numériques sont acceptées",
            ]);

            $rapport->total_offrande = $request->get('total_offrande');
        }
        $rapport->update();

        return redirect()->route('rapportculte.afficher_rapport_culte', $rapport_id)->with('success', 'les mises à jours ont été appliqués');
    }

    public function supprimer_rapport(Request $request)
    {
        $rapport_id = $request->rapport_id;
        $rapport = RapportDeCulte::find($rapport_id);
        $rapport->delete();
        return redirect()->back()->with('success', 'le rapport a été supprimé');
    }

    public function audience_rapport($rapport_id, Request $request)
    {
        $rapport = RapportDeCulte::find($rapport_id);
        $action = $request->input('action');
        $message = '';
        $audience = 'privé';
        if ($action == 'public') {
            $audience = 'public';
            $message = 'Le rapport a une audience publique';
        }
        if ($action == 'privé') {
            $audience = 'privé';
            $message = 'Le rapport a une audience privée';
        }
        $rapport->audience = $audience;
        $rapport->update();

        return redirect()->back()->with('success', $message);
    }
}
