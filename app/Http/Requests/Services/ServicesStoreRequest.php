<?php

namespace App\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesStoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'icons' => ['required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
            'slug' => ['required', 'string', 'unique:services,slug'],
            'status' => ['required', 'in:publish,draft'],
            'published_at' => ['nullable','date']
        ];
    }
}
