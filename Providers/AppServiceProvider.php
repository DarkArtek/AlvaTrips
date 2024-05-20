<?php

namespace Modules\AlvaTrips\Providers;

use App\Contracts\Modules\ServiceProvider;

/**
 * @package $NAMESPACE$
 */
class AppServiceProvider extends ServiceProvider
{
    private $moduleSvc;
    protected $defer = false;

    /**
     * Boot app events.
     */
    public function boot(): void
    {
        $this->moduleSvc = app('App\Services\ModuleService');
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerLinks();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
    }

    /**
     * Register the service provider
     */
    public function register()
    {
        //
    }

    /**
     * Module links
     */
    public function registerLinks(): void
    {
        // Show this link if the user is logged in.
        $this->moduleSvc->addFrontendLink('Trips', '/trips', $logged_in = true);

        // Admin only links.
        $this->moduleSvc->addAdminLink('Trips', '/admin/trips');
        $this->moduleSvc->addAdminLink('Missions', '/admin/missions');
    }

    /**
     * Module config
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('alvatrips.php')
        ], 'alvatrips');

        $this->mergeConfigFrom(__DIR__ . '/../Config/config.php', 'alvatrips');
    }

    /**
     * Module views
     */
    public function registerViews()
    {
        $viewPath = resource_path('view/modules/alvatrips');
        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([$sourcePath => $viewPath], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . 'modules/alvatrips';
        }, \Config::get('view.paths')), [$sourcePath]), 'alvatrips');
    }

    /**
     * Module translations
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/alvatrips');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'alvatrips');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'alvatrips');
        }
    }
}
