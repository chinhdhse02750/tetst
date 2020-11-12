<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('labels.general.menu')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin.dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon cil-clipboard"></i>
                    @lang('labels.menu.dashboard')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(\Request::is('admin/contact*'))
                }}"  href="{{ route('units.index') }}">
                    <i class="nav-icon cil-envelope-closed"></i>
                    Quản lý đơn vị tính
                </a>
            </li>

            <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                    <i class="nav-icon far fa-user"></i>
                    @lang('labels.menu.member_management')
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link nav-child {{
                    active_class(\Request::is('admin/member*'))
                }}" href="{{ route('member.index', 'female') }}">
                            <i class="nav-icon cil-wc"></i>
                            @lang('labels.menu.user_management')
                        </a>
                    </li>
                    @can('balances_management')
                        <li class="nav-item">
                            <a class="nav-link nav-child {{
                    active_class(Route::is('admin/balances'))
                }}" href="{{ route('member.balances') }}">
                                <i class="nav-icon cib-auth0"></i>
                                @lang('labels.menu.balances')
                            </a>
                        </li>
                    @endcan

                    @can('offer_management')
                        <li class="nav-item">
                            <a class="nav-link nav-child {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('offers.index') }}">
                                <i class="nav-icon cib-todoist"></i>
                                @lang('labels.menu.offer')
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            <li class="divider"></li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(\Request::is('admin/contact*'))
                }}" href="{{ route('contact.index') }}">
                    <i class="nav-icon cil-envelope-closed"></i>
                    @lang('labels.menu.contact')
                </a>
            </li>
            <li class="divider"></li>

            @can('master_data_management')
                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon cil-cloud"></i>
                        @lang('labels.menu.master')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link nav-child {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('categories.index') }}">
                                <i class="nav-icon cil-view-stream"></i>
                                @lang('labels.menu.category')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-child {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('prefectures.index') }}">
                                <i class="nav-icon cil-location-pin"></i>
                                @lang('labels.menu.prefecture')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-child {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('ranks.index') }}">
                                <i class="nav-icon cib-coveralls"></i>
                                @lang('labels.menu.rank_management')
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                    <i class="nav-icon cil-credit-card"></i>
                    @lang('labels.menu.content')
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link nav-child {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('banners.index') }}">
                            <i class="nav-icon cil-inbox"></i>
                            @lang('labels.menu.banner')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-child {{
                                active_class(Route::is('admin/auth*'))
                            }}" href="{{ route('news.index') }}">
                            <i class="nav-icon cil-bell"></i>
                            @lang('labels.menu.notification_management')
                        </a>
                    </li>
                </ul>
            </li>

            <li class="divider"></li>

            @can('setting_management')
                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon cil-settings"></i>
                        @lang('labels.menu.setting_management')
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link nav-child {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('banks.edit') }}">
                                <i class="nav-icon cil-settings" aria-hidden="true"></i>
                                @lang('labels.menu.bank_management')
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('account_management')
                <li class="nav-item {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link" href="{{ route('accounts.index') }}">
                        <i class="nav-icon cil-contact"></i>
                        @lang('labels.menu.account_management')
                    </a>
                </li>
            @endcan
            {{--@endif--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
