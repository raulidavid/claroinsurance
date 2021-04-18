<?php

namespace Madsis\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Madsis\Core\Contracts\Contador as ContadorContract;

class Contador extends Model implements ContadorContract
{
    protected $table = 'contadores';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $guarded = ['ID'];

    public static function generate()
    {
        $lastOrder = Contador::query()->where('SLUG', 'ORDERSFCME')->first();
        return $lastOrder + 1;
    }
}