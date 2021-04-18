<?php

namespace Madsis\Core\Filters\Payment;

use Illuminate\Database\Eloquent\Builder;
use Madsis\Core\Filters\BaseFilter;

class NumberFilter extends BaseFilter
{
    public function apply(Builder $builder,$request): Builder
    {
        return $builder->where('ORDNUMERO','LIKE',$request['Buscar']);
    }
}
