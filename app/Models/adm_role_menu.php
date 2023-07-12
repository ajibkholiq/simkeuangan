<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adm_role_menu extends Model
{
    use HasFactory;
    protected $table = "adm_role_menu";
    protected $fillabel = [
        "uuid",
        "role_id",
        "menu_id",
        "create_by",
        "update_by"
    ];
}
