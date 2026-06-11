<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * Sesuai syarat proyek: Identity Management (NIK, Phone, Address, Post Code)
     * Tambahan: role (untuk membedakan Admin dan Customer)
     */
protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'nik',
    'address',
    'post_code',
    'role', // Harus ada di sini
];

    /**
     * Atribut yang disembunyikan saat serialisasi (JSON API).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut ke tipe data tertentu.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * HELPER: Mengecek apakah user adalah Administrator Utama
     * Digunakan Admin sebagai Quality & Transaction Controller.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * HELPER: Mengecek apakah user adalah Customer biasa
     */
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }
}