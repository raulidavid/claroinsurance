<?php

namespace Madsis\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Madsis\User\Models\User;

class Sesiones extends Model
{
    protected $table = 'sessions';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
