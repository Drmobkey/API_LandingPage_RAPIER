<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
class AdminPostController extends Controller
{
    //
    public function store(Request $request)
    {
        $post = Posts::create($request->all());
        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Posts::findOrFail($id);
        $post->update($request->all());
        return response()->json($post);
    }

    public function destroy($id)
    {
        Posts::destroy($id);
        return response()->json(null, 204);
    }
}
