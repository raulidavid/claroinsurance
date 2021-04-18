<?php

namespace Madsis\Api\Http\Controllers;

class UbicacionController extends Controller
{
    protected $_config;

    public function __construct()
    {
        $this->_config = request('_config');
    }
    public function getAllProvincias()
    {
        return core()->getAllProvincias();
    }
    public function getCantones($id = null)
    {
        return core()->getCantones($id);
    }
    public function getParroquias($id=null)
    {
        return core()->getParroquias($id);
    }
}
