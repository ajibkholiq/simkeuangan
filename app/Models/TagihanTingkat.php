<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanTingkat extends Model
{
    use HasFactory;
    protected $fillable = [
            'uuid',
            'thn_ajaran_id',
            'tagihan_id',
            'tingkat_id',
            'nominal',
            'remark',
            'created_by',
            'updated_by',
    ];
}
