<?php

namespace ActivismeBE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AccountSecurityValidator
 *
 * @author  Tim Joosten
 * @license MIT License
 * @package ActivismeBE\Http\Requests
 */
class AccountSecurityValidator extends FormRequest
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
        return ['password' => 'required|string|min:6|confirmed'];
    }
}
