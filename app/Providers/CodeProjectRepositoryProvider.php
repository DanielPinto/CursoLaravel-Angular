<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 22/02/2016
 * Time: 01:27
 */

namespace codeproject\Providers;


use Illuminate\Support\ServiceProvider;

class CodeProjectRepositoryProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(

            \codeproject\Repositories\ClientRepository::class,
            \codeproject\Repositories\ClientRepositoryEloquent::class
        );

        $this->app->bind(

            \codeproject\Repositories\ProjectRepository::class,
            \codeproject\Repositories\ProjectRepositoryEloquent::class
        );


        $this->app->bind(

            \codeproject\Repositories\ProjectNoteRepository::class,
            \codeproject\Repositories\ProjectNoteRepositoryEloquent::class
        );

        $this->app->bind(

            \codeproject\Repositories\UserRepository::class,
            \codeproject\Repositories\UserRepositoryEloquent::class
        );


        $this->app->bind(

            \codeproject\Repositories\ProjectFileRepository::class,
            \codeproject\Repositories\ProjectFileRepositoryEloquent::class
        );

        $this->app->bind(

            \codeproject\Repositories\ProjectMemberRepository::class,
            \codeproject\Repositories\ProjectMemberRepositoryEloquent::class
        );



    }
}