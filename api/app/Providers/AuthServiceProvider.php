<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       // 'App\Inscripcionfinanza' => 'App\Policies\Inscripcionfinanza',
        Categories::class => CategoriesPolicy::class,
        'App\Cargo' => 'App\Policies\CargoPolicy',
        'App\Alumno' => 'App\Policies\AlumnosPolicy',
        'App\Inscripcionfinanza' => 'App\Policies\AlumnosPolicy',
        'App\CargoAlumno' => 'App\Policies\CargoAlumnoPolicy',
        'App\Official' => 'App\Policies\ControlEscolarPolicy',
        'App\Official' => 'App\Policies\OfficialPolicy',
        //'App\Alumno' => 'App\Policies\EstudiantePolicy',
       // 'App\Alumno' => 'App\Policies\InReinscripcionPolicy',
        'App\Credencial' => 'App\Policies\SubirCredencialPolicy',
     ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
        return $user->roles->first()->slug == 'admin';
    });

         Gate::define('isFinance', function ($user) {
        return $user->roles->first()->slug == 'finance-manager';
    });
         Gate::define('isSchool', function ($user) {
        return $user->roles->first()->slug == 'school-manager';
    });
          Gate::define('isGuest', function ($user) {
        return $user->roles->first()->slug == 'guest';
    });

        //
    }
}
