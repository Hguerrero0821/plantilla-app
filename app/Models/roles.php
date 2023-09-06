<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class roles extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillaeble = [
        'name',
        'description'
    ];

    public function rolesUsuarios() {

        return $this->hasMany(rolesUsuarios::class,'rol_id');
    }

    public function rolesSubmenus() {

        return $this->hasMany(rolesSubmenus::class,'rol_id');
    }

}
