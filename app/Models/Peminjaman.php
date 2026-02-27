<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    
    protected $table = 'peminjaman';

    protected $fillable = [
        'kode_peminjaman', 
        'user_id', 
        'buku_id', 
        'loan_date', 
        'due_date', 
        'status'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}