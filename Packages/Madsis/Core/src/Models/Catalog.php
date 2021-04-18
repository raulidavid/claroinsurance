<?php

namespace Madsis\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Madsis\Core\Contracts\Catalog as CatalogContract;

class Catalog extends Model implements CatalogContract
{
    protected $table = 'catalogos';
    public $timestamps = false;
    protected $primaryKey = 'id';
}