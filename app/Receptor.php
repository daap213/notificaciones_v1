<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receptor extends Model
{
	protected $fillable = [
        'id', 'mensaje_id', 'receptor',
    ];
		
}
