<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ExtensionController extends Controller
{
    public function submit(Request $request): Response
    {
        return Inertia::render('Extensions/Submit', [
            'repositories' => $request->user()->github()->me()->repositories('maintainer'),
        ]);
    }

    public function handleSubmit(): void {}
}
