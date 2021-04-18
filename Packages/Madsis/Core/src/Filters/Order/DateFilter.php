<?php

namespace Madsis\Core\Filters\Order;

use Illuminate\Database\Eloquent\Builder;
use Madsis\Core\Filters\BaseFilter;

class DateFilter extends BaseFilter
{
    public function apply(Builder $builder,$data): Builder
    {
        return $builder->where([['ORDREGISTROFECHA1','>=',$data['ventasdesde']], ['ORDREGISTROFECHA1','<=',$data['ventashasta']]]);
    }
}
