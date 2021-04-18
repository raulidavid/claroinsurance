<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;
use Madsis\User\Models\Team;
use Auth;

class AssignDescendant implements Rule
{
    public function passes($attribute, $value)
    {
        if (Auth::user()->can('option-assignsale')){
            return true;
        }
        $parent = Team::where('name',Auth::id())->first();
        $children = Team::where('name',$value)->first();
        $count = $children->descendantsAndSelf($parent)->count();
        if($count){
            return true;
        }
        return false;
    }

    public function message(){
        return 'No tienes permisos para realizar esta asignación';
    }
}
