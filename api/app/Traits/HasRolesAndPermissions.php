<?php
namespace App\Traits;

use App\Role;
use App\Permission;
trait HasRolesAndPermissions
{

    public function isAdmin()
    {
        if($this->roles->contains('slug', 'admin'))
        {
            return true;
        }
    }

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }


    public function hasRole($role)
    {        
       if($this->roles->contains('slug',$role)){
        return true;
       }
       return false;
}


} // cierre traits