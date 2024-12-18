<?php

namespace App\Http\Requests;

use App\Models\Enums\ExtensionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExtensionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'string|min:5|max:255',
            'description' => 'string|max:1000',
            'type' => [Rule::enum(ExtensionType::class)],
            'use_readme' => 'boolean',
            'content' => 'required_if_declined:use_readme',
            'tags' => 'array|max:5',
            'published' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.min' => 'The title must be at least :min characters long.',
            'title.max' => 'The title must be no more than :max characters long.',
            'description.max' => 'The description must be no more than :max characters long.',
            'content.required_if_declined' => 'You must provide content for your extension if you choose not to use the README.',
        ];
    }
}
