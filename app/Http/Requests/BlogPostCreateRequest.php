<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
            'title' => 'required|min:5|max:500|unique:blog_posts',
            'slug' => 'max:200',
            'content_raw' => 'required|string|min:5|max:10000',
            'category_id' => 'required|integer|exists:blog_categories,id',
        ];
    }

    /**
     * Кастомизация сообщений о нарушениях правил валидации
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => ':attribute обязателен',
            'content_raw.min' => 'Минимальное количество символов в тексте статьи: :min',
        ];
    }

    /**
     * Переименование аттрибутов
     * 
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'Заголовок',
        ];
    }
}
