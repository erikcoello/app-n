<?php

namespace App\Policies;

use App\Inscripcionfinanza;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InscripcionfinanzaPolicy
{
    use HandlesAuthorization;

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
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Inscripcionfinanza  $inscripcionfinanza
     * @return mixed
     */
    public function view(User $user, Inscripcionfinanza $inscripcionfinanza)
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Inscripcionfinanza  $inscripcionfinanza
     * @return mixed
     */
    public function update(User $user, Inscripcionfinanza $id)
    {
        
        if($user->permissions->contains('slug', 'edit')) {
            return true;
        } elseif ($user->roles->contains('slug', 'finance-manager')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Inscripcionfinanza  $inscripcionfinanza
     * @return mixed
     */
    public function delete(User $user, Inscripcionfinanza $inscripcionfinanza)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Inscripcionfinanza  $inscripcionfinanza
     * @return mixed
     */
    public function restore(User $user, Inscripcionfinanza $inscripcionfinanza)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Inscripcionfinanza  $inscripcionfinanza
     * @return mixed
     */
    public function forceDelete(User $user, Inscripcionfinanza $inscripcionfinanza)
    {
        //
    }
}
