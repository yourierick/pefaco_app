<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\Cotisation;
use App\Models\CotisationAccount;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CotisationsController extends Controller
{
    public function liste_des_cotisations(Request $request)
    {
        $autorisation = Autorisations::where('table_name', 'cotisations')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $cotisations = [];
        if (!is_null($autorisation)) {
            if ($autorisation->autorisation_en_lecture) {
                if (in_array('peux voir toutes les cotisations', json_decode($autorisation->autorisation_en_lecture, true))) {
                    $cotisations = Cotisation::with('departement')->get();
                }else {
                    $cotisations = Cotisation::with('departement')->where('departement_id', $request->user()->departement_id)->get();
                }
            }
        }
        return view('private_layouts.cotisations_folder.cotisations', ['cotisations' => $cotisations, 'current_user' => $request->user(), 'autorisation' => $autorisation]);
    }

    public function add_new_cotisation(Request $request): View
    {
        return view('private_layouts.cotisations_folder.add_cotisation', ['current_user' => $request->user()]);
    }

    public function save_new_cotisation(Request $request)
    {
        $request->validate([
            'motif' => ['required'],
            'date_debut'=> ['required'],
            'date_fin' => ['required'],
        ], [
            'motif.required'=>'Ce champs est obligatoire',
            'date_debut.required'=>'Ce champs est obligatoire',
            'date_fin.required'=>'Ce champs est obligatoire',
        ]);

        $cotisation = Cotisation::create([
            'departement_id'=>$request->user()->departement_id,
            'motif'=>$request->get('motif'),
            'date_debut' => $request->get('date_debut'),
            'date_fin'=>$request->get('date_fin'),
        ]);

        return redirect()->route('cotisation.list')->with('success', "la cotisation est en attente de lancement");
    }

    public function edit_cotisation($cotisation_id, Request $request): View
    {
        $cotisation = Cotisation::find($cotisation_id);
        return view('private_layouts.cotisations_folder.edit_cotisation',
            ['cotisation'=>$cotisation, 'current_user'=>$request->user()]);
    }

    public function save_edition_cotisation($cotisation_id, Request $request)
    {
        $request->validate([
            'motif' => ['required'],
            'date_debut'=> ['required'],
            'date_fin' => ['required'],
        ], [
            'motif.required'=>'Ce champs est obligatoire',
            'date_debut.required'=>'Ce champs est obligatoire',
            'date_fin.required'=>'Ce champs est obligatoire',
        ]);

        $cotisation = Cotisation::find($cotisation_id);
        $cotisation->motif = $request->get('motif');
        $cotisation->date_debut = $request->get('date_debut');
        $cotisation->date_fin = $request->get('date_fin');
        $cotisation->update();

        return redirect()->route('cotisation.list')->with('success', 'les informations ont été mises à jour');
    }

    public function afficher_la_cotisation($cotisation_id, Request $request):View
    {
        $autorisation = Autorisations::where('groupe_id', $request->user()->groupe_utilisateur_id)->where('table_name', 'cotisations')->first();
        $cotisation = Cotisation::find($cotisation_id);
        $cotisation_account = CotisationAccount::where('cotisation_id', $cotisation_id)->get();
        return view('private_layouts.cotisations_folder.detail_cotisation', ['cotisation' => $cotisation,
            'cotisation_accounts'=>$cotisation_account, 'current_user' => $request->user(), 'autorisation'=>$autorisation]);
    }

    public function lancer_cotisation($cotisation_id)
    {
        $cotisation = Cotisation::find($cotisation_id);
        $cotisation->statut = 'en cours';
        $cotisation->update();
        return redirect()->route('cotisation.afficher', $cotisation_id)->with('success', 'la cotisation est lancée');
    }

    public function mettre_en_attente($cotisation_id)
    {
        $cotisation = Cotisation::find($cotisation_id);
        $cotisation->statut = 'en attente';
        $cotisation->update();
        return redirect()->route('cotisation.afficher', $cotisation_id)->with('success', 'la cotisation est mise en attente');
    }

    public function terminer_la_cotisation($cotisation_id)
    {
        $cotisation = Cotisation::find($cotisation_id);
        $cotisation->statut = 'terminée';
        $cotisation->update();
        return redirect()->route('cotisation.afficher', $cotisation_id)->with('success', 'la cotisation est terminée');
    }

    public function inserer_cotisation_account($cotisation_id, Request $request): View
    {
        return view('private_layouts.cotisations_folder.cotiser', ['cotisation_id'=>$cotisation_id,'current_user' => $request->user()]);
    }

    public function save_new_cotisation_account($cotisation_id, Request $request)
    {
        $request->validate([
           'cotisant'=>['required'],
           'montant' => ['required'],
        ],
        [
            'cotisant.required'=>'Ce champs est obligatoire',
            'montant.required'=>'Ce champs est obligatoire',
        ]);

        $cotisation_account = CotisationAccount::create([
            'cotisation_id'=>$cotisation_id,
            'montant'=>$request->get('montant'),
            'cotisant'=>$request->get('cotisant'),
        ]);

        $cotisation = Cotisation::find($cotisation_id);
        $cotisation->montant_total_net = $cotisation->montant_total_net + $request->get('montant');
        $cotisation->update();

        return redirect()->route('cotisation.afficher', $cotisation_id)->with('ajouté');
    }

    public function edit_cotisation_account($cotisation_account_id, Request $request): View
    {
        $cotisation_account = CotisationAccount::find($cotisation_account_id);
        return view('private_layouts.cotisations_folder.edit_cotisation_account',
            ['cotisation_account'=>$cotisation_account, 'current_user'=>$request->user()]);
    }

    public function save_edition_cotisation_account($cotisation_account_id, Request $request)
    {
        $request->validate([
            'cotisant'=>['required'],
            'montant' => ['required'],
        ],
        [
            'cotisant.required'=>'Ce champs est obligatoire',
            'montant.required'=>'Ce champs est obligatoire',
        ]);

        $cotisation_account = CotisationAccount::find($cotisation_account_id);

        $cotisation = Cotisation::find($cotisation_account->cotisation_id);
        $cotisation->montant_total_net = $cotisation->montant_total_net - $cotisation_account->montant;
        $cotisation->montant_total_net = $cotisation->montant_total_net + $request->get('montant');
        $cotisation->update();

        $cotisation_account->montant = $request->get('montant');
        $cotisation_account->cotisant = $request->get('cotisant');
        $cotisation_account->update();

        return redirect()->route('cotisation.afficher', $cotisation->id)->with('success', 'les informations ont été mises à jour');
    }

    public function supprimer_cotisation(Request $request)
    {
        $cotisation_id = $request->get("cotisation_id");
        $cotisation = Cotisation::find($cotisation_id);
        $cotisation->delete();
        return redirect()->back()->with('success', 'la cotisation a été supprimé');
    }

    public function annuler_cotisation_account($cotisation_id, Request $request)
    {
        $cotisation_account_id = $request->get('cotisation_account_id');
        $cotisation_account = CotisationAccount::find($cotisation_account_id);
        $cotisation = Cotisation::find($cotisation_id);
        $cotisation->montant_total_net = $cotisation->montant_total_net - $cotisation_account->montant;
        $cotisation->update();
        $cotisation_account->delete();
        return redirect()->route('cotisation.afficher', $cotisation_id)->with('success', 'la ligne a été supprimé');
    }
}
