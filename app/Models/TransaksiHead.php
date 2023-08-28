<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiHead extends Model
{
    use HasFactory;

    protected $fillable = [
            'uuid',
            'kode_trans',
            'tanggal',
            'kode_akun',
            'siswa_id',
            'nama',
            'masuk',
            'keluar',
            'total_nominal',
            'remark',
            'created_by',
            'updated_by',
    ];
}
