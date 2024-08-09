<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title' => 'string|max:50',
            'slug' => [
                'string',
                'max:50',
                Rule::unique('posts', 'slug')->ignore($this->post),
            ],
            'content' => 'string|max:50',
            'user_id' => 'exists:users,id',
            'category_id' => 'exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
            'published_at' => 'date',
            'status' => 'in:published,draft',
            'meta_title' => 'string|max:50',
            'meta_description' => 'string|max:50',
        ];
    }
}
