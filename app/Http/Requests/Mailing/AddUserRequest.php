<?php

declare(strict_types=1);

namespace App\Http\Requests\Mailing;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AddUserRequest
 * @package App\Http\Requests\Mailing
 */
class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'min:3', 'max:25'],
            'last_name' => ['required', 'min:3', 'max:25'],
            'email' => ['required', 'email', 'unique:users,email'],
        ];
    }
}
