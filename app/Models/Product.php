<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * Tabel yang terhubung dengan model ini.
     * Secara default Laravel akan mencari tabel 'products'.
     */
    protected $table = 'products';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * user_id: ID Administrator yang menginput/mengelola data (Audit Trail).
     * grade: Otoritas kualitas (A, B, C, D).
     */
    protected $fillable = [
        'user_id',
        'category',
        'brand',
        'model',
        'description',
        'grade',
        'location',
        'stock',
        'price',
        'image',
    ];

    /**
     * Casting atribut ke tipe data tertentu untuk memastikan presisi.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * RELASI: Product belongs to User (Administrator).
     * Berfungsi untuk melacak Administrator mana yang bertanggung jawab 
     * atas entri data barang ini (System Auditor).
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * RELASI: Product has many Orders.
     * Menghubungkan produk dengan riwayat transaksi di tabel orders.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}