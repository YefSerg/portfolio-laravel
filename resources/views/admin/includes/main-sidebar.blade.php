@php use Illuminate\Support\Facades\Route; @endphp
    <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <p class="text-uppercase font-weight-bold">Dashboard</p>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if(auth()->user()->role->value === \App\Enums\UserRoles::SUPER_ADMIN->value)
                    <li class="nav-item">
                        <a href="{{ route('admin.user.index') }}"
                            @class([
                                 'nav-link',
                                 'active' => route('admin.user.index') == Route::is('admin.user.index')
                                 ])
                        >
                            <i class="fa fa-user nav-icon"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('admin.category.index') }}"
                        @class([
                             'nav-link',
                             'active' => route('admin.category.index') == Route::is('admin.category.index')
                             ])
                    >
                        <i class="fa fa-list nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.project.index') }}"
                        @class([
                             'nav-link',
                             'active' => route('admin.project.index') == Route::is('admin.project.index')
                             ])
                    >
                        <i class="fa fa-project-diagram nav-icon"></i>
                        <p>Projects</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
