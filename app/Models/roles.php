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

    public function rolesPermision() {

        return $this->hasMany('\App\Models\rol_permison');

    }

}
