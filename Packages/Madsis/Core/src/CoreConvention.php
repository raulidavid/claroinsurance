<?php

namespace Madsis\Core;

use Konekt\Concord\Conventions\ConcordDefault;

class CoreConvention extends ConcordDefault
{
    /**
     * @inheritDoc
     */
    public function migrationsFolder(): string
    {
        return 'Database/Migrations';
    }
}