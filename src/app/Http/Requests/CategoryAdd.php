<?php

namespace Afrittella\BackProjectCategories\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryAdd extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'slug' => 'required|max:255|unique:categories',
            'name' => 'required|max:255'
        ];
    }
}
