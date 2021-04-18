<?php

namespace Madsis\User\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Team extends Model
{
    use NodeTrait;
    protected $table = 'teams';
    protected $fillable = ['name','_lft','_rgt','parent_id'];

    public function Usuario(){
        return $this->belongsTo(User::class, 'name','id');
    }
}
