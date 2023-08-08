<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable =[
            'uuid',
            'kelas',
            'kode_kelas',
            'tingkat_id', 
            'unit_id', 
            'user_id', 
            'remark',
            'created_by',
            'updated_by'
    ];
}
