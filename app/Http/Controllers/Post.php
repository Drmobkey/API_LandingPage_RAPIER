<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;


class Post extends Controller
{
    public function index()
    {
        $posts = Posts::all();
        return response()->json($posts);
    }

    public function show($id)
    {
        $post = Posts::findOrFail($id);
        return response()->json($post);
    }   //
}
