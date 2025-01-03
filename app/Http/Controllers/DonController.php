<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\donSpecial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DonController extends Controller
{
    public function list_des_dons(Request $request):View
    {
        $dons = donSpecial::all();
        $autorisations = Autorisations::where('table_name', 'don_specials')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/dons/list'), 'label'=>"Dons", 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.dons_speciaux.dons', ['dons' => $dons, 'current_user' => $request->user(), 
        'autorisations' => $autorisations, "breadcrumbs"=>$breadcrumbs]);
    }

    public function add_new_don(Request $request): View
    {
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/dons/list'), 'label'=>"Dons", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/dons/add_new'), 'label'=>"Ajouter", 'icon'=>'bi-plus-circle fs-5'],
        ];
        return view('private_layouts.dons_speciaux.adddon', ['current_user' => $request->user(), "breadcrumbs"=>$breadcrumbs]);
    }

    public function save_new_don(Request $request)
    {
        $request->validate([
            'date' => ['required'],
            'donateur'=> ['required'],
            'don' => ['required'],
        ], [
            'date.required'=>'Ce champs est obligatoire',
            'donateur.required'=>'Ce champs est obligatoire',
            'don.required'=>'Ce champs est obligatoire',
        ]);

        $don = donSpecial::create([
            'date'=>$request->get('date'),
            'donateur'=>$request->get('donateur'),
            'don' => $request->get('don'),
        ]);

        return redirect()->route('don.list')->with('success', "le don a été enregistré");
    }

    public function edit_don($don_id, Request $request): View
    {
        $don = donSpecial::find($don_id);
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/dons/list'), 'label'=>"Dons", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/dons/edit_don'), 'label'=>"Editer", 'icon'=>'bi-plus-circle fs-5'],
        ];
        return view('private_layouts.dons_speciaux.editdon',
            ['don'=>$don, 'current_user'=>$request->user(), "breadcrumbs"=>$breadcrumbs]);
    }

    public function save_edition_don($don_id, Request $request)
    {
        $request->validate([
            'date' => ['required'],
            'donateur'=> ['required'],
            'don' => ['required'],
        ], [
            'date.required'=>'Ce champs est obligatoire',
            'donateur.required'=>'Ce champs est obligatoire',
            'don.required'=>'Ce champs est obligatoire',
        ]);

        $don = donSpecial::find($don_id);
        $don->date = $request->get('date');
        $don->donateur = $request->get('donateur');
        $don->don = $request->get('don');
        $don->update();

        return redirect()->route('don.list')->with('success', 'les informations ont été mises à jour');
    }

    public function supprimer_don(Request $request)
    {
        $don_id = $request->get('don_id');
        $don = donSpecial::find($don_id);
        $don->delete();
        return redirect()->route('don.list')->with('success', 'le don a été supprimé');
    }
}
