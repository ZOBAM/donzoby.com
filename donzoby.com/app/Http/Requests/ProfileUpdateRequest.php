<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string', 'min:2', 'max:25'],
            'last_name' => ['nullable', 'string', 'min:2', 'max:25'],
            'tel' => ['nullable', 'string', 'min:9', 'max:15'],
            'country' => ['nullable', 'string', 'min:2', 'max:25'],
            'avatar' => ['nullable', File::types(['jpg', 'jpeg', 'png'])->min(4)],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
