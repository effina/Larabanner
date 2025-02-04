<?php

namespace effina\Larabanner\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LarabannerRequest extends FormRequest
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
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name'               => ['required', 'string', 'max:255'],
            'contents'           => ['required', 'string'],
            'display_days'       => ['nullable', 'array'],
            'display_days.*'     => ['in:sun,mon,tue,wed,thu,fri,sat'],
            'display_start_date' => ['required', 'date'],
            'display_stop_date'  => ['nullable', 'date', 'after:display_start_date'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'               => 'banner name',
            'contents'           => 'banner contents',
            'display_days'       => 'display days',
            'display_start_date' => 'start date',
            'display_stop_date'  => 'end date',
        ];
    }
}
