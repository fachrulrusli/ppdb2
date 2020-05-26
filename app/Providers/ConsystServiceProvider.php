<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
/**
 * class ConsystServiceProvider extends ServiceProvider
 *
 *
 * @version 1.0
 * @author Hardiyansyah
 * @package Consyst\Auth
 */
class ConsystServiceProvider extends ServiceProvider {
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     *
     * @return void
     */
    public function boot() {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {


        $services = [
            'App\Consyst\RepositoryInterface' => 'App\Consyst\EloquentRepository',
            'App\Consyst\Auth\Contracts\IUserRepository' => 'App\Consyst\Auth\UserRepository',
            'App\Consyst\Auth\Contracts\IMenuRepository' => 'App\Consyst\Auth\MenuRepository',
            'App\Consyst\Auth\Contracts\IGrupRepository' => 'App\Consyst\Auth\GrupRepository',
            'App\Consyst\Auth\Contracts\IAksesRepository' => 'App\Consyst\Auth\AksesRepository',
            'App\Consyst\Contracts\IReferenceRepository' => 'App\Consyst\Repository\ReferenceRepository',
            'App\Consyst\Contracts\IBeritaRepository' => 'App\Consyst\Repository\Master\BeritaRepository',



        ];

        foreach ($services as $contract => $service) {
            $this->app->bind($contract, $service);
        }
        $this->makeUrlHelperForConfigs();
        \View::share('app_name',config('consyst.app_name'));
        \View::share('frameworks_path',config('consyst.frame3works_path'));
        \View::share('plugins_path',config('consyst.plugins_path'));
        \View::share('theme_path',config('consyst.theme_path'));
        \View::share('page_record',config('consyst.record_per_page'));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }
    public function makeUrlHelperForConfigs()
    {

        Config::set("consyst.frameworks_path", asset('/assets/frameworks'));
        Config::set("consyst.plugins_path", asset('/assets/plugins'));
        $currentTheme = Config::get('consyst.theme');
        $viewbase = 'template.' . $currentTheme . '.';
        $buftheme = $currentTheme;

        Config::set("consyst.view_base", $viewbase);
        Config::set("consyst.theme_path", asset('/assets/frameworks/'.$currentTheme));
        Config::set("consyst.view_includes", Config::get("consyst.view_base")."includes.");
        Config::set("consyst.view_moduls",Config::get("consyst.view_includes")."modul.");
        Config::set("consyst.view_parials", Config::get("consyst.view_includes")."partials.");
        Config::set("breadcrumbs.view", "template/".$buftheme."/includes/partials/breadcrumbs");
    }
}
