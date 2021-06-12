<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ControlEscolarPolicy
{
    use HandlesAuthorization;


     public function before($user, $ability)
{
    if ($user->isAdmin()) {
        return true;
    }
}

 public function index(User $user)
    {
         if($user->permissions->contains('slug', 'school-create')) {
            return true;
        } 
                return false;
    }


}
