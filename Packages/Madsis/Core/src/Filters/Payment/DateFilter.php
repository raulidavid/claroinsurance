<?php

namespace Madsis\Core\Filters\Payment;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Madsis\Core\Filters\BaseFilter;

class DateFilter extends BaseFilter
{
    public function apply(Builder $builder,$data): Builder
    {
        return $builder->where([
            ['PAYDATE','>=',Carbon::createFromFormat('Y-m-d H:i:s', $data['ventasdesde'].'00:00:00' )],
            ['PAYDATE','<=',Carbon::createFromFormat('Y-m-d H:i:s', $data['ventashasta'].'23:59:59' )],
        ]);
    }
}
