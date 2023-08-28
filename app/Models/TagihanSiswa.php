<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
            'uuid',
            'siswa_id',
            'tahun_ajaran',
            'kode_tagihan',
            'nominal',
            'kali',
            'diskon',
            'remark',
            'created_by',
            'updated_by',
    ];
}
