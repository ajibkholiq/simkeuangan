<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUnit extends Model
{
    use HasFactory;
    protected $table = 'master_unit';
    protected $fillable = [
            'uuid',
            'unit',
            'nama_unit',
            'alamat_unit',
            'no_tlp',
            'logo',
            'remark',
            'created_by',
            'updated_by',
    ];
}
