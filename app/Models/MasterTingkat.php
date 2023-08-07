<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTingkat extends Model
{
    use HasFactory;

    protected $table = 'master_tingkat';

    protected $fillable = [
        'uuid',
        'id_tingkat',
        'nama_tingkat',
        'remark',
        'created_by',
        'updated_by',
    ];
}
