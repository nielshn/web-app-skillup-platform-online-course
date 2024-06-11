<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['owner', 'student']);
    }

    public function rules(): array
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'note' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
