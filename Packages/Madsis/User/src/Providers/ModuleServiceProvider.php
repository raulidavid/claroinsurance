<?php

namespace Madsis\User\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Madsis\User\Models\Admin::class,
        \Madsis\User\Models\Role::class,
    ];
}