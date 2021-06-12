<?php

namespace App\Policies;
use App\User;
use App\Credencial;
//use App\Alumno;
use App\Fecha;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubirCredencialPolicy
{
    use HandlesAuthorization;



     public function before($user, $ability)
{
    if ($user->isAdmin()) {
        return true;
    }
}
public function create(User $user)
    {
         if($user->permissions->contains('slug', 'school-create')) {
            return true;
        } 
                return false;
    }

    public function edit(User $user)
    {
         if($user->permissions->contains('slug', 'school-edit')) {
            return true;
        } 
                return false;
    }
public function destroy(User $user)
    {
         if($user->permissions->contains('slug', 'school-delete')) {
            return true;
        } 
                return false;
    }



}
