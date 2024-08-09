<?php

namespace App\Http\Controllers;

use App\Http\Requests\Services\ServicesStoreRequest;
use App\Http\Requests\Services\ServicesUpdateRequest;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::withTrashed()->get();
        return response()->json([
            'data'=> $services
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
    public function store(ServicesStoreRequest $request)
    {
     
        try {
            $services = Services::create($request->validated());

            return response()->json([
                'data' => $services,
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
        $services = Services::find($id);
        return response()->json([
            'data' => $services
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
    public function update(ServicesUpdateRequest $request, string $id)
    {
        //
        try {
            $services = Services::withTrashed()->findOrFail($id);
            $services->update($request->validated());

            return response()->json([
                'data' => $services,
                'message' => 'Services berhasil diperbarui'
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
        try {
            $services = Services::findOrFail($id);
            if (!$services) {
                return response()->json([
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $services->delete();
            return response()->json(['message' => 'Services berhasil dihapus secara soft'], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage(),
            ], 500);
        }
        //
    }

    public function restore(string $id)
{
    try {
        $services = Services::withTrashed()->findOrFail($id);
        $services->restore();

        return response()->json([
            'data' => $services,
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
        $services = Services::withTrashed()->findOrFail($id);
        $services->forceDelete();

        return response()->json(['message' => 'Services berhasil dihapus secara permanen'], 204);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan saat menghapus data secara permanen: ' . $e->getMessage(),
        ], 500);
    }
}

}
