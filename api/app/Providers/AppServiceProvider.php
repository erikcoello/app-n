<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
   
     
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
   
  $this->app->bind('path.public',function(){
  return'/home/ensfep5/public_html/finanzas';
  });
}

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       /* \Blade::setEchoFormat('e(utf8_encode(%s))');
       Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar'
        ]);*/
    }
}
