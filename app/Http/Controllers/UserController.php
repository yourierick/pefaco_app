<?php

namespace App\Http\Controllers;

use App\Models\AutorisationSpeciale;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    /* afficher la liste de tous les utilisateurs */
    public function profiles():View
    {
        $current_user = Auth::user();
        $users = User::with("groupe_utilisateur")->get();
        return view('private_layouts.list_users', ['users' => $users, 'current_user'=>$current_user]);
    }

    /* Editer un utilisateur */
    public function edit_user(User $user):View
    {
        $current_user = Auth::user();
        $autorisations = AutorisationSpeciale::where('user_id', $user->id)->get();
        $user = User::find($user->id);
        return view('private_layouts.edit_user', compact('user', 'current_user', 'autorisations'));
    }

    /* module de mise à jour des informations d'un utilisateur */
    public function update_user(User $user, Request $request)
    {
        $request->validate([
                'photo'=>['max:5000'],
                'nom' => ['required', 'string', 'max:255'],
                'postnom' => ['required', 'string', 'max:255'],
                'sexe' => ['required'],
                'etat_civil' => ['required'],
                'paroisses_id' => ['required'],
                'departement_id' => ['required'],
                'qualite_id' => ['required'],
                'groupe_utilisateur_id' => ['required'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
                'telephone' => ['required', 'max:10', Rule::unique(User::class)->ignore($user->id)],
            ]);
        $photo_init = $user->photo;
        if ($request->hasFile('photo')){
            /** @var UploadedFile $photo */
            $image = $request->photo;
            $imagePath = $image->store('medias', 'public');
            if ($photo_init){
                Storage::disk('public')->delete($photo_init);
            }
            $user->photo = $imagePath;
        }else {
            $user->photo = $photo_init;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->nom = $request->get('nom');
        $user->postnom = $request->get('postnom');
        $user->prenom = $request->get('prenom');
        $user->sexe = $request->get('sexe');
        $user->lieu_de_naissance = $request->get('lieu_de_naissance');
        $user->date_de_naissance = $request->get('date_de_naissance');
        $user->etat_civil = $request->get('etat_civil');
        $user->adresse = $request->get('adresse');
        $user->paroisses_id = $request->get('paroisses_id');
        $user->departement_id = $request->get('departement_id');
        $user->qualite_id = $request->get('qualite_id');
        $user->groupe_utilisateur_id = $request->get('groupe_utilisateur_id');
        $user->update();

        return Redirect::route('manageprofile.edit_user', $user->id)->with('status', 'profile-updated');
    }

    public function update_user_password(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'password' => ['required', Rules\Password::defaults(), 'confirmed']],
            [
                'password.required'=>'Ce champs est obligatoire',
                'password.confirmed'=>'Les mots de passe ne correspondent pas',
                'password.min'=>'Le mot de passe doit avoir au minimum 8 caractères',
                'password.regex'=>'Le mot de passe doit contenir au moins une lettre et un chiffre',
            ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy_user_account(Request $request, User $user): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user->delete();
        return Redirect::to('manageprofile.list_users');
    }

    public function autorisation_speciales($user_id, Request $request):View
    {
        $autorisations = AutorisationSpeciale::where('user_id', $user_id)->get();
        $user = User::find($user_id);
        return view('private_layouts.autorisations_utilisateurs', ['autorisations' => $autorisations, 'user' => $user, 'current_user'=>$request->user()]);
    }

    public function load_autorisation_speciales($user_id)
    {
        $tables = DB::select('SHOW TABLES');
        $tableNames = array_map('current', $tables);
        $tablesAIgnorer = ['cache', 'jobs', 'failed_jobs', 'cache_locks', 'contenu_agendas', 'cotisation_accounts',
            'job_batches', 'migrations', 'password_reset_tokens', 'sessions', 'qualites', 'permissions',
            'livre_grande_caisses', 'groupes_utilisateurs', 'departements', 'paroisses', 'caisse_accounts', 'autorisations',
            'serviteurs', 'zones', 'users', 'cotisations', 'inventaires', 'message_et_commentaires',
            'don_specials', 'caisses', 'bulletin_infos', 'autorisation_speciales', 'agendas', 'programmes'];

        foreach ($tableNames as $tableName) {
            if (!in_array($tableName, $tablesAIgnorer)) {
                AutorisationSpeciale::create([
                    'user_id'=>$user_id,
                    'table_name' => $tableName,
                ]);
            }
        }
        return redirect()->route('manageprofile.autorisation_speciales', $user_id)->with('success', 'les autorisations ont été chargés');
    }

    public function user_account_status_check ($user_id, Request $request)
    {
        $user = User::find($user_id);
        $message = "";
        if ($request->has('statut')){
            $user->statut = 1;
            $message = "le compte a été activé";
        }else {
            $user->statut = 0;
            $message = "le compte a été désactivé";
        }
        $user->update();
        return redirect()->back()->with('success', $message);
    }

    public function save_autorisations_speciales($autorisation_id, Request $request)
    {
        $data = request()->all();

        $autorisation_speciale = [];

        $autorisation = AutorisationSpeciale::find($autorisation_id);
        if (array_key_exists('autorisation_speciale', $data)) {
            $autorisation_speciale = array_filter($data['autorisation_speciale']);
            $autorisation->autorisation_speciale = json_encode($autorisation_speciale);
        }else {
            $autorisation->autorisation_speciale = json_encode($autorisation_speciale);
        }

        $autorisation->update();
        return redirect()->back()->with('success', 'la mise à jour des autorisations a été faite');
    }
}
