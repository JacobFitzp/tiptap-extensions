<?php

namespace App\Http\Controllers;

use App\Foundation\Github\Repository;
use App\Http\Controllers\Concerns\InteractsWithExtensionForm;
use App\Http\Requests\CreateExtensionRequest;
use App\Http\Requests\UpdateExtensionRequest;
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
            'extension' => $extension
                ->load('tagged.tag'),
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
                ...$request->except(['tags']),
                // Generate slug using repository
                'slug' => $repository->slug(),
            ]);

        // Attach tags to the extension.
        $extension->attachTags(
            $request->validated('tags', [])
        );

        // Redirect to the extension management page.
        return redirect()
            ->route('extensions.manage', $extension->slug)
            ->withMessage('Extension created successfully - Please review below and publish.');
    }

    /**
     * Update existing extension.
     */
    public function update(UpdateExtensionRequest $request, Extension $extension): RedirectResponse
    {
        $extension->update($request->except(['tags']));

        // Delete and re-attach tags.
        if ($request->has('tags')) {
            $extension->tagged()->delete();
            $extension->attachTags($request->validated('tags', []));
        }

        return redirect()
            ->route('extensions.update', $extension->slug)
            ->withMessage('Extension updated successfully.', 'success');
    }

    /**
     * Delete an extension.
     */
    public function delete(Extension $extension): RedirectResponse
    {
        $extension->delete();

        return redirect()
            ->route('profile.show', $extension->slug)
            ->withMessage('Extension deleted successfully.', 'success');
    }
}
