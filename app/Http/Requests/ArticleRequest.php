<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'slug' => 'unique:articles',
            'body' => 'required',
            'thumbnail' => 'required',
            'author_id' => 'required',
            'category_id'=>'required',
            'tag'=>'required'
        ];
    }
    public function messages()
    {
        return[
            'title.required' => 'لطفا عنوان خبر را وارد نمایید.',
            'slug.unique' => 'لطفا نام مستعار دیگری انتخاب کنید.',
            'body.required' => 'لطفا متن خبر را وارد نمایید.',
            'thumbnail.required' => 'لطفا تصویر اصلی خبر را انتخاب کنید.',
            'author_id.required'=>'لطفا نویسنده خبر را انتخاب کنید.',
            'category_id.required'=>'لطفا دسته بندی خبر را انتخاب کنید.',
            'tag.required'=>'لطفا تگ های خبر را انتخاب کنید.'
        ];
    }
}
