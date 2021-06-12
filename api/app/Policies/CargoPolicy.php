<?php

namespace App\Policies;

use App\Cargo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CargoPolicy
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
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cargo  $cargo
     * @return mixed
     */
    public function view(User $user, Cargo $cargo)
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
        } /*if ($user->roles->contains('slug', 'finance-manager')) {
            return true;
        }*/
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cargo  $cargo
     * @return mixed
     */
    public function update(User $user, Cargo $cargo)
    {
        if($user->permissions->contains('slug', 'finance-edit')) {
            return true;
        } /*elseif ($user->roles->contains('slug', 'finance-manager')) {
            return true;
        }*/
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cargo  $cargo
     * @return mixed
     */
    public function delete(User $user, Cargo $cargo)
    { 

        if($user->permissions->contains('slug', 'finance-delete')) {
            return true;
        } 
        return false;
    
    }

}
