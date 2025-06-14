<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SharedTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
			'task_id' => 'required',
			'user_id' => 'required',
        ];
    }
}
