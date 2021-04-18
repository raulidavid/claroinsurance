<?php

namespace Madsis\Core\Filters\Payment;

use Illuminate\Database\Eloquent\Builder;
use Madsis\Core\Filters\BaseFilter;

class PaginateFilter extends BaseFilter
{
    public function apply(Builder $builder,$data): Builder
    {
        return $builder
            ->offset($data['start'])
            ->limit($data['length'])
            ->select('PAYORDEN')
            ->orderBy('PAYORDEN', 'ASC')
            ;
    }
}
