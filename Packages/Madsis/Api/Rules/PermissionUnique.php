<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;

class PermissionUnique implements Rule
{
    private $permission,$rol;

    public function __construct($permission,$rol)
    {
        $this->permission = $permission;
        $this->rol = $rol;
    }

    public function passes($attribute, $value)
    {
        $consulta = Permission_Role::where([
            ['permission_id', $this->permission],
            ['role_id', $this->rol],
        ])->get();
        if ($consulta->isEmpty()) {
            return true;
        }else{
            return false;
        }
    }

    public function message()
    {
        return 'Permiso ya esta asignado.';
    }
}
