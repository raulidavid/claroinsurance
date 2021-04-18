<?php

namespace Madsis\Postulant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Madsis\Core\Models\Catalog;
use Madsis\Postulant\Contracts\Postulant as PostulantContract;
use Madsis\Core\Models\UbicacionGeografica;

class Postulant extends Model implements PostulantContract
{
    use SoftDeletes;
    protected $table = 'postulants';
    protected $primaryKey = 'PTLID';

    public function nacionalidad(){
        return $this->belongsTo(Catalog::class, 'PTLNACIONALIDAD','id');
    }
    public function tipodocumento(){
        return $this->belongsTo(Catalog::class, 'PTLTIPODOCUMENTO','id');
    }

    public function genero(){
        return $this->belongsTo(Catalog::class, 'PTLGENERO','id');
    }

    public function estadocivil(){
        return $this->belongsTo(Catalog::class, 'PTLESTADOCIVIL','id');
    }

    public function estadopostulante(){
        return $this->belongsTo(Catalog::class, 'PTLESTADO','id');
    }

    public function provincia(){
        return $this->belongsTo(UbicacionGeografica::class, 'PTLPROVINCIA','id');
    }

    public function canton(){
        return $this->belongsTo(UbicacionGeografica::class, 'PTLCANTON','id');
    }

    public function parroquia(){
        return $this->belongsTo(UbicacionGeografica::class, 'PTLPARROQUIA','id');
    }

}

