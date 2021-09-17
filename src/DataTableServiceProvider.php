<?php

namespace Yazan\DataTable;

use Illuminate\Support\ServiceProvider;
use Yazan\DataTable\Commands\DataTableCommand;

class DataTableServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        dd('hello');
        //
        if ($this->app->runningInConsole()) {
            $this->commands([
                DataTableCommand::class,

            ]);
        }
    }
}
