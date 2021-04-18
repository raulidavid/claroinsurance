<?php

return [

    'convention' => Madsis\Core\CoreConvention::class,

    'modules' => [
        /**
         * Example:
         * VendorA\ModuleX\Providers\ModuleServiceProvider::class,
         * VendorB\ModuleY\Providers\ModuleServiceProvider::class
         *
         */
        \Madsis\Core\Providers\ModuleServiceProvider::class,
        /*
        \Madsis\Attribute\Providers\ModuleServiceProvider::class,
        \Madsis\BookingProduct\Providers\ModuleServiceProvider::class,
        \Madsis\Category\Providers\ModuleServiceProvider::class,
        \Madsis\Checkout\Providers\ModuleServiceProvider::class,

        \Madsis\Customer\Providers\ModuleServiceProvider::class,
        \Madsis\Inventory\Providers\ModuleServiceProvider::class,
        \Madsis\Product\Providers\ModuleServiceProvider::class,
        \Madsis\Sales\Providers\ModuleServiceProvider::class,
        \Madsis\Tax\Providers\ModuleServiceProvider::class,
        \Madsis\User\Providers\ModuleServiceProvider::class,
        \Madsis\CatalogRule\Providers\ModuleServiceProvider::class,
        \Madsis\CartRule\Providers\ModuleServiceProvider::class,
        \Madsis\CMS\Providers\ModuleServiceProvider::class,
        \Madsis\Velocity\Providers\ModuleServiceProvider::class,
        \Madsis\SocialLogin\Providers\ModuleServiceProvider::class,*/
    ]
];