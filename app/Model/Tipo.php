<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{

    public $timestamps = false;
    protected $fillable = ['descripcion'];
    
    public function persona()
    {
        return $this->hasMany(Persona::class);
    }
    
}
