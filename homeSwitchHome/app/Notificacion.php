<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $fillable = ['id_subasta', 'id_usuario', 'mensaje', 'created_at']; 
}
