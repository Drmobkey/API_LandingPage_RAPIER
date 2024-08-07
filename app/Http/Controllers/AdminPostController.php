<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $post = Posts::withTrashed()->get();
        return response()->json([
            'data' => $post
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
        try {
            $post = Posts::create($request->validated());

            return response()->json([
                'data' => $post,
                'message' => 'Data berhasil dibuat',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat membuat data: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $post = Posts::find($id);
        return response()->json([
            'data' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        //
        try {
            $post = Posts::withTrashed()->findOrFail($id);
            $post->update($request->validated());

            return response()->json([
                'data' => $post,
                'message' => 'Data berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $post = Posts::findOrFail($id);
            if (!$post) {
                return response()->json([
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $post->delete();
            return response()->json(['message' => 'Data berhasil dihapus secara soft'], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function restore(string $id)
    {
        try {
            $post = Posts::withTrashed()->findOrFail($id);
            $post->restore();

            return response()->json([
                'data' => $post,
                'message' => 'Services berhasil direstorasi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat merestorasi data: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function forceDelete(string $id)
    {
        try {
            $post = Posts::withTrashed()->findOrFail($id);
            $post->forceDelete();

            return response()->json(['message' => 'Services berhasil dihapus secara permanen'], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data secara permanen: ' . $e->getMessage(),
            ], 500);
        }
    }

}
