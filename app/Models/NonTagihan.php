<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonTagihan extends Model
{
    use HasFactory;

    protected $fillable = [
            'uuid',
            'akun_id',
            'kode',
            'nama',
            'remark',
            'created_by',
            'updated_by',
    ];
}
