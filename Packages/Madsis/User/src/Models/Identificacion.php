<?php

namespace Madsis\User\Models;

use Illuminate\Database\Eloquent\Model;
use Madsis\Core\Models\Catalog;
use Madsis\Core\Models\UbicacionGeografica;

class Identificacion extends Model
{
    public $timestamps = false;
    protected $table = 'identificaciones';
    protected $primaryKey = 'IDTID';

    public function tipo_identificacion()
    {
        return $this->belongsTo(Catalog::class,'CATTIPODOCUMENTO','id');
    }

    public function nacionalidad()
    {
        return $this->belongsTo(Catalog::class,'CATNACIONALIDAD','id');
    }

    public function tipo_genero()
    {
        return $this->belongsTo(Catalog::class,'CATGENERO','id');
    }

    public function est_civil()
    {
        return $this->belongsTo(Catalog::class,'CATESTADOCIVIL','id');
    }

    public function fec_nacimimiento()
    {
        return $this->belongsTo(Catalog::class,'IDTFECNACIMIENTO','id');
    }

    public function provincia(){
        return $this->belongsTo(UbicacionGeografica::class, 'UBCPROVINCIA','id');
    }

    public function canton(){
        return $this->belongsTo(UbicacionGeografica::class, 'UBCCANTON','id');
    }

    public function parroquia(){
        return $this->belongsTo(UbicacionGeografica::class, 'UBCPARROQUIA','id');
    }

    public function user()
    {
        return $this->belongsTo(\Madsis\User\Models\User::class, 'USUID','id');
    }
}
