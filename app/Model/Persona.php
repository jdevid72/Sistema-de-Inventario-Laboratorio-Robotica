<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps = false;
    protected $fillable = ['nombre','apellido','ci','cu','tipo_id','direccion','telefono','fecha_nacimiento','perfil','nombre_respaldo','telefono_respaldo'];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class,'id');
    }
}
