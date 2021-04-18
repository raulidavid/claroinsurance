<?php

namespace Madsis\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Madsis\Core\Contracts\UbicacionGeografica as UbicacionGeograficaContract;

class UbicacionGeografica extends Model implements UbicacionGeograficaContract
{
    protected $table = 'ubicaciongeografica';

    protected $guarded = [
        'id',
        'codigo',
        'nombre',
        'idpadre',
        'parroquia',
    ];

    public $timestamps = false;


    public static function cantones($id)
    {
    	return Canton::where('idpadre',$id)->get();
    }
}
