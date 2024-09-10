<?php

namespace willvincent\Rateable;

use Illuminate\Support\ServiceProvider;
use willvincent\Rateable\Commands\RateableCommand;
use Illuminate\Support\Facades\Config;

class RateableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if(!defined('RATING_TABLE_NAME')){
            define('RATING_TABLE_NAME', Config::get('rateable.rating_table_name', 'ratings'));
        }

        if(!defined('RATING_DESCRIPTION_TABLE_NAME')){
            define('RATING_DESCRIPTION_TABLE_NAME', Config::get('rateable.rating_description_table_name', 'ratings'));
        }


        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateRatingsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_ratings_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_ratings_table.php'),
                ], 'migrations');
            }

            if (! class_exists('CreateRatingDescriptionsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_rating_descriptions_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_rating_descriptions_table.php'),
                ], 'migrations');
            }

             $this->publishes([
                 __DIR__.'/../config/rateable.php' => config_path('rateable.php'),
             ], 'config');

            // $this->commands([
            //     RateableCommand::class,
            // ]);
        }
    }

    // public function register()
    // {
    //     $this->mergeConfigFrom(__DIR__.'/../config/rateable.php', 'rateable');
    // }
}
