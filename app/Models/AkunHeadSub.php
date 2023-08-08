<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunHeadSub extends Model
{
    use HasFactory;

    protected $table = 'master_akun_head_sub';

    protected $fillable =[

        'uuid',
        'akun_head_sub',
        'akun_head_id',
        'urut',
        'remark',
        'created_by',
        'updated_by'

    ];
}
