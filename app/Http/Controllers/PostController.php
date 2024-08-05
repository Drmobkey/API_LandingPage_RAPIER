<?php

namespace App\Http\Controllers;
use App\Models\Posts;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Posts::all();
        return response()->json($posts);
    }

    public function show($id)
    {
        $post = Posts::findOrFail($id);
        return response()->json($post);
    }
}
