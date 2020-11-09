<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\UserRepository::class);
        $this->app->bind(\App\Repositories\AdminRepository::class);
        $this->app->bind(\App\Repositories\UserProfileRepository::class);
        $this->app->bind(\App\Repositories\CategoryRepository::class);
        $this->app->bind(\App\Repositories\PrefectureRepository::class);
        $this->app->bind(\App\Repositories\AreaRepository::class);
        $this->app->bind(\App\Repositories\MediaRepository::class);
        $this->app->bind(\App\Repositories\BannerRepository::class);
        $this->app->bind(\App\Repositories\UserMediaRepository::class);
        $this->app->bind(\App\Repositories\VideoRepository::class);
        $this->app->bind(\App\Repositories\UserVideoRepository::class);
        $this->app->bind(\App\Repositories\AdjustmentRepository::class);
        $this->app->bind(\App\Repositories\BalanceRepository::class);
        $this->app->bind(\App\Repositories\ContactRepository::class);
        $this->app->bind(\App\Repositories\OfferRepository::class);
        $this->app->bind(\App\Repositories\UserOfferRepository::class);
        $this->app->bind(\App\Repositories\PaymentsRepository::class);
        //:end-bindings:
    }
}
