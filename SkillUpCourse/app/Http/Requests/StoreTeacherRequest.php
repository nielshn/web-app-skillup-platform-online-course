<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['owner']);
    }


    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255'
        ];
    }
}
