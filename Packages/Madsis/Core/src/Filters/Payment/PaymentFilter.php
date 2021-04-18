<?php

namespace Madsis\Core\Filters\Payment;

use Illuminate\Database\Eloquent\Builder;
use Madsis\Core\Filters\BaseFilter;

class PaymentFilter extends BaseFilter
{
    public function apply(Builder $builder,$data): Builder
    {
        return $builder
            ->where('PAYAMMOUNT',$data['Buscar']);
    }
}
