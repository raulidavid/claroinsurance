<?php

namespace Madsis\Core\Repositories;

use Madsis\Core\Eloquent\Repository;
use Madsis\Core\Models\Contador;

class ContadorRepository extends Repository
{
    function model()
    {
        return 'Madsis\Core\Contracts\Contador';
    }

    public static function generate()
    {
        $lastOrder = Contador::query()->where('SLUG', 'ORDERSFCME')->first();
        $lastOrder->CUSTOMCOUNTER = $lastOrder->CUSTOMCOUNTER + 1;
        $lastOrder->save();
        return $lastOrder->CUSTOMCOUNTER;
    }
}