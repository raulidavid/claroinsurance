<?php

namespace Madsis\Core\Filters;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseFilter extends Filter
{
    protected $start, $limit, $paginate;
    function __construct($start =1, $limit = 10, $paginate = true) {
        $this->start = $start;
        $this->limit = $limit;
        $this->paginate = $paginate;
    }
    public function apply(Builder $builder, $query): Builder
    {
        return $builder.$query
            ->offset($this->start)
            ->limit($this->limit)
            ->get();
    }
}
