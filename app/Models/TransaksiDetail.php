<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
            'uuid',
            'transaksi_id',
            'kode_tagihan',
            'nominal',
            'remark',
            'created_by',
            'updated_by',
    ];
}
