<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\RapportInspection;
use Illuminate\View\View;

class RapportInspectionController extends Controller
{
    public function list_des_rapports(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_inspections')->where('user_id', $request->user()->id)->first();
        $rapports = RapportInspection::with('rapporteur')->where('statut', 'validé')->get();
        return view('private_layouts.rapport_inspection.list_des_rapports', ['current_user'=>$request->user(), 'rapports'=>$rapports, 'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisation_speciale]);
    }

    public function voir_mes_drafts(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportInspection::with('rapporteur')->where('statut', 'draft')->where('rapporteur_id', $request->user()->id)->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_inspections')->where('user_id', $request->user()->id)->first();
        return view('private_layouts.rapport_inspection.list_des_rapports', compact("autorisation", "rapports", "current_user", "autorisation_speciale"));
    }

    public function les_attentes_en_validation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $rapports = RapportInspection::with('rapporteur')->where('statut', 'en attente de validation')->get();
        $current_user = $request->user();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_inspections')->where('user_id', $request->user()->id)->first();
        return view('private_layouts.rapport_inspection.list_des_rapports', compact("autorisation_speciale", "autorisation", "current_user", "rapports"));
    }

    public function ajouter_nouveau_rapport(Request $request):View
    {
        $current_user = $request->user();
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_inspections')->where('user_id', $request->user()->id)->first();
        return view('private_layouts.rapport_inspection.ajouter_un_rapport', compact("current_user", "autorisation_speciale", 'autorisation'));
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

        return redirect()->route('rapportinspection.list_des_rapports')->with('success', $message);
    }

    public function afficher_rapport($rapport_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id',
            $request->user()->groupe_utilisateur_id)->first();
        $autorisationspeciales = AutorisationSpeciale::where('table_name',
            'rapport_inspections')->where('user_id', $request->user()->id)->first();
        $rapport = RapportInspection::with("rapporteur")->find($rapport_id);
        return view('private_layouts.rapport_inspection.afficher_un_rapport', ['rapport'=>$rapport, 'current_user'=>$request->user(), 'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisationspeciales]);
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
        $autorisation = Autorisations::where('table_name', 'rapport_inspections')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_inspections')->where('user_id', $request->user()->id)->first();
        $rapport = RapportInspection::find($rapport_id);
        $current_user = $request->user();
        return view('private_layouts.rapport_inspection.editer_un_rapport', compact("rapport", "autorisation", "autorisation_speciale", "current_user"));
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
