<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\HoraireHebdo;
use App\Models\RapportDeCulte;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $autorisation = Autorisations::where('table_name', 'rapport_de_cultes')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'rapport_de_cultes')->where('user_id', $request->user()->id)->first();
        $rapports_de_culte = [];
        if (!is_null($autorisation)) {
            if ($autorisation->autorisation_en_lecture) {
                if (in_array('peux voir tous les rapports', json_decode($autorisation->autorisation_en_lecture, true))) {
                    $rapports_de_culte = RapportDeCulte::where('audience', 'public')->orderBy('id', 'desc')->paginate(1);
                }else {
                    $rapports_de_culte = RapportDeCulte::where('audience', 'public')->where('departement_id', $request->user()->departement_id)->orderBy('id', 'desc')->paginate(1);
                }
            }
        }

        $aujourdhui = Carbon::now();
        $horairehebdo = HoraireHebdo::with(['programmes'])->where('date_debut', '<=', $aujourdhui)->where('date_fin', '>=', $aujourdhui)->first();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
        ];

        return view('private_layouts.dashboard', ['current_user' => $request->user(),
        'rapports_de_culte' => $rapports_de_culte, 'autorisation_speciale'=>$autorisation_speciale,
        'breadcrumbs'=>$breadcrumbs, 'horairehebdo'=>$horairehebdo]);
    }
}
