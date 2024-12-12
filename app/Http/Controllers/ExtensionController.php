<?php

namespace App\Http\Controllers;

use App\Foundation\Github\Repository;
use App\Foundation\Tags\Models\Tag;
use App\Http\Requests\CreateExtensionRequest;
use App\Models\Extension;
use Illuminate\Http\RedirectResponse;
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

    public function store(CreateExtensionRequest $request): RedirectResponse
    {
        $repository = Repository::parse($request->validated('repository'));
        $content = $request->validated('content');

        // Use the repositories README if the user has chosen to.
        if ($request->boolean('use_readme')) {
            $content = $request->user()
                ->github()
                ->repo()
                ->readme($repository->owner, $repository->name);
        }

        // Crete the extension and associate it with the user.
        $extension = $request->user()
            ->extensions()
            ->create([
                'content' => $content,
                'slug' => $repository->slug(),
                ...$request->only(['title', 'description', 'repository', 'type']),
            ]);

        // Attach tags to the extension using pivot.
        $extension->attachTagsFromRequest(
            $request->validated('tags', [])
        );

        // Redirect to the extension management page.
        return redirect()
            ->route('extensions.manage', $extension->slug);
    }

    public function manage(Extension $extension): Response
    {
        return Inertia::render('Extensions/Manage', [
            'extension' => $extension,
        ]);
    }
}
