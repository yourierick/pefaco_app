<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\Caisse;
use App\Models\CaisseAccount;
use App\Models\Departements;
use App\Models\Depense;
use App\Models\LivreGrandeCaisse;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class CaisseController extends Controller
{
    public function liste_des_caisses(Request $request)
    {
        $autorisation = Autorisations::where('table_name', 'caisses')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $caisses = [];
        if ($autorisation !== null) {
            if ($autorisation->autorisation_en_lecture){
                if (in_array('peux voir toutes les caisses', json_decode($autorisation->autorisation_en_lecture, true))) {
                    $caisses = Caisse::with(['departement', 'caissier'])->get();
                }else{
                    $caisses = Caisse::with(['departement', 'caissier'])->where('departement_id', $request->user()->departement_id)->get();
                }
            }
        }
        return view('private_layouts.caisses_folder.caisses', ['caisses' => $caisses, 'current_user' => $request->user(), 'autorisation' => $autorisation]);
    }

    public function add_new_caisse(Request $request): View
    {
        $departements = Departements::all();
        return view('private_layouts.caisses_folder.add_caisse', ['departements' => $departements, 'current_user' => $request->user()]);
    }

    #Ajax:: load Users
    public function load_users($dept_id)
    {
        $users = User::where('departement_id', $dept_id)->get();
        return response()->json($users);
    }

    public function save_new_caisse(Request $request)
    {
        $request->validate([
            'departement_id' => ['required', 'numeric', Rule::unique(Caisse::class)],
            'caissier_id'=> ['required'],
        ], [
            'departement_id.required'=>'Ce champs est obligatoire',
            'departement_id.numeric'=>'Ce champs doit être numérique',
            'departement_id.unique'=>'Ce département a déjà une caisse',
            'caissier_id.required'=>'Ce champs est obligatoire',
        ]);
        $caisse = Caisse::create([
            'departement_id' => $request->departement_id,
            'caissier_id'=>$request->caissier_id,
        ]);

        return redirect()->route('caisses.list', ['current_user' => $request->user()])->with('success', "la caisse a été crée");
    }


    public function edit_caisse($caisse_id, Request $request)
    {
        $caisse = Caisse::find($caisse_id);
        $departements = Departements::all();
        return view('private_layouts.caisses_folder.edit_caisse', ['caisse'=>$caisse, 'departements' => $departements, 'current_user' => $request->user()]);
    }


    public function save_edit_caisse($caisse_id, Request $request)
    {
        $request->validate([
            'caissier_id'=> ['required'],
        ], [
            'caissier_id.required'=>'Ce champs est obligatoire',
        ]);

        $caisse = Caisse::find($caisse_id);
        $caisse->caissier_id = $request->get('caissier_id');
        $caisse->update();

        return redirect()->route('caisses.list', ['current_user' => $request->user()])->with('success', "la caisse a été mise à jour");
    }

    public function vue_de_la_caisse($caisse_id, Request $request): View
    {
        $autorisation = Autorisations::where('table_name', 'caisses')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $caisse = Caisse::with(['departement', 'caissier'])->find($caisse_id);
        $departement = Departements::where('id', $caisse->departement_id)->first();
        $transactions = Transactions::where('caisse_id', $caisse_id)->orderBy('id', 'desc')->get();
        $current_user = $request->user();
        return view('private_layouts.caisses_folder.vue_de_la_caisse', compact("autorisation", "caisse",
        "departement", "transactions", "current_user"));
    }

    public function nouvelle_transaction($caisse_id):View
    {
        $current_user = Auth::user();
        return view('private_layouts.caisses_folder.nouvelle_transaction', compact("current_user", "caisse_id"));
    }

    public function check_code_de_depense($code, $caisse_id)
    {
        $caisse = Caisse::find($caisse_id);
        $depense = Depense::where('code_de_depense', $code)->first(['source_a_imputer_id', 'statut', 'montant', 'consommation_depense', 'departement_id']);
        if ($depense){
            if ($depense->source_a_imputer_id !== $caisse->id){
                return response()->json("caisse_error");
            }else{
                return response()->json($depense);
            }
        }
        else{
            return response()->json($depense);
        }
    }

    public function save_transaction($caisse_id, Request $request)
    {
        $caisse = Caisse::find($caisse_id);
        if ($caisse !== null){
            $montant_net_actuel = $caisse->montant_net_actuel;
            $request->validate(['type_de_transaction'=>['required']]);
            switch ($request->get('type_de_transaction')){
                case 'crédit':
                    $request->validate([
                        'source' => ['required'],
                        'montant' => ['required', 'numeric'],
                    ], [
                        'source.required'=>'Ce champs est obligatoire',
                        'montant.numeric'=>'Ce champs doit être numérique',
                        'montant.required'=>'Ce champs est obligatoire',
                    ]);
                    break;
                case 'débit':
                    $request->validate([
                        'motif' => 'required',
                        'code' => ['required'],
                        'montant' => ['required', 'numeric', 'lte:'. $caisse->montant_net_actuel],
                    ], [
                        'montant.lte'=>'Veuillez créditer la caisse pour cette transaction',
                        'montant.motif'=>'Ce champs est obligatoire',
                        'code'=>'Ce champs est obligatoire',
                    ]);
                    break;
                default:
                    $request->validate(['type_de_transaction'=>['required']]);
            }

            if ($request->type_de_transaction === "crédit") {
                if ($caisse->departement_id !== 1){
                    $departement = Departements::find($caisse->departement_id);
                    $pourcentage_eglise = ($request->montant * 20)/100;
                    $montant_net_restant = $montant_net_actuel + ($request->montant - $pourcentage_eglise);
                    $transaction = Transactions::create([
                        'caisse_id' => $caisse->id,
                        'date_de_la_transaction'=> $request['date_de_la_transaction'],
                        'type_de_transaction'=> $request['type_de_transaction'],
                        'code_de_depense'=> $request['code_de_depense'],
                        'montant'=> $request['montant'],
                        'source'=> $request['source'],
                        'pourcentage_eglise'=> $pourcentage_eglise,
                        'montant_net_restant'=>$montant_net_restant,
                    ]);
                    $caisse->montant_net_actuel = $montant_net_actuel;
                    $caisse->update();

                    $caisse_eglise = Caisse::first('departement_id', 1)->first();
                    $montant_net_total_eglise = $pourcentage_eglise + $caisse_eglise->montant_net_actuel;
                    $caisse_eglise->montant_net_actuel = $montant_net_total_eglise;
                    $caisse_eglise->update();

                    $transaction = Transactions::create([
                        'caisse_id' => $caisse_eglise->id,
                        'date_de_la_transaction'=> $request['date_de_la_transaction'],
                        'type_de_transaction'=> "crédit",
                        'montant'=> $pourcentage_eglise,
                        'source'=> $departement->designation,
                        'pourcentage_eglise'=> 0,
                        'montant_net_restant'=>$montant_net_total_eglise,
                    ]);
                }else {
                    $montant_net_restant = $montant_net_actuel + $request->montant;
                    $transaction = Transactions::create([
                        'caisse_id' => $caisse->id,
                        'date_de_la_transaction'=> $request['date_de_la_transaction'],
                        'type_de_transaction'=> $request['type_de_transaction'],
                        'montant'=> $request['montant'],
                        'source'=> $request->source,
                        'pourcentage_eglise'=> 0,
                        'montant_net_restant'=>$montant_net_restant,
                    ]);
                    $caisse->montant_net_actuel = $montant_net_restant;
                    $caisse->update();
                }
            }else {
                $montant_net_restant = $caisse->montant_net_actuel - $request['montant'];
                $transaction = Transactions::create([
                    'caisse_id' => $caisse->id,
                    'date_de_la_transaction'=> $request['date_de_la_transaction'],
                    'type_de_transaction'=> "débit",
                    'montant'=> $request->get('montant'),
                    'pourcentage_eglise'=> 0,
                    'montant_net_restant'=> $montant_net_restant,
                    'code_de_depense' => $request->code,
                ]);

                $caisse->montant_net_actuel = $montant_net_restant;
                $caisse->update();

                $depense = Depense::where('code_de_depense', $request->get('code'))->first();
                $depense->consommation_depense = 1;
                $depense->update();
            }
            return redirect()->route('caisses.vue_de_la_caisse', [$caisse->id, 'current_user' => $request->user()])->with('success', "la transaction a été enregistré");
        }else {
            return redirect()->route('caisses.list', ['current_user' => $request->user()])->with('error', "Cette caisse n'existe pas");
        }
    }

    public function delete_caisse(Request $request)
    {
        $caisse_id = $request->get('caisse_id');
        $caisse = Caisse::find($caisse_id)->delete();
        return redirect()->route('caisses.list', ['current_user' =>$request->user()])->with('success', "La caisse a été supprimé");
    }

    public function annuler_transaction($caisse_id, Request $request)
    {
        $transaction_id = $request->get('transaction_id');
        $transaction = Transactions::find($transaction_id);
        $caisse = Caisse::find($caisse_id);
        if ($transaction->type_de_transaction === "débit") {
           $caisse->montant_net_actuel = $caisse->montant_net_actuel + $transaction->montant;
           $depense = Depense::where('code_de_depense', $transaction->code_de_depense)->first();
           $depense->consommation_depense = 0;
            $depense->update();
        }else {
            $caisse->montant_net_actuel = $caisse->montant_net_actuel - $transaction->montant;
            if ($caisse->departement_id !== 1){
                $caisse_eglise = Caisse::first('departement_id', 1)->first();
                $caisse_eglise->montant_net_actuel = $caisse_eglise->montant_net_actuel - ($transaction->montant*20)/100;
                $caisse_eglise->update();
            }
        }
        $caisse->update();
        $transaction->delete();
        return redirect()->route('caisses.vue_de_la_caisse', ['caisse_id'=>$caisse_id])->with('success', 'La transaction a été annulé');
    }
}
