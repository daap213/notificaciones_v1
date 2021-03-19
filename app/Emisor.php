<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emisor extends Model
{
    	protected $fillable = [
        'id', 'mensaje_id', 'emisor',
    ];
}
