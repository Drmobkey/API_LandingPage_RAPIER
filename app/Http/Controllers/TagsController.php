<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tags;
use Illuminate\Support\Facades\Validator; 


class TagsController extends Controller
{
    //

    public function index()
    {
       $tags = Tags::all();
        return response()->json([
            'data'=>$tags
        ]);
    }
    
    
    public function show(string $id)
    {
       $tags = Tags::find($id);
        return response()->json([
            'data' =>$tags
        ]);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50', 
            'slug' => 'required|string|max:50|unique:posts', 

            // Add more validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tags = Tags::create($request->all());
        return response()->json(['message' => 'Tags berhasil dibuat', 'tags' => $tags], 201);
    }

    public function update(Request $request, $id)
    {
        $tags = Tags::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'slug' => 'required|string|max:50|unique:posts,slug,' . $tags->id,  

            // Add more validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tags->update($request->all());
        return response()->json(['message' => 'Tags berhasil diperbarui', 'data' => $tags]);

    }
}
