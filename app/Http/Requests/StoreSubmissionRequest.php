<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create submission');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'symptoms' => ['required', 'string'],
        ];
    }
}
