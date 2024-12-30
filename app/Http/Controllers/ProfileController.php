<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Autorisations;
use App\Models\GroupesUtilisateurs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user_group = $request->user()->groupe_utilisateur_id;
        $group = GroupesUtilisateurs::find($user_group)->groupe;

        return view('profile.edit', [
            'user' => $request->user(), 'current_user' => $request->user(), 'group' => $group
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $photo_init = $request->user()->photo ? $request->user()->photo : "";
        $request->user()->fill($request->validated());
        if ($request->hasFile('photo')){
            /** @var UploadedFile $photo */
            $image = $request->photo;
            $imagePath = $image->store('medias', 'public');
            if(Storage::disk('public')->delete($photo_init)) {
                Storage::disk('public')->delete($photo_init);
            }
            $request->user()->photo = $imagePath;
        }else {
            $request->user()->photo = $photo_init;
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
