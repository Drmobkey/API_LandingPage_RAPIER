<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;


class StorePostRequest extends FormRequest
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
            'title' => 'required|string|max:50',
            'slug' => 'required|string|max:50|unique:posts,slug,', 
            'content' => 'required|String|max:50',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
            'published_at' => 'nullable|date',
            'status' => 'required|in:published,draft',
            'meta_title' => 'string|max:50',
            'meta_description' => 'string|max:50',
        ];
    }
}
