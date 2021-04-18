<?php

namespace Madsis\Core\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Madsis\Core\Models\CoreConfig::class,
        \Madsis\Core\Models\UbicacionGeografica::class,
        \Madsis\Core\Models\Catalog::class,
    ];
}