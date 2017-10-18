<?php

namespace ActivismeBE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UsersValidator
 *
 * @author  Tim Joosten
 * @license MIT License
 * @package ActivismeBE\Http\Requests
 */
class UsersValidator extends FormRequest
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
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'language'  => 'required',
            // 'password'  => 'required|string|min:6|confirmed',
        ];
    }
}
