<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id';
    use HasFactory;
    protected $guarded = [];

    // Tambahkan relasi ke peminjaman
    public function peminjaman(): HasMany
    {
       return $this->hasMany(Peminjaman::class);
    }
}