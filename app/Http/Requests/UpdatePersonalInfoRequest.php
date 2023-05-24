<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update personal info');
    }

    public function rules(): array
    {
        return [
           'phone' => ['required', 'string'],
           'weight' => ['required', 'numeric'],
           'height' => ['required', 'numeric'],
           'other_info' => ['sometimes', 'nullable', 'max:255'],
        ];
    }
}
