<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub2Akun extends Model
{
    use HasFactory;

    protected $fillable = [
            'uuid',
            'sub_akun_id',
            'Nama',
            'urut',
            'remark',
            'created_by',
            'updated_by',
    ];
}
