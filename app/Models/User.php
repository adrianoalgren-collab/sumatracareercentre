<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'photo',
        'company_name',
        'company_website',
        'skills',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden Fields
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'skills' => 'array',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function documents()
    {
        return $this->hasMany(Document::class)->latest();
    }

    /*
    |--------------------------------------------------------------------------
    | Role Helpers
    |--------------------------------------------------------------------------
    */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPelamar()
    {
        return $this->role === 'pelamar';
    }

   public function isPerusahaan()
    {
        return $this->role === 'perusahaan';
    }

    /*
    |--------------------------------------------------------------------------
    | Profile Accessors
    |--------------------------------------------------------------------------
    */

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->photo
                ? asset('storage/'.$this->photo)
                : 'https://ui-avatars.com/api/?name='
                    .urlencode($this->name)
                    .'&background=004B5F&color=fff',
        );
    }

    protected function profileCompletion(): Attribute
    {
        return Attribute::make(
            get: function () {
                $fields = [
                    $this->photo,
                    $this->phone,
                    $this->address,
                ];

                $filled = collect($fields)
                    ->filter(fn ($f) => ! empty($f))
                    ->count();

                return (int) round(
                    (1 + $filled) / (count($fields) + 1) * 100
                );
            },
        );
    }

    protected function roleLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match (true) {
                $this->isAdmin() => 'Admin',
                $this->isPerusahaan() => 'Perusahaan',
                default => 'Pelamar Aktif',
            },
        );
    }

    protected function roleTagClass(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->isPerusahaan()
                ? 'tag-type'
                : 'tag-open',
        );
    }

    protected function memberId(): Attribute
    {
        return Attribute::make(
            get: fn () => 'SCC-'.str_pad(
                $this->id,
                5,
                '0',
                STR_PAD_LEFT
            ),
        );
    }
    // Tambahkan method ini di dalam class User, di bagian "Relationships"
// (setelah method documents())

public function lamaran()
{
    return $this->hasMany(Lamaran::class)->latest();
}

// Helper: cek apakah user sudah pernah upload dokumen sama sekali
// (dipakai untuk gating tombol "Daftar Sekarang")
public function hasDocuments(): bool
{
    return $this->documents()->exists();
}

}