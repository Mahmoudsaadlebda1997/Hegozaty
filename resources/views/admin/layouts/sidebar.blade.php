<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">بنك الدم</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ auth()->user()->name }}
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview {{ $active == 'dashboard' ? 'menu-open': '' }}">
                    <a href="{{ route('homeDashboard') }}" class="nav-link {{ $active == 'dashboard' ? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            الرئيسية
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ $active == 'blood_types' ? 'active': '' }}">
                        <i class="nav-icon fas fa-eye-dropper"></i>
                        <p>
                            فصائل الدم
                            <i class="fas fa-angle-left right"></i>
                            @php
                                $blood_types = \App\Models\BloodType::all();
                                $blood_types->map(function ($blood_type) {
                                    if ($blood_type->count < 5)
                                       echo '<i class="fas fa-bell right"></i>';
                                    });
                            @endphp
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('blood_types.index') }}"
                               class="nav-link {{ $active == 'blood_types' ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>الكل</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('blood_types.create') }}"
                               class="nav-link {{ $active == 'blood_types' ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>اضف فصيلة</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ $active == 'branches' ? 'active': '' }}">
                        <i class="nav-icon fas fa-map-marker"></i>
                        <p>
                            الفروع
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('branches.index') }}"
                               class="nav-link {{ $active == 'branches' ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>الكل</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('branches.create') }}"
                               class="nav-link {{ $active == 'branches' ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>اضف فرع</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ $active == 'donors' ? 'active': '' }}">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>
                            المتبرعين
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('donors.index') }}"
                               class="nav-link {{ $active == 'donors' ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>الكل</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('donors.create') }}"
                               class="nav-link {{ $active == 'donors' ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>اضف متبرع</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ $active == 'users' ? 'active': '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            المستخدمين
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" {{ $active == 'users' ? 'active': '' }}>
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>الكل</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('users.create') }}"
                               class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>اضف مستخدم</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ $active == 'orders' ? 'active': '' }}">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>
                            الطلبات
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" {{ $active == 'orders' ? 'active': '' }}>
                            <a href="{{ route('orders.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>الكل</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="ml-3 nav-link" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        تسجيل الخروج
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
