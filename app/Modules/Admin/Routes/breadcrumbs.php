<?php

use App\Helpers\Constants;

App::bind('view.finder', function ($app) {
    $paths = [realpath(app_path('Modules/Admin/Views'))];
    return new \Illuminate\View\FileViewFinder($app['files'], $paths);
});

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(trans('labels.menu.dashboard'), route('admin.dashboard'));
});
Breadcrumbs::for('categories.index', function ($trail) {
    $trail->push(trans('labels.menu.category'), route('categories.index'));
});
Breadcrumbs::for('categories.create', function ($trail) {
    $trail->parent('categories.index');
    $trail->push(trans('categories.label.category_register'), route('categories.create'));
});
Breadcrumbs::for('categories.show', function ($trail, $id) {
    $trail->parent('categories.index');
    $trail->push(trans('categories.label.detail'), route('categories.show', $id));
});
Breadcrumbs::for('categories.edit', function ($trail, $id) {
    $trail->parent('categories.index');
    $trail->push(trans('categories.label.edit'), route('categories.edit', $id));
});
Breadcrumbs::for('prefectures.index', function ($trail) {
    $trail->push(trans('labels.menu.prefecture'), route('prefectures.index'));
});
Breadcrumbs::for('prefectures.create', function ($trail) {
    $trail->parent('prefectures.index');
    $trail->push(trans('prefectures.label.prefecture_register'), route('prefectures.create'));
});
Breadcrumbs::for('prefectures.show', function ($trail, $id) {
    $trail->parent('prefectures.index');
    $trail->push(trans('prefectures.label.detail'), route('prefectures.show', $id));
});
Breadcrumbs::for('prefectures.edit', function ($trail, $id) {
    $trail->parent('prefectures.index');
    $trail->push(trans('prefectures.label.edit'), route('prefectures.edit', $id));
});

Breadcrumbs::for('member.index', function ($trail, $type) {
    $trail->push(trans('labels.menu.user_management'), route('member.index', $type));
});

Breadcrumbs::for('member.show', function ($trail, $type, $id) {
    $trail->push(trans('user_profile.label.user_info'), route('member.show', ['id' => $id, 'type_user' => $type]));
});

Breadcrumbs::for('member.create', function ($trail, $type) {
    $trail->parent(('member.index'), $type);
    if ($type === Constants::TYPE_MALE) {
        $trail->push(trans('users.label.male_registration'), route('member.create', $type));
    } else {
        $trail->push(trans('users.label.female_registration'), route('member.create', $type));
    }
});

Breadcrumbs::for('member.edit', function ($trail, $type, $id) {
    $trail->parent(('member.index'), $type);
    if ($type === Constants::TYPE_MALE) {
        $trail->push(
            trans('users.label.male_member_edit'),
            route('member.edit', ['id' => $id, 'type_user' => $type])
        );
    } else {
        $trail->push(
            trans('users.label.female_registration'),
            route('member.edit', ['id' => $id, 'type_user' => $type])
        );
    }
});

Breadcrumbs::for('member.point-send', function ($trail, $type, $id) {
    $trail->parent(('member.index'), $type);
    $trail->push(
        trans('users.label.point_award'),
        route('member.point-send', ['id' => $id, 'type_user' => $type])
    );
});

Breadcrumbs::for('banners.index', function ($trail) {
    $trail->push(trans('labels.menu.banner'), route('banners.index'));
});
Breadcrumbs::for('banners.create', function ($trail) {
    $trail->parent('banners.index');
    $trail->push(trans('banners.label.banner_register'), route('banners.create'));
});
Breadcrumbs::for('banners.edit', function ($trail, $id) {
    $trail->parent('banners.index');
    $trail->push(trans('banners.label.edit'), route('banners.edit', $id));
});

Breadcrumbs::for('news.index', function ($trail) {
    $trail->push(trans('labels.menu.notification_list'), route('news.index'));
});
Breadcrumbs::for('news.create', function ($trail) {
    $trail->parent('news.index');
    $trail->push(trans('news.label.news_register'), route('news.create'));
});
Breadcrumbs::for('news.edit', function ($trail, $id) {
    $trail->parent('news.index');
    $trail->push(trans('news.label.edit'), route('news.edit', $id));
});

Breadcrumbs::for('member.balances', function ($trail) {
    $trail->push(trans('point.label.point_history'), route('member.balances'));
});

Breadcrumbs::for('contact.index', function ($trail) {
    $trail->push(trans('contacts.label.contact_list'), route('contact.index'));
});

Breadcrumbs::for('contact.edit', function ($trail, $id) {
    $trail->parent('contact.index');
    $trail->push(trans('contacts.label.contact_edit'), route('contact.edit', $id));
});

Breadcrumbs::for('offers.index', function ($trail) {
    $trail->push(trans('offers.label.list'), route('offers.index'));
});

Breadcrumbs::for('offers.show', function ($trail, $id) {
    $trail->parent('offers.index');
    $trail->push(trans('offers.label.detail'), route('offers.show', $id));
});

Breadcrumbs::for('offers.edit', function ($trail, $id) {
    $trail->parent('offers.index');
    $trail->push(trans('offers.label.edit'), route('offers.edit', $id));
});

Breadcrumbs::for('ranks.index', function ($trail) {
    $trail->push(trans('labels.menu.rank_management'), route('ranks.index'));
});
Breadcrumbs::for('ranks.create', function ($trail) {
    $trail->parent('ranks.index');
    $trail->push(trans('ranks.label.create_breadcrumb'), route('ranks.create'));
});
Breadcrumbs::for('ranks.edit', function ($trail, $id) {
    $trail->parent('ranks.index');
    $trail->push(trans('ranks.label.edit_breadcrumb'), route('ranks.edit', $id));
});

Breadcrumbs::for('banks.edit', function ($trail) {
    $trail->push(trans('banks.label.edit_breadcrumb'), route('banks.store'));
});

Breadcrumbs::for('accounts.index', function ($trail) {
    $trail->push(trans('labels.menu.account_management'), route('accounts.index'));
});
Breadcrumbs::for('accounts.create', function ($trail) {
    $trail->parent('accounts.index');
    $trail->push(trans('labels.account.create_breadcrumb'), route('accounts.create'));
});
Breadcrumbs::for('accounts.edit', function ($trail, $id) {
    $trail->parent('accounts.index');
    $trail->push(trans('labels.account.edit_breadcrumb'), route('accounts.edit', $id));
});


Breadcrumbs::for('units.index', function ($trail) {
    $trail->push(trans('labels.menu.units'), route('units.index'));
});
Breadcrumbs::for('units.create', function ($trail) {
    $trail->parent('units.index');
    $trail->push(trans('units.label.unit_register'), route('units.create'));
});
Breadcrumbs::for('units.show', function ($trail, $id) {
    $trail->parent('units.index');
    $trail->push(trans('units.label.detail'), route('units.show', $id));
});
Breadcrumbs::for('units.edit', function ($trail, $id) {
    $trail->parent('units.index');
    $trail->push(trans('units.label.edit'), route('units.edit', $id));
});

Breadcrumbs::for('products.index', function ($trail) {
    $trail->push(trans('labels.menu.product'), route('products.index'));
});
Breadcrumbs::for('products.create', function ($trail) {
    $trail->parent('products.index');
    $trail->push(trans('product.label.product_register'), route('products.create'));
});
Breadcrumbs::for('products.show', function ($trail, $id) {
    $trail->parent('products.index');
    $trail->push(trans('product.label.detail'), route('products.show', $id));
});

Breadcrumbs::for('products.edit', function ($trail, $id) {
    $trail->parent('products.index');
    $trail->push(trans('product.label.edit'), route('products.edit', $id));
});

Breadcrumbs::for('tags.index', function ($trail) {
    $trail->push(trans('labels.menu.tags'), route('tags.index'));
});
Breadcrumbs::for('tags.create', function ($trail) {
    $trail->parent('tags.index');
    $trail->push(trans('tags.label.unit_register'), route('tags.create'));
});
Breadcrumbs::for('tags.show', function ($trail, $id) {
    $trail->parent('tags.index');
    $trail->push(trans('tags.label.detail'), route('tags.show', $id));
});
Breadcrumbs::for('tags.edit', function ($trail, $id) {
    $trail->parent('tags.index');
    $trail->push(trans('tags.label.edit'), route('tags.edit', $id));
});