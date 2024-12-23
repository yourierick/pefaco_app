<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\RapportDeCulte;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_cultes')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_cultes')->where('user_id', $request->user()->id)->first();
        if ($autorisation) {
            if ($autorisation->autorisation_en_lecture) {
                if (in_array('peux voir tous les rapports', json_decode($autorisation->autorisation_en_lecture, true))) {
                    $rapports_de_culte = RapportDeCulte::where('audience', 'public')->orderBy('id', 'desc')->paginate(1);
                }else {
                    $rapports_de_culte = RapportDeCulte::where('audience', 'public')->where('departement_id', $request->user()->departement_id)->orderBy('id', 'desc')->paginate(1);
                }
            }else {
                $rapports_de_culte = [];
            }
        }else {
            $rapports_de_culte = [];
        }
        return view('private_layouts.dashboard', ['current_user' => $request->user(), 'rapports_de_culte' => $rapports_de_culte, 'autorisation_speciale'=>$autorisation_speciale]);
    }
}
