<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
      // GET /api/kategori
    public function index()
    {
        $kategori = Kategori::all();

        return response()->json([
            'status' => true,
            'message' => 'Kategori retrieved successfully',
            'data' => $kategori
        ]);
    }

    // POST /api/kategori
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $kategori = Kategori::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Kategori created successfully',
            'data' => $kategori,
        ], 201);
    }

    // GET /api/kategori/{id}
    public function show($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Kategori not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Kategori retrieved successfully',
            'data' => $kategori,
        ]);
    }

    // PUT /api/kategori/{id}
    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Kategori not found',
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $kategori->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Kategori updated successfully',
            'data' => $kategori,
        ]);
    }

    // DELETE /api/kategori/{id}
    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Kategori not found',
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            'status' => true,
            'message' => 'Kategori deleted successfully',
        ]);
    }
}
