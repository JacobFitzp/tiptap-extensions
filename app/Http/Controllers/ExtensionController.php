<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExtensionRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ExtensionController extends Controller
{
    public function submit(Request $request): Response
    {
        return Inertia::render('Extensions/Submit', [
            'tags' => Tag::all(),
            'repositories' => $request
                ->user()
                ->github()
                ->me()
                ->repositories('maintainer'),
        ]);
    }

    public function handleSubmit(CreateExtensionRequest $request): array {}
}
