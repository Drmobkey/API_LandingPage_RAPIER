<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\Validator; 

class AdminPostController extends Controller
{
    //
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50', 
            'slug' => 'required|string|max:50|unique:posts', 

            // Add more validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = Posts::create($request->all());
        return response()->json(['message' => 'Data berhasil dibuat', 'data' => $post], 201);
    }

    public function update(Request $request, $id)
    {
        $post = Posts::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'slug' => 'required|string|max:50|unique:posts,slug,' . $post->id, 
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'published_at' => 'date',
            'status' => 'required|in:published,draft',
            'meta_title' => 'string|max:50',
            'meta_description' => 'string|max:50',

            // Add more validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post->update($request->all());
        return response()->json(['message' => 'Data berhasil diperbarui', 'data' => $post]);

    }

    public function destroy($id)
    {
        Posts::find($id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus secara soft'], 204);
    }
}
