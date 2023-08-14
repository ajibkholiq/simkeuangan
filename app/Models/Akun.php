<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;
    protected $fillable = [
            'uuid',
            'kode',
            'sub2_akun_id',
            'Nama',
            'remark',
            'created_by',
            'updated_by',
    ];
}
