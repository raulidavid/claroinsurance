<?php

namespace Madsis\Core\Models;

use Madsis\Core\Eloquent\TranslatableModel;
use Madsis\Core\Contracts\Country as CountryContract;

class Country extends TranslatableModel implements CountryContract
{
    public $timestamps = false;

    public $translatedAttributes = ['name'];

    protected $with = ['translations'];
}