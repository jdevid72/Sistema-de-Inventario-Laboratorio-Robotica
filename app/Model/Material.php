<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = false;
    protected $fillable = ['nombre','modelo','caracteristicas','cantidad_total','cantidad_prestamo','fecha','imagen','status'];
}
