<?php

namespace App\Http\Controllers\Auth;

use App\Models\AutorisationSpeciale;
use App\Http\Controllers\Controller;
use App\Models\Qualites;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/manage_user'), 'label'=>"Profiles", 'icon'=>'bi-people fs-5'],
            ['url'=>url('register'), 'label'=>"Ajouter", 'icon'=>'bi-pencil-square fs-5'],
        ];
        $current_user = Auth::user();
        return view('auth.register', ['current_user'=>$current_user, "breadcrumbs"=>$breadcrumbs]);
    }

    #Ajax::load qualites
    public function qualites_loader($dept_id)
    {
        $qualites = Qualites::where('departement_id', $dept_id)->get();
        return response()->json($qualites);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'photo'=>['max:5000'],
            'nom' => ['required', 'string', 'max:255'],
            'postnom' => ['required', 'string', 'max:255'],
            'sexe' => ['required'],
            'etat_civil' => ['required'],
            'telephone' => ['required', 'max:10', 'unique:'.User::class],
            'paroisses_id' => ['required'],
            'departement_id' => ['required'],
            'qualite_id' => ['required'],
            'groupe_utilisateur_id' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $current_user = Auth::user();
        $imagePath = "";
        if ($request->hasFile('photo')){
            /** @var UploadedFile $photo */
            $image = $request->photo;
            $imagePath = $image->store('medias', 'public');
        }

        $user = User::create([
            'photo' => $imagePath,
            'nom' => $request->nom,
            'postnom' => $request->postnom,
            'prenom' => $request->prenom,
            'sexe' => $request->sexe,
            'lieu_de_naissance'=>$request->lieu_de_naissance,
            'date_de_naissance'=>$request->date_de_naissance,
            'etat_civil'=>$request->etat_civil,
            'adresse'=>$request->adresse,
            'telephone'=>$request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'paroisses_id'=>$request->paroisses_id,
            'departement_id'=>$request->departement_id,
            'qualite_id'=>$request->qualite_id,
            'groupe_utilisateur_id'=>$request->groupe_utilisateur_id,
        ]);
        
        $tables = DB::select('SHOW TABLES');
        $tableNames = array_map('current', $tables);
        $tablesAIgnorer = ['cache', 'jobs', 'failed_jobs', 'cache_locks', 'contenu_agendas', 'cotisation_accounts',
            'job_batches', 'migrations', 'password_reset_tokens', 'sessions', 'qualites', 'permissions',
            'livre_grande_caisses', 'groupes_utilisateurs', 'departements', 'paroisses', 'caisse_accounts', 'autorisations',
            'serviteurs', 'zones', 'users', 'cotisations', 'inventaires', 'message_et_commentaires',
            'don_specials', 'caisses', 'bulletin_infos', 'autorisation_speciales', 'agendas'];

        AutorisationSpeciale::create([
            'user_id' => $user_id,
            'table_name' => 'paramètres généraux'
        ]);
        
        foreach ($tableNames as $tableName) {
            if (!in_array($tableName, $tablesAIgnorer)) {
                AutorisationSpeciale::create([
                    'user_id'=>$user->id,
                    'table_name' => $tableName,
                ]);
            }
        }
        //event(new Registered($user));
        //Auth::login($user);

        return redirect()->route('manageprofile.list_users', ['current_user' => $current_user])->with('success', "l'utilisateur a été crée");
    }
}
