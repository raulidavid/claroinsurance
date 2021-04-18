<?php

namespace Madsis\Postulant\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Madsis\Postulant\Models\Postulant::class,
    ];
}