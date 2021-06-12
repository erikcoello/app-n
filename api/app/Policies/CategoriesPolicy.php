<?php

namespace App\Policies;

use App\Categories;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriesPolicy
{
    use HandlesAuthorization;


/// esto se usa para validar como admin y evitar pasar por las comprobaciones de cada metodo. esto se define en traits
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
     * @param  \App\Categories  $categories
     * @return mixed
     */
    public function view(User $user, Categories $categories)
    {
          
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
        } /*elseif ($user->roles->contains('slug', 'finance-manager')) {
            return true;
        }*/
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Categories  $categories
     * @return mixed
     */

    public function edit(User $user, Categories $categoria)
    {
         if($user->permissions->contains('slug', 'finance-edit')) {
            return true;
        } 
        return false;
    }


    public function update(User $user, Categories $categoria)
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
     * @param  \App\Categories  $categories
     * @return mixed
     */
    public function delete(User $user, Categories $categoria)
    {
         if($user->permissions->contains('slug', 'finance-delete')) {
            return true;
        } 
        return false;
    }

}
