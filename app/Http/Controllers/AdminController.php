<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * 1. DASHBOARD INTELLIGENCE
     * Rekapitulasi statistik vital sistem secara real-time.
     */
    public function index(Request $request)
    {
        $stats = [
            // Revenue: Akumulasi dari pesanan yang sukses/sedang dikirim
            'total_revenue'  => Order::whereIn('status', ['SUCCESS', 'Sedang Dikirim'])->sum('total_price'),
            
            // Pending Verify: Pesanan yang menunggu tindakan manual Admin
            'pending_orders' => Order::where('status', 'Diproses')->count(),
            
            // Stock Warning: Peringatan otomatis jika unit < 3 (Critical Stock)
            'low_stock'      => Product::where('stock', '<', 3)->count(),
            
            // Active Persona: Total user dengan peran 'customer'
            'active_users'   => User::where('role', 'customer')->count(),
        ];

        // Data untuk tabel audit di dashboard
        $query = Product::query();
        if ($request->search) {
            $query->where('model', 'like', '%' . $request->search . '%');
        }
        $products = $query->latest()->paginate(10);

        // Feed Transaksi & User Terbaru
        $orders = Order::with('user')->where('status', '!=', 'Keranjang')->latest()->take(5)->get();
        $users  = User::where('role', 'customer')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'products', 'orders', 'users'));
    }

    /**
     * 2. INVENTORY MASTER (Advanced CRUD)
     * Manajemen database produk masif dengan Quality Grading Otoritas Admin.
     */
    public function inventoryIndex(Request $request)
    {
        $query = Product::query();

        // Filter Pencarian & Taksonomi
        if ($request->search) {
            $query->where('model', 'like', "%{$request->search}%")
                  ->orWhere('brand', 'like', "%{$request->search}%");
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->grade) {
            $query->where('grade', $request->grade);
        }

        $products = $query->latest()->paginate(20)->withQueryString();

        return view('admin.inventory.index', compact('products'));
    }

    public function inventoryCreate()
    {
        return view('admin.inventory.create');
    }

    public function inventoryStore(Request $request)
    {
        $request->validate([
            'category'    => 'required',
            'brand'       => 'required',
            'model'       => 'required',
            'grade'       => 'required|in:A,B,C,D',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'location'    => 'required',
            'description' => 'required',
        ]);

        // System Auditor: Mencatat user_id admin yang melakukan registrasi unit
        Product::create(array_merge($request->all(), ['user_id' => Auth::id()]));

        return redirect()->route('admin.inventory.index')
                         ->with('success', 'SYSTEM_UPDATE: Unit berhasil diregistrasi ke Database Master.');
    }

    public function inventoryEdit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.inventory.edit', compact('product'));
    }

    public function inventoryUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('admin.inventory.index')
                         ->with('success', 'SYSTEM_UPDATE: Metadata unit berhasil diperbarui.');
    }

    public function inventoryDestroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.inventory.index')
                         ->with('success', 'SYSTEM_DESTRUCTION: Data unit dihapus permanen dari sistem.');
    }

    /**
     * 3. FINANCIAL VAULT (Transaction Reconciliation)
     * Rekonsiliasi 14 metode pembayaran (10 Bank & 4 E-Wallet).
     */
    public function transactionIndex()
    {
        $orders = Order::with(['user', 'product'])
                      ->where('status', '!=', 'Keranjang')
                      ->latest()
                      ->get();

        // Data statistik khusus halaman Financial Vault
        $stats = [
            'revenue'    => Order::whereIn('status', ['SUCCESS', 'Sedang Dikirim'])->sum('total_price'),
            'awaiting'   => Order::where('status', 'AWAITING')->count(),
            'pending_tx' => Order::where('status', 'Diproses')->count(),
            'total_success' => Order::whereIn('status', ['SUCCESS', 'Sedang Dikirim'])->count(),
        ];

        return view('admin.transactions.index', compact('orders', 'stats'));
    }

    /**
     * Payment Verification Engine
     * Memvalidasi nominal dan memicu perubahan stok gudang secara otomatis.
     */
    public function verifyPayment($id)
    {
        DB::beginTransaction();
        try {
            $order = Order::findOrFail($id);
            $product = Product::findOrFail($order->product_id);

            // Validasi Stok sebelum Approval
            if ($product->stock < $order->qty) {
                return back()->with('error', 'VOID_ERROR: Stok gudang tidak mencukupi untuk pesanan ini.');
            }

            // 1. Rekonsiliasi Otomatis: Kurangi Stok
            $product->decrement('stock', $order->qty);

            // 2. Status Orchestration: Ubah status menjadi 'Sedang Dikirim' (Memicu notifikasi User)
            $order->update(['status' => 'Sedang Dikirim']);

            DB::commit();
            return back()->with('success', 'PAYMENT_VERIFIED: Transaksi Sah. Logistik sedang memproses unit.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'DATABASE_CRITICAL: Gagal melakukan sinkronisasi data transaksi.');
        }
    }

    /**
     * Void Management: Membatalkan pesanan (Penanganan Sengketa)
     */
    public function voidOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Failed']);
        return back()->with('success', 'VOID_SUCCESS: Pesanan telah dibatalkan oleh Administrator.');
    }

    /**
     * 4. USER SURVEILLANCE
     * Identity Management & Pelacakan Histori Pengguna (NIK Validation).
     */
    public function userIndex()
    {
        $users = User::where('role', 'customer')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Identity Purge: Menghapus akses persona pengguna
     */
    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'SURVEILLANCE_UPDATE: Akses identitas persona berhasil dicabut.');
    }

    /* 
    =========================================================
    5. API GATEWAY (INTEGRASI JSON)
    =========================================================
    */

    public function apiIndex()
    {
        return response()->json([
            'status' => 'authorized',
            'protocol' => 'REST_JSON',
            'api_version' => 'v.2.1.2',
            'timestamp' => now()->toIso8601String(),
            'data' => Product::all()
        ], 200);
    }

    public function apiShow($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Record_Not_Found'], 404);
        return response()->json($product, 200);
    }
}