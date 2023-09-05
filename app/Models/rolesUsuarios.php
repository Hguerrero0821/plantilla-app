<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class rolesUsuarios extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = [
        'rol_id',
        'user_id'
    ];

    public $incrementing = false;
    protected $primaryKey = ['user_id', 'rol_id'];

    public function roles() {
        return $this->belongsToOne(roles::class);
    }

    public function usuarios() {
        return $this->belongsToOne(User::class);
    }
}
