<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'News';

    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'gambar',
        'penulis',
        'jabatan_penulis',
        'isi_contenct',
    ];
}
