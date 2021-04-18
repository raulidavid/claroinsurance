<?php

namespace Madsis\Core\Repositories;

use Madsis\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

class LocaleRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Madsis\Core\Contracts\Locale';
    }
}