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

Breadcrumbs::for('search', function ($trail) {
    $trail->push(trans('Trang chủ'), route('home'));
});



Breadcrumbs::for('cate.view', function ($trail, $category) {
    $trail->parent('home');
    $trail->push($category->name, route('cate.view', $category->alias));
});

Breadcrumbs::for('shop.detail', function ($trail, $category, $sub_category) {
    $trail->parent(('shop.view'), $category);
    $trail->push(
        $sub_category->name,
        route('shop.detail', ['alias' => $category->alias, 'sub_alias' => $sub_category->alias])
    );
});
