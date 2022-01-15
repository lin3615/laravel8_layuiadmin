<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $reture = ['name' => ['required', 'string']];
        if ($this->get('password') || $this->get('password_confirmation')){
            $reture['password'] = 'required|confirmed|min:8|max:14';
        }
        return $reture;
    }
}
