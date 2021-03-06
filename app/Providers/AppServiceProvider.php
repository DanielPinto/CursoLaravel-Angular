<?php

namespace codeproject\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use codeproject\Entities\ProjectTask;
use codeproject\Events\TaskWasIncluded;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ProjectTask::created( function($task){
          Event::fire(new TaskWasIncluded($task));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
