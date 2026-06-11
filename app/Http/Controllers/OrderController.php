<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Menampilkan riwayat pesanan (Status: Diproses)
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->where('status', 'Diproses')
                      ->latest()
                      ->get();
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Menampilkan isi keranjang (Status: Keranjang)
     */
    public function cart()
    {
        $carts = Order::where('user_id', Auth::id())
                     ->where('status', 'Keranjang')
                     ->latest()
                     ->get();

        return view('orders.cart', compact('carts'));
    }

    /**
     * Menyimpan data dari halaman Detail Produk
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'qty' => 'required|integer|min:1',
            'total_price' => 'required',
            'status' => 'required'
        ]);

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'qty' => $request->qty,
            'total_price' => $request->total_price,
            'payment_method' => $request->payment_method ?? 'Belum Pilih',
            'status' => $request->status, // Menangkap 'Keranjang' atau 'Diproses'
        ]);

        if ($request->status == 'Keranjang') {
            return redirect()->route('orders.cart')->with('success', 'Berhasil ditambah ke keranjang!');
        }

        return redirect()->route('orders.index')->with('success', 'Pesanan Anda sedang diproses!');
    }

    /**
     * Memindahkan barang dari Keranjang ke Pesanan (Checkout)
     */
    public function checkout($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $order->update(['status' => 'Diproses']);

        return redirect()->route('orders.index')->with('success', 'Barang berhasil dipesan!');
    }

    /**
     * Menghapus barang dari keranjang (Batalkan)
     */
    public function destroy($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Barang telah dibatalkan.');
    }
}