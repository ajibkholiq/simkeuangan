<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    protected $fillable = [
            'uuid',
            'thn_ajaran_id',
            'akun_id',
            'kode',
            'nama',
            'batas_bayar',
            'remark',
            'created_by',
            'updated_by',
    ];
}
