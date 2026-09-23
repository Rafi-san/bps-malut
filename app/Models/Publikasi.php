<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'tanggal_rilis', 'frekuensi_terbit', 'ukuran_file', 'sampul', 'unduh'
    ];
}