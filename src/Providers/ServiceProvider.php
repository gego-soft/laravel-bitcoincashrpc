<?php

namespace Gegosoft\Bitcoincash\Providers;

use Gegosoft\Bitcoincash\Client as BitcoincashClient;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $path = realpath(__DIR__.'/../../config/config.php');

        $this->publishes([$path => config_path('bitcoincashd.php')], 'config');
        $this->mergeConfigFrom($path, 'bitcoincashd');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAliases();

        $this->registerClient();
    }

    /**
     * Register aliases.
     *
     * @return void
     */
    protected function registerAliases()
    {
        $aliases = [
            'bitcoincashd' => 'Gegosoft\Bitcoincash\Client',
        ];

        foreach ($aliases as $key => $aliases) {
            foreach ((array) $aliases as $alias) {
                $this->app->alias($key, $alias);
            }
        }
    }

    /**
     * Register client.
     *
     * @return void
     */
    protected function registerClient()
    {
        $this->app->singleton('bitcoincashd', function ($app) {
            return new BitcoincashClient([
                'scheme' => $app['config']->get('bitcoincashd.scheme', 'http'),
                'host'   => $app['config']->get('bitcoincashd.host', 'localhost'),
                'port'   => $app['config']->get('bitcoincashd.port', 8332),
                'user'   => $app['config']->get('bitcoincashd.user'),
                'pass'   => $app['config']->get('bitcoincashd.password'),
                'ca'     => $app['config']->get('bitcoincashd.ca'),
            ]);
        });
    }
}
