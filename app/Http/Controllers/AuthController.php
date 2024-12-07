<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('github')
            ->scopes(['read:user', 'public_repo'])
            ->redirect();
    }

    /**
     * Handle the GitHub authentication callback.
     */
    public function callback(): RedirectResponse
    {
        $githubUser = Socialite::driver('github')
            ->user();

        ray($githubUser);

        // Create or update the user in the database.
        $user = User::updateOrCreate([
            'github_id' => $githubUser->getId(),
        ], [
            'name' => $githubUser->getName(),
            'email' => $githubUser->getEmail(),
            'avatar' => $githubUser->getAvatar(),
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);

        // Log the user in, remembering them.
        auth()->login($user, true);

        return redirect()->route('home');
    }

    /**
     * Logout the current user.
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
