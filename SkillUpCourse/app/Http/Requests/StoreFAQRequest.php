<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreFAQRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['owner']);
    }


    public function rules(): array
    {
        return [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ];
    }
}
