<?php

namespace Madsis\User\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Madsis\Core\Eloquent\Repository;
use Madsis\User\Models\Team;
use Madsis\User\Models\User;
use stdClass;
use Auth;
use Prettus\Repository\Traits\CacheableRepository;

class TeamRepository extends Repository
{
    use CacheableRepository;

    function model()
    {
        return Team::class;
    }


    public function descendants($user){

        $team = Team::where('name',$user->id)->first();

        $descendants = Team::whereDescendantOrSelf($team)
            ->orderBy('name', 'asc')
            ->count();
        return $descendants;

    }
}