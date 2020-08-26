<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Model\Material;
use App\Model\Persona;

class Prestamo extends Model
{


    public $timestamps = false;

    protected $fillable = ['persona_id','material_id','user_id','cantidad_prestamo','persona_idev','fecha_prestamo','fecha_devolucion'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function persona(){
        return $this->belongsTo(Persona::class);
    }
}
