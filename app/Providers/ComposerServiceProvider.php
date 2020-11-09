<?php

namespace App\Providers;

use App\Modules\Member\Composers\MemberComposer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ComposerServiceProvider.
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot()
    {
        // Frontend
        View::composer(
            ['includes.header', 'layouts.member', 'includes.footer', 'includes.search_bar', 'includes.left_sidebar'],
            MemberComposer::class
        );
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }
}
