<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class rolesSubmenus extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = [
        'rol_id',
        'submenu_id'
    ];

    public $incrementing = false;
    protected $primaryKey = ['submenu_id', 'rol_id'];

    public function roles() {

        return $this->belongsToOne(roles::class);
    }


    public function submenus() {
        return $this->hasOne(submenu::class, 'id','submenu_id');
    }

}
