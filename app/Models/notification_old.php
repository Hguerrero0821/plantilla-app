<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification_old extends Model
{
    use HasFactory;

    public function usuarios() {
        return $this->hasOne(User::class,'id','user_id');
    }
}
