<?php

namespace Madsis\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Madsis\User\Services\RolesPermissionsService;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Madsis\User\Models\User;
use StdClass;

class SpatieController extends Controller
{
    public function getRoles(Request $request){
        $limit = $request->input('length');
        $start = $request->input('start');
        $Buscar = $request->input('Buscar');

        $MySales = Role::select('id')
            ->offset($start)
            ->limit($limit)
            ->orderBy('id','ASC')
            ->get();
        $totalData = Role::count();
        $totalFiltered = $totalData;

        if (!empty($Buscar)) {
            $MySales = Role::where('users.nombres', 'LIKE', "%".strtoupper($Buscar)."%")
                ->orwhere('users.apellidos', 'LIKE', "%".strtoupper($Buscar)."%")
                ->orwhere('users.username', 'LIKE', "%".strtolower($Buscar)."%")
                ->orwhere('users.email', 'LIKE', "%".strtolower($Buscar)."%")
                ->orwhere('identificaciones.IDTNDOCUMENTO', 'LIKE', "%".($Buscar)."%")
                ->select('id')
                ->offset($start)
                ->limit($limit)
                ->orderBy('id','ASC')
                ->get();
            $totalFiltered = $MySales->count();
        }
        if(!$MySales->isEmpty()){
            foreach ($MySales as $MySale){
                $data = new RolesPermissionsService();
                $data = $data->RolInfo($MySale->id);
                $usuarios[] = $data;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $usuarios
        );
        return $json_data;
    }

    public function getPermissions(){
        return Permission::all();
    }

    public function getRoleInfoById($id){
        $role = Role::find($id);
        return response()->json($role,200);
    }

    public function unassignPermission(Request $request){
        DB::beginTransaction();
        try {
            $role = Role::find($request->Rol);
            $role = $role->revokePermissionTo($request->Permission);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return response([$role,$request->Permission], '200');
    }

    public function UnassignPermissionUser(Request $request){
        DB::beginTransaction();
        try {
            $user = User::find($request->User);
            $user->revokePermissionTo($request->Permission);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return response([$user,$request->Permission ." desasignado Correctamente"], '200');
    }

    public function AssignPermissionUser(Request $request){
        DB::beginTransaction();
        try {
            $user = User::find($request->User);
            $user->givePermissionTo($request->Permission);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return response([$user,$request->Permission ." asignado Correctamente"], '200');
    }

    public function AssignPermission(Request $request){
        $request->validate([
            'Rol' => ['required','numeric'],
            'Permission' => ['required','numeric'],
        ],$messages = [
            'Rol.required' => 'El rol es requerido',
            'Rol.numeric' => 'El rol debe ser numérico',
            'Permission.required' => 'El permiso es requerido',
            'Permission.numeric' => 'El permiso debe ser numérico',
        ]);
        $permission = Permission::find($request->Permission);
        $role = Role::find($request->Rol);
        DB::beginTransaction();
        try {
            $role = $role->givePermissionTo($permission);
            DB::commit();
            return response()->json('El '.$permission->name .' se asigno correctamente a ROL '.$role->name,200);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function AssignRoleRouteAngular(Request $request){
        $routes = json_decode(Role::find($request->Rol)->routes);
        if($routes == null) {
            $routes = new StdClass();
        }else{
            foreach ($routes as $key => $value) {
                if ($key == $request->Route) {
                    return response()->json('Ruta '.$key.' ya existe', 200);
                }
            }
        }

        $routename = $request->Route;
        $routes->$routename = "";

        DB::beginTransaction();
        try {
            $role = Role::find($request->Rol);
            $role->routes = json_encode($routes);
            $role->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return response()->json('Ruta '.$key.' asignada a '.$role->name, 200);
    }

    public function UnassignRoleRouteAngular(Request $request){
        $routes = json_decode(Role::find($request->Rol)->routes);
        foreach ($routes as $key => $value) {
            if ($key == $request->Route) {
                unset ($routes->$key);
            }
        }

        DB::beginTransaction();
        try {
            $role = Role::find($request->Rol);
            $role->routes = json_encode($routes);
            $role->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return response()->json('Ruta '.$key.' desasignada', 200);
    }

    public function UserRolePermissions(){
        $roles = auth('api')->user()->getPermissionsViaRoles();
        $users = auth('api')->user()->getDirectPermissions();
        $data = $roles->concat($users)->unique('id');
        return response()->json($data, 200);
    }

    public function UserPermissions(){
        $data = auth('api')->user()->getDirectPermissions()->toArray();
        return response()->json($data, 200);
    }

    public function RolPermissions(){
        $data = new RolesPermissionsService();
        $data = $data->RolInfo(auth('api')->user()->roles->pluck('id')->first())->ROLPERMISSIONS;
        return response()->json($data, 200);
    }


    public function Prueba(){
        $rows = array(
            array(
                'id' => 142,
                'name' => "Cate 1",
                'slug' => "Cate 1",
                'childs' => array(
                    'id' => 143,
                    'name' => "Cate1 nivel 2",
                    'slug' => "Cate1 nivel 2",
                    'childs' => array(
                        'id' => 144,
                        'name' => "Cate1 nivel 3",
                        'slug' => "Cate1 nivel 3",
                        'childs' => array()
                    )
                )),
            array(
                'id' => 145,
                'name' => "Cate 2",
                'slug' => "Cate 2",
                'childs' => array(
                    'id' => 146,
                    'name' => "Cate2 nivel 2",
                    'slug' => "Cate2 nivel 2",
                    'childs' => array()
                ))
        );

        $ant="";

        foreach($rows as $row){
            array_walk_recursive($row, 'test_print', ["cadena"=>&$ant]);
            echo "\n";
            $ant="";
        }

    }

    function test_print($item, $key, $ant){
        if($key == "name"){
            if(empty($ant["cadena"]))
                $ant["cadena"] .= $item;
            else
                $ant["cadena"] .= "|".$item;
            echo  $ant["cadena"]."\n";
        }
    }
}
