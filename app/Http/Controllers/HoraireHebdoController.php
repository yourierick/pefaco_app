<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;
use App\Models\Autorisations;
use App\Models\HoraireHebdo;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class HoraireHebdoController extends Controller
{
    public function list_des_horaires(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'horaire_hebdos')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $horaires = HoraireHebdo::all();

        return view('private_layouts.horairehebdo_folder.list_des_horaires', ['current_user'=>$request->user(), 'horaires'=>$horaires, 'autorisation'=>$autorisation]);
    }

    public function save_horaire(Request $request)
    {
        $request->validate(
            [
                'date_debut'=>['required'],
                'date_fin'=>['required'],
            ],
            [
                'date_debut.required'=>'ce champs est obligatoire',
                'date_fin.required'=>'ce champs est obligatoire',
            ]
        );

        $scan = HoraireHebdo::where('date_debut', $request->date_debut)->first();
        if (!$scan){
            $horaire = HoraireHebdo::create([
                'date_debut'=>$request->get('date_debut'),
                'date_fin'=>$request->get('date_fin'),
            ]);
            return redirect()->route('horairehebdo.list_des_horaires')->with('success', "la semaine a été enregistré");
        }else {
            return redirect()->route('horairehebdo.afficher_un_horaire', $scan->id)->with('success', "cette semaine a déjà été enregistré");
        }
    }


    public function programmer($horaire_id, Request $request)
    {
        $horaire = HoraireHebdo::find($horaire_id);
        $programmation = Programme::where('horaire_id', $horaire_id)->get();
        return view('private_layouts.horairehebdo_folder.programmation_horaire', ['current_user' => $request->user(), 'horaire'=>$horaire, 'programmes'=>$programmation]);
    }

    public function save_programmation($horaire_id, Request $request)
    {
        $request->validate(
            [
                'jour'=>['required'],
                'programme'=>['required'],
            ],
            [
                'jour.required'=>'ce champs est obligatoire',
                'programme.required'=>"aucun programme n'a été renseigné",
            ]
        );

        $data = request()->all();
        $programmes = [];

        if (array_key_exists('programme', $data)) {
            $programmes = array_filter($data['programme']);
        }

        $scan = Programme::where('jour', $request->jour)->where('horaire_id', $horaire_id)->first();
        if (!$scan){
            $programme = Programme::create([
                'horaire_id'=>$horaire_id,
                'jour'=>$request->get('jour'),
                'programme'=>json_encode($programmes),
            ]);

            $action = $request->input('action');
            if ($action == 'soumission') {
                return redirect()->route('horairehebdo.afficher_un_horaire', $horaire_id)->with('success', 'enregistré');
            }else {
                return redirect()->route('horairehebdo.programmer', $horaire_id)->with('success', 'enregistré');
            }
        }else {
            return redirect()->route('horairehebdo.afficher_un_horaire', $horaire_id)->with('error', 'ce jour a déjà été programmé');
        }

    }


    public function afficher_un_horaire($horaire_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'horaire_hebdos')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $horaire = HoraireHebdo::find($horaire_id);
        $programmation = Programme::where('horaire_id', $horaire_id)->get();

        return view('private_layouts.horairehebdo_folder.afficher_horaire', ['horaire'=>$horaire, 'programmes'=>$programmation, 'current_user'=>$request->user(), 'autorisation'=>$autorisation]);
    }


    public function supprimer_un_horaire(Request $request)
    {
        $horaire_id = $request->get('horaire_id');
        $communique = HoraireHebdo::find($horaire_id);
        $communique->delete();

        return redirect()->back()->with('success', "le communiqué a été supprimé");
    }


    public function save_edition_horaire($horaire_id, Request $request)
    {
        $request->validate(
            [
                'date_debut'=>['required', Rule::unique(HoraireHebdo::class)->ignore($horaire_id)],
                'date_fin'=>['required', Rule::unique(HoraireHebdo::class)->ignore($horaire_id)],
            ],
            [
                'date_debut.required'=>'ce champs est obligatoire',
                'date_debut.unique'=>'cette date a déjà été renseigné',
                'date_fin.required'=>'ce champs est obligatoire',
                'date_fin.unique'=>'cette date a déjà été renseigné',
            ]
        );

        $horaire = HoraireHebdo::find($horaire_id);

        $horaire->date_debut = $request->get('date_debut');
        $horaire->date_fin = $request->get('date_fin');

        $horaire->update();

        return redirect()->route('horairehebdo.afficher_un_horaire', $horaire_id)->with('success', 'les mises à jours ont été appliqués');
    }


    public function editer_programme($programme_id ,Request $request)
    {
        $programme = Programme::find($programme_id);
        return view('private_layouts.horairehebdo_folder.editer_programme', ['current_user'=>$request->user(), 'programme'=>$programme]);
    }

    public function save_edition_programme($programme_id ,Request $request)
    {
        $request->validate(
            [
                'jour'=>['required'],
                'programme'=>['required'],
            ],
            [
                'jour.required'=>'ce champs est obligatoire',
                'programme.required'=>"aucun programme n'a été renseigné",
            ]
        );

        $programme = Programme::find($programme_id);

        $data = request()->all();
        $programmes = [];

        if (array_key_exists('programme', $data)) {
            $programmes = array_filter($data['programme']);
        }

        $scan = Programme::where('jour', $request->jour)->where('horaire_id', $programme->horaire_id)->where('id', '!=', $programme_id)->first();
        if (!$scan) {
            $programme->jour = $request->jour;
            $programme->programme = $programmes;
            $programme->update();
        }
        return redirect()->route('horairehebdo.afficher_un_horaire', $programme->horaire_id);
    }
}
