<?php

namespace App\Http\Controllers;

use App\Foundation\Github\Repository;
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
            'repositories' => $request->user()
                ->github()
                ->me()
                ->repositories('maintainer'),
        ]);
    }

    public function store(CreateExtensionRequest $request): void
    {
        // Get the repository owner and name.
        $repository = Repository::parse($request->validated('repository'));

        // Default to using content provided by the user.
        $content = $request->validated('content');

        // Use the repositories README if the user has chosen to.
        if ($request->boolean('use_readme')) {
            $content = $request->user()
                ->github()
                ->repo()
                ->readme('');
        }

        $extension = $request->user()
            ->extensions()
            ->create($request->only([
                'title',
                'description',

            ]));
    }
}
