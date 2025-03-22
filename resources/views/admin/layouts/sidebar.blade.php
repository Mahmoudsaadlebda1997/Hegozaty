<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">لوحه تحكم بنك الدلتا</span>
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
                <li class="nav-item has-treeview {{ $active == 'dashboard' ? 'menu-open' : '' }}">
                    <a href="{{ route('homeDashboard') }}" class="nav-link {{ $active == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>الرئيسية</p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{ $active == 'services' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $active == 'services' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bread-slice"></i>
                        <p>الخدمات<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('services.index') }}" class="nav-link {{ $active == 'services' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>الكل</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('services.create') }}" class="nav-link {{ $active == 'services' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>اضف الخدمه</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview {{ $active == 'reservations' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $active == 'reservations' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>الحجوزات<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('reservations.index') }}" class="nav-link {{ $active == 'reservations' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>الكل</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview {{ $active == 'users' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $active == 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>المستخدمين<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ $active == 'users' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>الكل</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}" class="nav-link {{ $active == 'users' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>اضف مستخدم</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logoutUser') }}">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>تسجيل الخروج</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
