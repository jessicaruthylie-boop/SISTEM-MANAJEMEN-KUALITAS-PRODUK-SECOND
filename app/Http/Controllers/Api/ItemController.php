<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * GET /api/items
     * Ambil semua item
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Item::all()
        ], 200);
    }

    /**
     * POST /api/items
     * Tambah item baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'nama_barang' => 'required|string',
            'brand'       => 'required|string',
            'kategori'    => 'required|string',
            'grade'       => 'required|string|max:1',
            'harga'       => 'required|integer',
            'stok'        => 'required|integer',
        ]);

        $item = Item::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil ditambahkan',
            'data'    => $item
        ], 201);
    }

    /**
     * GET /api/items/{id}
     * Ambil item berdasarkan ID
     */
    public function show($id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                'success' => false,
                'message' => 'ID item tidak valid'
            ], 200);
        }

        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => $item
        ], 200);
    }

    /**
     * PUT /api/items/{id}
     * Update item
     */
    public function update(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                'success' => false,
                'message' => 'ID item tidak valid'
            ], 200);
        }

        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan'
            ], 200);
        }

        $item->update($request->only([
            'nama_barang',
            'brand',
            'kategori',
            'grade',
            'harga',
            'stok'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil diperbarui',
            'data' => $item
        ], 200);
    }

    /**
     * DELETE /api/items/{id}
     * Hapus item (TIDAK ERROR walaupun ID salah)
     */
    public function destroy($id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                'success' => false,
                'message' => 'ID item tidak valid'
            ], 200);
        }

        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item sudah tidak ada atau tidak ditemukan'
            ], 200);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil dihapus'
        ], 200);
    }
}
