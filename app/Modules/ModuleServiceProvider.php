<?php

namespace App\Modules;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class ModuleServiceProvider extends RouteServiceProvider
{

    protected $namespace = '';

    protected $mapWhat = '';

    public function register()
    {
        // To do
    }

    public function boot()
    {
        $this->setNamespace();

        parent::boot();
    }

    /**
     * Override the map() function of Illuminate\Foundation\Support\Providers\RouteServiceProvider
     * it will be call by loadRoutes() function
     *
     */
    public function map()
    {
        $modules = config('modules');

        switch ($this->mapWhat) {
            case $modules['admin']['folder']:
                $this->mapModules($modules['admin']);
                break;
            case $modules['member']['folder']:
                $this->mapModules($modules['member']);
                break;
            case $modules['api']['folder']:
                $this->mapModules($modules['api']);
                break;
            default:
        }
    }

    /**
     * Set the corresponding namspace based on the prefix url
     *
     */
    private function setNamespace()
    {
        $modules = config('modules');

        if (request()->is($modules['admin']['prefix_url'])
            || request()->is($modules['admin']['prefix_url'] . '/*')) {
            $this->namespace = join('\\', ['App', 'Modules', $modules['admin']['folder'], 'Controllers']);
            $this->mapWhat = $modules['admin']['folder'];
        } elseif (request()->is($modules['api']['prefix_url'])
            || request()->is($modules['api']['prefix_url'] . '/*')) {
            $this->namespace = join('\\', ['App', 'Modules', $modules['api']['folder'], 'Controllers']);
            $this->mapWhat = $modules['api']['folder'];
        } else {
            $this->namespace = join('\\', ['App', 'Modules', $modules['member']['folder'], 'Controllers']);
            $this->mapWhat = $modules['member']['folder'];
        }
    }

    /**
     * Mapping Admin routes and views
     *
     * @param array $mod
     * @return void
     */
    protected function mapModules(array $mod)
    {
        $view_dir = implode(DIRECTORY_SEPARATOR, [__DIR__, $mod['folder'], 'Views']);
        $route_file = implode(DIRECTORY_SEPARATOR, [__DIR__, $mod['folder'], 'Routes', $mod['router_file_name']]);

        $middleware = ['web'];
        if (is_array($mod['group_middleware']) && !empty($mod['group_middleware'])) {
            $middleware = array_merge($middleware, $mod['group_middleware']);
        }

        Route::middleware($middleware)
            ->prefix($mod['prefix_url'])
            ->namespace($this->namespace)
            ->group($route_file);

        if (is_dir($view_dir)) {
            $this->loadViewsFrom($view_dir, $mod['folder']);
        }
    }
}
