<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'max:2000'],
            'commentable_type' => ['required', 'in:App\Models\Task,App\Models\Project'],
            'commentable_id' => ['required', 'integer', 'exists:' . $this->commentable_type . ',id'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ];
    }
}
