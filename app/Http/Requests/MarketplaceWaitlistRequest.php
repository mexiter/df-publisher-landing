<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MarketplaceWaitlistRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => ['required', 'string', Rule::in(['advertiser', 'publisher'])],
            'email' => ['required', 'max:255', 'email:rfc'],
            'name' => ['nullable', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:160'],
            'website' => ['nullable', 'url', 'max:255'],
        ];
    }
}
