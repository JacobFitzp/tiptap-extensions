<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Render the profile page.
     */
    public function show(Request $request): Response
    {
        return Inertia::render('Profile/Show', [
            // Load extensions belonging to the current user.
            'extensions' => $request->user()
                ->extensions()
                ->latest()
                ->with(['tagged.tags', 'stars', 'reviews'])
                ->get(),
        ]);
    }
}
