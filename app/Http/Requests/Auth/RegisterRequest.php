<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
        if ($this->role === 'candidate') {
            $rules += [
                'experience' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'designation' => ['required', 'string', 'max:255'],
                'skill' => ['required', 'string', 'max:255'],
            ];
        }else{
            $rules += [
                'website' => ['required', 'string', 'max:255'],
                'location' => ['required', 'string', 'max:255'],
                'contact' => ['required', 'string', 'max:255'],
            ];
        }
        return $rules;
    }
}
