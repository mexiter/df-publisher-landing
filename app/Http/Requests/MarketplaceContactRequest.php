<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MarketplaceContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => ['required', 'string', Rule::in(['advertiser', 'publisher', 'agency', 'other'])],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'max:255', 'email:rfc'],
            'company' => ['nullable', 'string', 'max:160'],
            'website' => ['nullable', 'url', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ];
    }
}
