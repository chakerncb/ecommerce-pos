<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'phone'       => ['required', 'string', 'max:50'],
            // 'email'       => ['nullable', 'email', 'max:255'],
            'address'     => ['required', 'string'],
            // 'wilaya'      => ['nullable', 'string', 'max:100'],
            // 'municipality'=> ['nullable', 'string', 'max:100'],
            'chip_method' => ['required', 'string', 'in:home,agency'],
            // 'pay_method'  => ['required', 'string', 'in:card,paypal,cash'],
        ];
    }
}
