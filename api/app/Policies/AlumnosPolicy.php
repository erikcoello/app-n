<?php

namespace App\Policies;

use App\Alumno;
use App\Inscripcionfinanza;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlumnosPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
    if ($user->isAdmin()) {
        return true;
    }
  }


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

  

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
         if($user->permissions->contains('slug', 'finance-create')) {
            return true;
        } 
                return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Alumno  $alumno
     * @return mixed
     */
    public function edit(User $user, $id_pago)
    {
         if($user->permissions->contains('slug', 'finance-edit')) {
            return true;
        } 
                return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Alumno  $alumno
     * @return mixed
     */
    public function delete(User $user, $id_pago)
    {
        if($user->permissions->contains('slug', 'finance-delete')) {
            return true;
        } 
                return false;
    }
}
