<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id" => ["required", "string"],
            "name" => ["required", "string"],
            "address.city" => ["required", "string"],
            "address.district" => ["required", "string"],
            "address.street" => ["required", "string"],
            "price" => ["required", "string"],
            "currency" => ["required"],
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Name contains non-English characters',
            'price.lt' => 'Price is over 2000',
            'currency.in' => 'Currency format is wrong'
        ];
    }
}
