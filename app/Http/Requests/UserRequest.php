<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed avatar
 */

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
        return [
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:80',
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=208,min_height=208',
        ];
    }
    /**
     * Set error messages for invalid input
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => 'The username is token, please try another one.',
            'name.regex' => 'Invalid username, only chars, numbers, "-" and "_" are available.',
            'name.between' => 'The length of username must range between 3 - 25.',
            'name.required' => 'Username can\'t be null.',
            'avatar.mimes' =>'Your avatar must be an image in format of jpeg, bmp, png or gif',
            'avatar.dimensions' => 'Your avatar\'s resolution must larger than 208px * 208px',
        ];
    }
}
