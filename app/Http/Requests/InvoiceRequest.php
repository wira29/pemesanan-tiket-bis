<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'invoice_code' => 'required|string|max:255|unique:invoices,invoice_code',
            'travel_id' => 'required|string|max:255',
            'date' => 'required|date',
            'total_price' => 'required|numeric',
            'passengers' => 'required|string',
        ];
    }
}
