<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\GroupesUtilisateurs;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ParametresController extends Controller
{
    public function settings(Request $request):View
    {
        $users_group = GroupesUtilisateurs::all();
        return view('private_layouts.parametres.parametres', ['current_user'=>$request->user(), 'users_group'=>$users_group]);
    }

    public function add_users_group(Request $request)
    {
        $request->validate([
            'groupe'=>['required', Rule::unique(GroupesUtilisateurs::class)], [
                'groupe.required'=>"Ce champs est obligatoire",
                'groupe.unique'=>"Ce groupe existe déjà",
            ],
        ]);
        $groupe = GroupesUtilisateurs::create([
            'groupe' => $request->get('groupe'),
        ]);
        return redirect()->back();
    }

    public function autorisations($groupe_id, Request $request):View
    {
        $groupe = GroupesUtilisateurs::find($groupe_id);
        $autorisations = Autorisations::where('groupe_id', $groupe_id)->get();
        return view('private_layouts.parametres.parts.autorisations', ['current_user'=>$request->user(), 'groupe'=>$groupe, 'autorisations'=>$autorisations]);
    }

    public function charger_les_models($groupe_id, Request $request)
    {
        $tables = DB::select('SHOW TABLES');
        $tableNames = array_map('current', $tables);
        $tablesAIgnorer = ['cache', 'jobs', 'failed_jobs', 'cache_locks', 'contenu_agendas', 'cotisation_accounts',
            'job_batches', 'migrations', 'password_reset_tokens', 'sessions', 'qualites', 'permissions',
        'livre_grande_caisses', 'groupes_utilisateurs', 'departements', 'paroisses', 'caisse_accounts', 'autorisations',
            'serviteurs', 'zones', 'communiques', 'users', 'autorisation_speciales', 'custom_notifications'];

        Autorisations::create([
            'groupe_id' => $groupe_id,
            'table_name' => 'paramètres généraux'
        ]);
        foreach ($tableNames as $tableName) {
            if (!in_array($tableName, $tablesAIgnorer)) {
                Autorisations::create([
                    'groupe_id'=>$groupe_id,
                    'table_name' => $tableName,
                ]);
            }
        }

        return redirect()->route('autorisations', $groupe_id)->with('success', 'les modèles ont été chargés');
    }

    public function save_autorisation_changes($autorisation_id, Request $request)
    {
        $autorisation = Autorisations::find($autorisation_id);
        if ($request->has('lecture')){
            $autorisation->lecture = 1;
        }else {
            $autorisation->lecture = 0;
        }

        if ($request->has('ecriture')){
            $autorisation->ecriture = 1;
        }else {
            $autorisation->ecriture = 0;
        }

        $data = request()->all();

        $autorisation_en_lecture = [];
        $autorisation_en_ecriture = [];

        if (array_key_exists('autorisation_en_lecture', $data)) {
            $autorisation_en_lecture = array_filter($data['autorisation_en_lecture']);
            $autorisation->autorisation_en_lecture = json_encode($autorisation_en_lecture);
        }else {
            $autorisation->autorisation_en_lecture = json_encode($autorisation_en_lecture);
        }

        if (array_key_exists('autorisation_en_ecriture', $data)) {
            $autorisation_en_ecriture = array_filter($data['autorisation_en_ecriture']);
            $autorisation->autorisation_en_ecriture = json_encode($autorisation_en_ecriture);
        }else {
            $autorisation->autorisation_en_ecriture = json_encode($autorisation_en_ecriture);
        }

        $autorisation->update();
        return redirect()->back()->with('success', 'les droits ont été mis à jour');
    }
}
