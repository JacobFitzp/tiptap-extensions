<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function show(Request $request): Response
    {
        return Inertia::render('Profile/Show', [
            'extensions' => Extension::query()
                ->whereBelongsTo($request->user())
                ->with('tags.tag')
                ->latest()
                ->get(),
        ]);
    }
}
