<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'assignee_id' => ['nullable', 'exists:users,id'],
            'priority' => ['nullable', 'in:low,medium,high,urgent'],
            'category' => ['nullable', 'in:work,personal,health,finance,other'],
            'status' => ['nullable', 'in:todo,in_progress,review,done'],
            'is_completed' => ['nullable', 'boolean'],
            'due_date' => ['nullable', 'date'],
            'due_time' => ['nullable', 'date_format:H:i'],
        ];
    }
}
