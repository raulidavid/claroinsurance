<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;
use Madsis\Postulant\Models\Postulant;

class PostulantApproved implements Rule
{
    public function passes($attribute, $value)
    {
        $postulant = Postulant::find($value);
        if ($postulant == null){
            return false;
        }
        return true;
    }

    public function message()
    {
        return 'Postulante ya se encuentra aprobado';
    }
}
