<?php

namespace Madsis\Core\Filters\Order;

use Illuminate\Database\Eloquent\Builder;
use Madsis\Core\Filters\BaseFilter;

class AmountFilter extends BaseFilter
{
    public function apply(Builder $builder,$data): Builder
    {
        return $builder->where('ORDTOTAL','=',$data['Buscar']);
    }
}
