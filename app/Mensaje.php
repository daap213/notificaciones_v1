<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = [
        'id','tema', 'mensaje', 'receptor','user_id',
    ];
}
