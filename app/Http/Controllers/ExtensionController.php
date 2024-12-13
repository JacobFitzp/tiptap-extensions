<?php

namespace App\Http\Controllers;

use App\Foundation\Github\Repository;
use App\Http\Controllers\Concerns\InteractsWithExtensionForm;
use App\Http\Requests\CreateExtensionRequest;
use App\Models\Extension;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ExtensionController extends Controller
{
    use InteractsWithExtensionForm;

    /**
     * Render extension submission page.
     */
    public function submit(Request $request): Response
    {
        return Inertia::render(
            'Extensions/Submit',
            $this->extensionFormProps($request->user())
        );
    }

    /**
     * Render extension management page.
     */
    public function manage(Request $request, Extension $extension): Response
    {
        return Inertia::render('Extensions/Manage', [
            ...$this->extensionFormProps($request->user()),
            'extension' => $extension,
        ]);
    }

    /**
     * Store new extension.
     */
    public function store(CreateExtensionRequest $request): RedirectResponse
    {
        $repository = Repository::parse($request->validated('repository'));

        // Crete the extension.
        $extension = $request->user()
            ->extensions()
            ->create([
                ...$request->only([
                    'title',
                    'description',
                    'repository',
                    'type',
                    'use_readme',
                ]),
                // Generate slug using repository
                'slug' => $repository->slug(),
                // Include content if not using readme
                ...$request->boolean('use_readme', true)
                    ? []
                    : ['content' => $request->validated('content')],
            ]);

        // Attach tags to the extension.
        $extension->attachTagsFromRequest(
            $request->validated('tags', [])
        );

        // Redirect to the extension management page.
        return redirect()
            ->route('extensions.manage', $extension->slug);
    }
}
