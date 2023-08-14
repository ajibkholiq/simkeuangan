<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunHead extends Model
{
    use HasFactory;

    protected $table = 'akun_head';

    protected $fillable =[
        'uuid',
        'akun_head',
        'urut',
        'remark',
        'created_by',
        'update_by'
    ];
}
