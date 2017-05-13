<?php

namespace Afrittella\BackProjectCategories\Http\Requests;

use Afrittella\BackProjectCategories\Domain\Repositories\Categories;
use Illuminate\Foundation\Http\FormRequest;

class CategoryEdit extends FormRequest
{
    /*protected $categories;
    public function __construct(array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null, Categories $categories)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->categories = $categories;
    }*/
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
        //$category = $this->categories->find($this->route('category'));

        return [
            //'slug' => 'required|max:255|unique:categories,slug,'.$category->id,
            'name' => 'required|max:255',
        ];
    }
}
