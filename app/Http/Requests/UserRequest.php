<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
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
        $routeName = $this->route()->getName();
        
        return [
            'first_name'=>[$routeName == 'users.login' ? 'nullable' : 'required' , 'min:3' , 'max:35'],
            'last_name'=>[$routeName == 'users.login' ? 'nullable' : 'required' , 'min:3' , 'max:35'],
            'birth_date'=>[$routeName == 'users.login' ? 'nullable' : 'required' , 'date'],
            'phone_number'=>[$routeName == 'users.register' ? 'unique:users' : 'nullable' , $routeName == 'users.login' ? 'nullable' : 'required' , 'digits:11'],
            'email'=>[$routeName == 'users.register' ? 'unique:users' : 'nullable' , 'required' , 'email'],
            'password'=>'required|between:8,30',
            'confirmation_password'=>[$routeName == 'users.register' ? 'required' : 'nullable' , 'same:password'],
        ];
    }
}
