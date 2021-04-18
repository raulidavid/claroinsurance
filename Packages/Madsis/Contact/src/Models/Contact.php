<?php

namespace Madsis\Contact\Models;

use Illuminate\Database\Eloquent\Model;
use Madsis\Core\Models\Catalog;
use Madsis\Core\Models\UbicacionGeografica;


class Contact extends Model
{
    protected $table = 'contacts';
    protected $primaryKey = 'CTOID';
    public $timestamps = false;

    public function Nacionalidad(){
        return $this->belongsTo(Catalog::class,'CTOTIPONACIONALIDAD','id');
    }
    public function Identificacion(){
        return $this->belongsTo(Catalog::class,'CTOTIPODOCUMENTO','id');
    }
    public function Provincia(){
        return $this->belongsTo(UbicacionGeografica::class, 'CTOPROVINCIA','id');
    }
    public function Canton(){
        return $this->belongsTo(UbicacionGeografica::class, 'CTOCANTON','id');
    }
    public function Parroquia(){
        return $this->belongsTo(UbicacionGeografica::class, 'CTOPARROQUIA','id');
    }

}


