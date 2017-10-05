<?php

namespace ActivismeBE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StatusValidator
 *
 * @author  Tim Joosten
 * @license MIT LICENSE
 * @package ActivismeBE\Http\Requests
 */
class StatusValidator extends FormRequest
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
            'name'          => 'required|unique:statusses',
            'color'         => 'required',
            'description'   => 'required'
        ];
    }
}
