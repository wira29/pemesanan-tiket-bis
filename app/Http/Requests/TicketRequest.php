<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'whatsapp' => 'required|string',
            'pickup' => 'nullable|string',
            'from' => 'nullable|in:kupang,soe,kefa,atambua,dili',
            'destination' => 'nullable|in:kupang,soe,kefa,atambua,dili',
            'is_half' => 'nullable|boolean',
            'seat_no' => ['required', 'array', 'min:1'],
            'seat_no.*' => ['integer'],
            'passengers' => ['required', 'array', 'min:1'],
            'passengers.*.name' => ['required', 'string', 'max:100'],
            'passengers.*.gender' => ['required', 'in:m,f'],
            'passengers.*.age' => ['required', 'in:dewasa,anak-anak'],
            'passengers.*.passport' => ['nullable', 'string'],
            'passengers.*.citizenship' => ['required', 'in:WNI,WNA'],
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $passengerCount = count($this->input('passengers', []));
            $seatCount = count($this->input('seat_no', []));

            if ($passengerCount !== $seatCount) {
                $validator->errors()->add(
                    'seat_no',
                    'Jumlah kursi harus sama dengan jumlah penumpang.'
                );
            }
        });
    }
}
