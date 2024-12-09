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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'repository' => 'required|string',
            'type' => ['required', Rule::enum(ExtensionType::class)],
            'use_readme' => 'boolean',
            'content' => 'required_if_declined:use_readme|string',
            'tags' => 'array|max:5',
            'tags.*' => 'string|exists:tags,slug',
        ];
    }
}
