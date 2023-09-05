<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class menu extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = "menus";

    protected $fillable = [
        'name',
        'descripcion'
    ];

    public function submenu() {
        return $this->hasMany('\App\Models\submenu');
    }
}
