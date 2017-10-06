<?php

namespace ActivismeBE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PriorityValidator
 *
 * @author  Tim Joosten
 * @license MIT License
 * @package ActivismeBE\Http\Requests
 */
class PriorityValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // auth()->user()->hasRole('supervisor');
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
            'name'          => 'required',
            'color'         => 'required',
            'description'   => 'required'
        ];
    }
}
