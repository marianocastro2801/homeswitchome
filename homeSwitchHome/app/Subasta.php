<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subasta extends Model
{
    protected $casts = [
    'fecha_inicio' => 'datetime:d-m-Y',
    'fecha_fin:d-m-Y'
	];
}
