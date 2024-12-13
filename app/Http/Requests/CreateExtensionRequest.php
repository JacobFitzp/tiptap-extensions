<?php

namespace App\Http\Requests;

use App\Models\Enums\ExtensionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateExtensionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|max:1000',
            // todo: Strengthen validation (check format, check repo exists)
            'repository' => 'required|string|unique:extensions,repository',
            'type' => ['required', Rule::enum(ExtensionType::class)],
            'use_readme' => 'boolean',
            'content' => 'required_if_declined:use_readme',
            'tags' => 'array|max:5',
            'tags.*.id' => 'required|exists:tags',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title for your extension.',
            'title.min' => 'The title must be at least :min characters long.',
            'title.max' => 'The title must be no more than :max characters long.',
            'description.required' => 'Please enter a description for your extension.',
            'description.max' => 'The description must be no more than :max characters long.',
            'repository.required' => 'Please select a GitHub repository for your extension.',
            'type.required' => 'Please select a type for your extension.',
            'content.required_if_declined' => 'You must provide content for your extension if you choose not to use the README.',
        ];
    }
}
