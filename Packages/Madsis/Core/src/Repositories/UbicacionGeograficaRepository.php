<?php

namespace Madsis\Core\Repositories;

use Madsis\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

class UbicacionGeograficaRepository extends Repository
{
    use CacheableRepository;

    function model()
    {
        return 'Madsis\Core\Contracts\UbicacionGeografica';
    }
}