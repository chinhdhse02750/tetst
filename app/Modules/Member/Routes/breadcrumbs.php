<?php

use App\Helpers\Constants;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

App::bind('view.finder', function ($app) {
    $paths = [realpath(app_path('Modules/Member/Views'))];
    return new \Illuminate\View\FileViewFinder($app['files'], $paths);
});

Breadcrumbs::for('home', function ($trail) {
    $trail->push(trans('Trang chủ'), route('home'));
});

Breadcrumbs::for('shop.view', function ($trail) {
    $trail->parent('home');
    $trail->push('Tất cả sản phẩm', route('shop.view', 'tat-ca-san-pham'));
});
