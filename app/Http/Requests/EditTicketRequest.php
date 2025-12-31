<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditTicketRequest extends FormRequest
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
            'travel_id' => 'required',
            'seat_no' => [
                'required',
                Rule::unique('tickets')
                    ->where(
                        fn($query) =>
                        $query->where('travel_id', $this->travel_id)
                    )
                    ->ignore($this->route('ticket')),
            ],
            'name' => 'required|string',
            'gender' => 'in:m,f|nullable',
            'age' => 'nullable|in:dewasa,anak-anak',
            'passport' => 'nullable|string',
            'whatsapp' => 'required|string',
            'is_half' => 'nullable|boolean',
            'from' => 'nullable|in:kupang,soe,kefa,atambua,dili',
            'destination' => 'nullable|in:kupang,soe,kefa,atambua,dili',
            'citizenship' => 'nullable|in:WNI,WNA',
            'pickup' => 'nullable|string',
        ];
    }
}
