<?php

namespace Madsis\Core\Filters\Order;

use Illuminate\Database\Eloquent\Builder;
use Madsis\Core\Filters\BaseFilter;

class PaginateFilter extends BaseFilter
{
    public function apply(Builder $builder,$data): Builder
    {
        return $builder
            ->offset($data['start'])
            ->limit($data['length'])
            ->select('ORDID')
            ->orderBy('ORDID', 'ASC')
            ;
    }
}
