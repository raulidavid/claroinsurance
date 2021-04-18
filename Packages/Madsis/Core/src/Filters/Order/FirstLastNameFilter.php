<?php

namespace Madsis\Core\Filters\Order;

use Illuminate\Database\Eloquent\Builder;
use Madsis\Core\Filters\BaseFilter;

class FirstLastNameFilter extends BaseFilter
{
    public function apply(Builder $builder,$request): Builder
    {
        return $builder->join('contacts', 'contacts.CTOID', '=', 'orders.CTOID')
               ->where('contacts.CTONOMBRES','LIKE',"%".strtoupper($request['Buscar']."%"))
               ->orWhere('CTOAPELLIDOS','LIKE',"%".strtoupper($request['Buscar']."%"));
    }
}
