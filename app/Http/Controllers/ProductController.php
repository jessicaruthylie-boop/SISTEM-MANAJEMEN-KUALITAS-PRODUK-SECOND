<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /* 
    =========================================================
    BAGIAN 1: WEB INTERFACE (Untuk Tampilan User & Admin)
    =========================================================
    */

    /**
     * DASHBOARD: Menampilkan pesan selamat datang 
     * dan 5 rekomendasi unit elektronik Grade A (Terbaik).
     */
    public function dashboard()
    {
        // Mengambil 5 unit rekomendasi dengan Grade A atau harga tertinggi
        $recommendations = Product::where('grade', 'A')
                            ->orderBy('price', 'desc')
                            ->take(5)
                            ->get();

        return view('dashboard', compact('recommendations'));
    }

    /**
     * KATALOG PRODUK: Menampilkan list produk masif dengan
     * sistem filter kategori, brand, dan pencarian model.
     */
    public function index(Request $request)
    {
        // Master List Kategori sesuai spesifikasi proyek
        $categories = [
            'Smartphone', 'Laptop', 'Komputer / PC', 'Tablet', 'Televisi (TV)', 
            'Kulkas', 'Mesin Cuci', 'AC (Air Conditioner)', 'Kipas Angin', 
            'Speaker', 'Headphone', 'Earphone'
        ];

        $query = Product::query();

        // Filter: Berdasarkan Kategori
        if ($request->category) {
            $query->where('category', $request->category);
        }

        // Filter: Berdasarkan Brand (Brand muncul jika kategori dipilih)
        if ($request->brand) {
            $query->where('brand', $request->brand);
        }

        // Filter: Pencarian Berdasarkan Nama Model
        if ($request->search) {
            $query->where('model', 'like', '%' . $request->search . '%');
        }

        // Pagination: 12 Produk per halaman agar tampilan rapi
        $products = $query->latest()->paginate(12)->withQueryString();

        // Mengambil brand unik berdasarkan kategori yang dipilih untuk filter sidebar
        $brands = $request->category ? 
                  Product::where('category', $request->category)->distinct()->pluck('brand') : [];

        return view('products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * DETAIL PRODUK (Room Pemesanan): 
     * Menampilkan spesifikasi teknis, grade, dan kalkulator checkout.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }


    /* 
    =========================================================
    BAGIAN 2: API ENDPOINT (JSON - Sesuai Syarat Proyek)
    =========================================================
    */

    /**
     * GET /api/items
     * Mengambil seluruh data inventory dalam format JSON.
     */
    public function apiIndex()
    {
        $products = Product::all();
        return response()->json([
            'status' => 'success',
            'api_version' => 'v2.1',
            'message' => 'Data inventory berhasil ditarik.',
            'count' => $products->count(),
            'data' => $products
        ], 200);
    }

    /**
     * POST /api/items
     * Endpoint untuk Admin menambahkan unit baru via API.
     */
    public function apiStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string',
            'brand'    => 'required|string',
            'model'    => 'required|string',
            'grade'    => 'required|in:A,B,C,D',
            'price'    => 'required|numeric',
            'stock'    => 'required|integer',
            'location' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Mencatat user_id Admin yang menginput
        $data = $request->all();
        $data['user_id'] = Auth::id() ?? 1; // Default ke ID 1 jika tidak ada session (untuk testing)

        $product = Product::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Unit baru berhasil didaftarkan ke sistem.',
            'data' => $product
        ], 201);
    }

    /**
     * GET /api/items/{id}
     * Mengambil detail satu unit spesifik berdasarkan ID.
     */
    public function apiShow($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Error: Unit tidak ditemukan dalam database.'], 404);
        }

        return response()->json($product, 200);
    }

    /**
     * PUT /api/items/{id}
     * Mengupdate metadata unit melalui API.
     */
    public function apiUpdate(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Error: Unit gagal diupdate karena ID tidak ditemukan.'], 404);
        }

        $product->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Metadata unit berhasil diperbarui.',
            'data' => $product
        ], 200);
    }

    /**
     * DELETE /api/items/{id}
     * Menghapus unit secara permanen dari sistem melalui API.
     */
    public function apiDestroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Error: Gagal menghapus, unit tidak ditemukan.'], 404);
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Unit berhasil dimusnahkan dari database MASTER.'
        ], 200);
    }
}