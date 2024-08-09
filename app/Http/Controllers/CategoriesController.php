<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator; 

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Categories::all();
        return response()->json([
            'data'=> $categories
        ]);
    }
    
    
    public function show(string $id)
    {
        $categories = Categories::find($id);
        return response()->json([
            'data' => $categories
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

        $kategori = Categories::create($request->all());
        return response()->json(['message' => 'Kategori berhasil dibuat', 'kategori' => $kategori], 201);
    }

    public function update(Request $request, $id)
    {
        $kategori = Categories::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'slug' => 'required|string|max:50|unique:posts,slug,' . $kategori->id,  

            // Add more validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kategori->update($request->all());
        return response()->json(['message' => 'Data berhasil diperbarui', 'data' => $kategori]);

    }
}
