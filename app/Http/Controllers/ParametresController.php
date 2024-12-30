<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\GroupesUtilisateurs;
use App\Models\Departements;
use App\Models\Paroisses;
use App\Models\Qualites;
use App\Models\ProgrammeDeCulte;
use App\Models\ProgrammeDuPasteur;
use App\Models\Zones;
use App\Models\ConfigurationGenerale;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;


class ParametresController extends Controller
{
    public function settings(Request $request):View
    {
        $users_group = GroupesUtilisateurs::all();
        $departements = Departements::all();
        $zones = Zones::all();
        $programmedeculte = ProgrammeDeCulte::all();
        $programmedupasteur = ProgrammeDuPasteur::all();
        $paroisses = Paroisses::with('zone')->get();
        $qualites = Qualites::with('departement')->get();
        $configuration_generale = ConfigurationGenerale::first();
        $current_user = $request->user();
        return view('private_layouts.parametres.parametres', compact('users_group', 'configuration_generale', 
        'current_user', 'departements', 'qualites', 'zones', 'paroisses', 'programmedeculte', 'programmedupasteur'));
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
            'serviteurs', 'zones', 'communiques', 'users', 'autorisation_speciales', 'custom_notifications', 'membres', 'invites', 'baptises', 
            'configuration_generales'];

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

    public function save_configuration_generale(Request $request) {
        $request->validate([
            'nom_eglise'=>['required'],
            'localisation'=>['required'],
            'email'=>['required'],
            'contacts'=>['required'],
            'pourcentage_eglise'=>['required'],
            'devise'=>['required'],
            'a_propos_de_nous'=>['required'],
            'historique'=>['required'],
            'notre_mission'=>['required'],
            'notre_vision'=>['required'],
            'notre_communaute'=>['required'],
            'pasteur_responsable'=>['required'],
            'nom_du_pasteur'=>['required'],
        ], [
            'nom_eglise.required'=>"ce champs est obligatoire",
            'localisation.required'=>"ce champs est obligatoire",
            'email.required'=>"ce champs est obligatoire",
            'contacts.required'=>"ce champs est obligatoire",
            'pourcentage_eglise.required'=>"ce champs est obligatoire",
            'devise.required'=>"ce champs est obligatoire",
            'a_propos_de_nous.required'=>"ce champs est obligatoire",
            'historique.required'=>"ce champs est obligatoire",
            'notre_mission.required'=>"ce champs est obligatoire",
            'notre_vision.required'=>"ce champs est obligatoire",
            'notre_communaute.required'=>"ce champs est obligatoire",
            'pasteur_responsable.required'=>"ce champs est obligatoire",
            'nom_du_pasteur.required'=>"ce champs est obligatoire",
        ]);

        $configuration_generale = ConfigurationGenerale::all();

        if (!$configuration_generale->isEmpty()) {
            $configuration_generale = ConfigurationGenerale::find(1);
            $logoinit = $configuration_generale->logo ? $configuration_generale->logo : "";
            if ($request->hasFile('logo')) {
                /** @var UploadedFile $photo */
                $image = $request->logo;
                $imagePath = $image->store('medias', 'public');
                if (Storage::disk('public')->exists($logoinit)){
                    Storage::disk('public')->delete($logoinit);
                }
                $configuration_generale->logo = $imagePath;
            }

            $photo_du_pasteur_responsable_init = $configuration_generale->photo_du_pasteur_responsable ? $configuration_generale->photo_du_pasteur_responsable: "";
            if ($request->hasFile('photo_du_pasteur_responsable')) {
                /** @var UploadedFile $photo */
                $image = $request->photo_du_pasteur_responsable;
                $imagePathPhoto = $image->store('medias', 'public');
                if (Storage::disk('public')->exists($photo_du_pasteur_responsable_init)){
                    Storage::disk('public')->delete($photo_du_pasteur_responsable_init);
                }
                $configuration_generale->photo_du_pasteur_responsable = $imagePathPhoto;
            }

            $configuration_generale->nom_eglise = $request->get('nom_eglise');
            $configuration_generale->localisation = $request->get('localisation');
            $configuration_generale->email = $request->get('email');
            $configuration_generale->contacts = $request->get('contacts');
            $configuration_generale->pourcentage_eglise = $request->get('pourcentage_eglise');
            $configuration_generale->devise = $request->get('devise');
            $configuration_generale->a_propos_de_nous = $request->get('a_propos_de_nous');
            $configuration_generale->historique = $request->get('historique');
            $configuration_generale->notre_mission = $request->get('notre_mission');
            $configuration_generale->notre_vision = $request->get('notre_vision');
            $configuration_generale->notre_communaute = $request->get('notre_communaute');
            $configuration_generale->pasteur_responsable = $request->get('pasteur_responsable');
            $configuration_generale->nom_du_pasteur = $request->get('nom_du_pasteur');

            $configuration_generale->update();
        } else {
            if ($request->hasFile('logo')) {
                /** @var UploadedFile $photo */
                $image = $request->logo;
                $imagePath = $image->store('medias', 'public');
            }
            if ($request->hasFile('photo_du_pasteur_responsable')) {
                /** @var UploadedFile $photo */
                $image = $request->photo_du_pasteur_responsable;
                $imagePathPhoto = $image->store('medias', 'public');
            }
            $configuration_generale = ConfigurationGenerale::create([
                'logo'=>$imagePath,
                'nom_eglise'=>$request->get('nom_eglise'),
                'localisation'=>$request->get('localisation'),
                'email'=>$request->get('email'),
                'contacts'=>$request->get('contacts'),
                'pourcentage_eglise'=>$request->get('pourcentage_eglise'),
                'devise'=>$request->get('devise'),
                'a_propos_de_nous'=>$request->get('a_propos_de_nous'),
                'historique'=>$request->get('historique'),
                'notre_mission'=>$request->get('notre_mission'),
                'notre_vision'=>$request->get('notre_vision'),
                'notre_communaute'=>$request->get('notre_communaute'),
                'pasteur_responsable'=>$request->get('pasteur_responsable'),
                'nom_du_pasteur'=>$request->get('nom_du_pasteur'),
                'photo_du_pasteur_responsable'=>$imagePathPhoto,
            ]);
        }

        return redirect()->back()->with('success', 'enregistré');
    }


    //---------------ZONES---------- QUALITES------------DEPARTEMENTS----------------PAROISSES-----------------------//
    public function ajouter_departement(Request $request) {
        $request->validate([
            'designation',
        ]);

        $departement = Departements::create([
            'designation'=>$request->get('designation'),
        ]);

        return redirect()->back()->with('success', 'le département a été ajouté');
    }

    public function editer_departement(Request $request) {
        $request->validate([
            'designation',
            'id',
        ]);

        $departement = Departements::find($request->get('id'));
        $departement->designation = $request->get('designation');
        $departement->update();

        return redirect()->back()->with('success', 'les modifications ont été enregistrés');
    }

    public function supprimer_departement(Request $request) {
        $departement_id = $request->get('departement_id');
        $departement = Departements::find($departement_id);
        $departement->delete();

        return redirect()->back()->with('success', 'le département a été supprimé');
    }


    public function ajouter_zone(Request $request) {
        $request->validate([
            'designation',
        ]);

        $zone = Zones::create([
            'designation'=>$request->get('designation'),
        ]);

        return redirect()->back()->with('success', 'la zone a été ajouté');
    }


    public function editer_zone(Request $request) {
        $request->validate([
            'designation',
            'id',
        ]);

        $zone = Zones::find($request->get('id'));
        $zone->designation = $request->get('designation');
        $zone->update();

        return redirect()->back()->with('success', 'les modifications ont été enregistrés');
    }

    public function supprimer_zone(Request $request) {
        $zone_id = $request->get('zone_id');
        $zone = Zones::find($zone_id);
        $zone->delete();

        return redirect()->back()->with('success', 'la zone a été supprimé');
    }


    public function ajouter_paroisse(Request $request) {
        $request->validate([
            'designation',
            'localisation',
            'zone_id',
        ]);

        $paroisse = Paroisses::create([
            'designation'=>$request->get('designation'),
            'localisation'=>$request->get('localisation'),
            'zones_id'=>$request->get('zone_id'),
        ]);

        return redirect()->back()->with('success', 'la zone a été ajouté');
    }

    public function editer_paroisse(Request $request) {
        $request->validate([
            'designation',
            'localisation',
            'zone_id',
        ]);

        $paroisse = Paroisses::find($request->get('id'));
        $paroisse->zones_id = $request->get('zone_id');
        $paroisse->designation = $request->get('designation');
        $paroisse->localisation = $request->get('localisation');
        $paroisse->update();

        return redirect()->back()->with('success', 'les modifications ont été enregistrés');
    }

    public function supprimer_paroisse(Request $request) {
        $paroisse_id = $request->get('paroisse_id');
        $paroisse = Paroisses::find($paroisse_id);
        $paroisse->delete();

        return redirect()->back()->with('success', 'la paroisse a été supprimé');
    }

    public function ajouter_qualite(Request $request) {
        $request->validate([
            'departement_id',
            'designation',
        ]);

        $qualite = Qualites::create([
            'departement_id'=>$request->get('departement_id'),
            'designation'=>$request->get('designation'),
        ]);

        return redirect()->back()->with('success', 'la qualité a été ajouté');
    }

    public function editer_qualite(Request $request) {
        $request->validate([
            'departement_id',
            'designation',
        ]);

        $qualite = Qualites::find($request->get('id'));
        $qualite->departement_id = $request->get('departement_id');
        $qualite->designation = $request->get('designation');
        $qualite->update();

        return redirect()->back()->with('success', 'les modifications ont été enregistrés');
    }

    public function supprimer_qualite(Request $request) {
        $qualite_id = $request->get('qualite_id');
        $qualite = Qualites::find($qualite_id);
        $qualite->delete();

        return redirect()->back()->with('success', 'la qualite a été supprimé');
    }


    public function ajouter_programmeculte(Request $request) {
        $request->validate([
            'jour',
            'interval_de_temps',
            'programme',
        ]);

        $programmeculte = ProgrammeDeCulte::create([
            'jour'=>$request->get('jour'),
            'interval_de_temps'=>$request->get('interval_de_temps'),
            'programme'=>$request->get('programme'),
        ]);

        return redirect()->back()->with('success', 'le programme a été enregistré');
    }

    public function editer_programmeculte(Request $request) {
        $request->validate([
            'jour',
            'interval_de_temps',
            'programme',
        ]);

        $programmeculte = ProgrammeDeCulte::find($request->get('id'));
        $programmeculte->jour = $request->get('jour');
        $programmeculte->interval_de_temps = $request->get('interval_de_temps');
        $programmeculte->programme = $request->get('programme');
        $programmeculte->update();

        return redirect()->back()->with('success', 'les modifications ont été enregistrés');
    }

    public function supprimer_programmeculte(Request $request) {
        $programmeculte_id = $request->get('programmedeculte_id');
        $programmeculte = ProgrammeDeCulte::find($programmeculte_id);
        $programmeculte->delete();

        return redirect()->back()->with('success', 'le programme a été supprimé');
    }

    public function ajouter_programmedupasteur(Request $request) {
        $request->validate([
            'jour',
            'interval_de_temps',
        ]);

        $programmedupasteur = ProgrammeDuPasteur::create([
            'jour'=>$request->get('jour'),
            'interval_de_temps'=>$request->get('interval_de_temps'),
        ]);

        return redirect()->back()->with('success', 'le programme a été enregistré');
    }

    public function editer_programmedupasteur(Request $request) {
        $request->validate([
            'jour',
            'interval_de_temps',
        ]);

        $programmedupasteur = ProgrammeDuPasteur::find($request->get('id'));
        $programmedupasteur->jour = $request->get('jour');
        $programmedupasteur->interval_de_temps = $request->get('interval_de_temps');
        $programmedupasteur->update();

        return redirect()->back()->with('success', 'les modifications ont été enregistrés');
    }

    public function supprimer_programmedupasteur(Request $request) {
        $programmedupasteur_id = $request->get('programmedupasteur_id');
        $programmedupasteur = ProgrammeDuPasteur::find($programmedupasteur_id);
        $programmedupasteur->delete();

        return redirect()->back()->with('success', 'le programme a été supprimé');
    }
}
