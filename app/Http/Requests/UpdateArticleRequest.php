<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
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
    protected function prepareForValidation()
    {
        if($this->input('slug')){
            $this->merge(['slug'=>make_slug($this->input('slug'))]);
        }else{
            $this->merge(['slug'=>make_slug($this->input('title'))]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'slug' => Rule::unique('articles')->ignore(request()->article),
            'body' => 'required',
            'thumbnail' => 'required',
            'category_id'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'title.required' => 'لطفا تیتر خبر را وارد نمایید.',
            'slug.unique' => 'لطفا نام مستعار دیگری انتخاب کنید.',
            'body.required' => 'لطفا متن خبر را وارد نمایید.',
            'thumbnail.required' => 'لطفا تصویر اصلی خبر را انتخاب کنید.',
            'category_id.required'=>'لطفا دسته بندی خبر را انتخاب کنید.',
        ];
    }
}
