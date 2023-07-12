<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adm_menu extends Model
{
    use HasFactory;

    protected $table = "adm_menu";
    protected $filelable =[
        "uuid",
        "induk",
        "kode_menu",
        "nama_menu",
        "icon",
        "urut",
        "remark",
        "create_by",
        "update_by"
    ];
    
}
