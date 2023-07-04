<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="dropdown user user-menu open">
            <a href="#" data-toggle="dropdown" aria-expanded="true">
                <span class="btn btn-default btn-right">Admin</span>
            </a>
            <ul class="dropdown-menu" style="width: 100% !important">
                <li class="user-footer">
                    <!-- <div style="float: left;">
                        <a href="#" class="btn btn-default btn-flat">Change Password</a>
                    </div> -->
                    <div class="pull-right">
                        <a href="{{ url('logout') }}" class="btn btn-default btn-right" style="width: 100% !important">Sign out</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ URL::to('dashboard') }}" class="brand-link">

        <img src="{{ asset('assets/image/Digicow_logo.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3 rounded-circle" style="opacity: .8; background-color: white;" height="70" width="100">
        <span class="brand-text font-weight-light">Digicow Customer</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
        alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">Admin</a>
    </div>
    </div> --}}



    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php
            $current_route_one = Illuminate\Support\Facades\Request::segment(1);
            $current_route = Illuminate\Support\Facades\Request::segment(2);
            ?>
            <x-backend-navigation menu-title="Dashboard" fa-class="fa-tachometer-alt" routes="{{ url('dashboard') }}" active-route='dashboard' />

            <li class="nav-item  {{ $current_route_one == 'cow' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'cow' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Cows
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: {{ $current_route_one == 'cow' ? 'block' : 'none' }} ;">
                    <li class="nav-item">
                        <a href="{{ url('cow/new-register') }}" class="nav-link {{ $current_route == 'new-register' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Register New Cow</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('cow/sold-register') }}" class="nav-link  {{ $current_route == 'sold-register' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Record Sold Cow</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('cow/dead-register') }}" class="nav-link  {{ $current_route == 'dead-register' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Record Dead Cow</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('cow/genetic-register') }}" class="nav-link {{ $current_route == 'genetic-register' ? 'active' : null }} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Update Genetic Record </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('cow/list') }}" class="nav-link {{ $current_route == 'list' ? 'active' : null }} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p> View All </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('cow/dead-list') }}" class="nav-link {{ $current_route == 'dead-list' ? 'active' : null }} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p> View Dead </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('cow/sold-list') }}" class="nav-link {{ $current_route == 'sold-list' ? 'active' : null }} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p> View sold </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('cow/deleted-list') }}" class="nav-link {{ $current_route == 'deleted-list' ? 'active' : null }} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p> View Deleted </p>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item {{ $current_route_one == 'calfs' ? 'menu-is-opening menu-open' : null }} ">
                <a href="#" class="nav-link {{ $current_route_one == 'calfs' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Calfs
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: {{ $current_route_one == 'calfs' ? 'block' : 'none' }};">
                    <li class="nav-item">
                        <a href="{{ url('calfs/new-register') }}" class="nav-link {{ $current_route == 'new-register' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Register New Calfs</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('calfs/sold-register') }}" class="nav-link {{ $current_route == 'sold-register' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Record Sold Calf</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('calfs/dead-register') }}" class="nav-link {{ $current_route == 'dead-register' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Record Dead Calf</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('calfs/genetic-register') }}" class="nav-link {{ $current_route == 'genetic-register' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Update Genetic Record </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('calfs/list') }}" class="nav-link {{ $current_route == 'list' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> View All </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('calfs/dead-list') }}" class="nav-link {{ $current_route == 'dead-list' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> View Dead </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('calfs/sold-list') }}" class="nav-link {{ $current_route == 'sold-list' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> View sold </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('calfs/deleted-list') }}" class="nav-link {{ $current_route == 'deleted-list' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> View Deleted </p>
                        </a>
                    </li>

                </ul>
            </li>


            {{-- <x-backend-navigation menu-title="Record Milk Production" fa-class="far fa-circle nav-icon"
                    routes="{{ url('record-milk-production/list') }}" active-route='list' /> --}}

            <li class="nav-item">
                <a href="{{ url('record-milk-production/list') }}" class="nav-link  {{ $current_route == 'list' ? 'active' : null }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Record Milk Production</p>
                </a>
            </li>

            <li class="nav-item {{ $current_route_one == 'record-milk-production' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'record-milk-production' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Milk Production Report
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: {{ $current_route_one == 'record-milk-production' ? 'block' : 'none' }};">
                    <li class="nav-item">
                        <a href="{{ url('record-milk-production/per-cow') }}" class="nav-link  {{ $current_route == 'per-cow' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Per Cow</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('record-milk-production/all-cow') }}" class="nav-link  {{ $current_route == 'all-cow' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Cow</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ $current_route_one == 'feeding' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'feeding' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Feed Record
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: {{ $current_route_one == 'feeding' ? 'block' : 'none' }};">
                    <li class="nav-item">
                        <a href="{{ url('feeding/feed-create') }}" class="nav-link  {{ $current_route == 'feed-create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Concentrates</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('feeding/feed-minerals-create') }}" class="nav-link  {{ $current_route == 'feed-minerals-create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Minerals and Others</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('feeding/feed-basal-create') }}" class="nav-link  {{ $current_route == 'feed-basal-create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Basal</p>
                        </a>
                    </li>
                </ul>
            </li>

            <x-backend-navigation menu-title="Feed Report" fa-class="far fa-circle nav-icon" routes="{{ url('feeding/feed-report-list') }}" active-route='feed-report-list' />

            <li class="nav-item {{ $current_route_one == 'feed' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'feed' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Feed Stock Record
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: {{ $current_route_one == 'feed' ? 'block' : 'none' }};">
                    <li class="nav-item">
                        <a href="{{ url('feed/stock-create') }}" class="nav-link  {{ $current_route == 'stock-create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Concentrates</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('feed/stock-minerals-create') }}" class="nav-link  {{ $current_route == 'stock-minerals-create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Minerals and Others</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('feed/stock-basal-create') }}" class="nav-link  {{ $current_route == 'stock-basal-create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Basal</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ $current_route_one == 'milk-sales' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'milk-sales' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Milk Sales Record
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: {{ $current_route_one == 'milk-sales' ? 'block' : 'none' }};">
                    <li class="nav-item">
                        <a href="{{ url('milk-sales/customer-create') }}" class="nav-link  {{ $current_route == 'customer-create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Customer</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('milk-sales/coop-create') }}" class="nav-link  {{ $current_route == 'coop-create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Co-Operative</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ $current_route_one == 'milk-payment' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'milk-payment' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Milk Payment Record
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display:{{ $current_route_one == 'milk-payment' ? 'block' : 'none' }}">
                    <li class="nav-item">
                        <a href="{{ url('milk-payment/customer-pay-create') }}" class="nav-link  {{ $current_route == 'customer-pay-create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Customer</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('milk-payment/coop-pay-create') }}" class="nav-link  {{ $current_route == 'coop-pay-create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Co-Operative</p>
                        </a>
                    </li>
                </ul>
            </li>



            <li class="nav-item {{ $current_route_one == 'milk-sale-report' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'milk-sale-report' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Milk Sales Reports
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display:{{ $current_route_one == 'milk-sale-report' ? 'block' : 'none' }}">
                    <li class="nav-item">
                        <a href="{{ url('milk-sale-report/all-customer-list') }}" class="nav-link  {{ $current_route == 'all-customer-list' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Customer</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('milk-sale-report/coop-list') }}" class="nav-link  {{ $current_route == 'coop-list' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Per Customer</p>
                        </a>
                    </li>
                </ul>
            </li>



            <li class="nav-item {{ $current_route_one == 'farmer-clients-customer' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'farmer-clients-customer' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Customer
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display:{{ $current_route_one == 'farmer-clients-customer' ? 'block' : 'none' }}">
                    <li class="nav-item">
                        <a href="{{ url('farmer-clients-customer/create') }}" class="nav-link  {{ $current_route == 'create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Register New Customer</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('farmer-clients-customer/customer-list') }}" class="nav-link  {{ $current_route == 'customer-list' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View All</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ $current_route_one == 'farmer-coop' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'farmer-coop' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Co-operative
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display:{{ $current_route_one == 'farmer-coop' ? 'block' : 'none' }}">
                    <li class="nav-item">
                        <a href="{{ url('farmer-coop/create') }}" class="nav-link  {{ $current_route == 'create' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Register</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('farmer-coop/coop-list') }}" class="nav-link  {{ $current_route == 'coop-list' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View All</p>
                        </a>
                    </li>
                </ul>
            </li>



            <li class="nav-item {{ $current_route_one == 'staff' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'staff' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Staff
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display:{{ $current_route_one == 'staff' ? 'block' : 'none' }}">
                    <li class="nav-item">
                        <a href="{{ url('staff/create-staff') }}" class="nav-link  {{ $current_route == 'create-staff' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Register New Staff</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('staff/staff-list') }}" class="nav-link  {{ $current_route == 'staff-list' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View All</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ $current_route_one == 'artificial-insemination' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'artificial-insemination' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Artificial Insemination
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display:{{ $current_route_one == 'artificial-insemination' ? 'block' : 'none' }}">
                    <li class="nav-item">
                        <a href="{{ url('artificial-insemination/create-artificial') }}" class="nav-link  {{ $current_route == 'create-artificial' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Record New AI</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('artificial-insemination/artificial-list') }}" class="nav-link  {{ $current_route == 'artificial-list' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> View All AI</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ $current_route_one == 'health-record' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'health-record' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Health Record
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display:{{ $current_route_one == 'health-record' ? 'block' : 'none' }}">
                    <li class="nav-item">
                        <a href="{{ url('health-record/create-treatment') }}" class="nav-link  {{ $current_route == 'create-treatment' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Treatment</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('health-record/create-vaccine') }}" class="nav-link  {{ $current_route == 'create-vaccine' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Vaccine</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('health-record/create-dewormer') }}" class="nav-link  {{ $current_route == 'create-dewormer' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>De-wormer</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ $current_route_one == 'health-report' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'health-report' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Health Report
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display:{{ $current_route_one == 'health-report' ? 'block' : 'none' }}">
                    <li class="nav-item">
                        <a href="{{ url('health-report/list-treatment') }}" class="nav-link  {{ $current_route == 'list-treatment' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Treatment</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('health-report/list-vaccine') }}" class="nav-link  {{ $current_route == 'list-vaccine' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Vaccine</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('health-report/list-dewormer') }}" class="nav-link  {{ $current_route == 'list-dewormer' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>De-wormer</p>
                        </a>
                    </li>
                </ul>
            </li>



            <li class="nav-item {{ $current_route_one == 'salary' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'salary' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Salary
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display:{{ $current_route_one == 'salary' ? 'block' : 'none' }}">
                    <li class="nav-item">
                        <a href="{{ url('salary/create-salary') }}" class="nav-link  {{ $current_route == 'create-salary' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Record</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('salary/list-salary') }}" class="nav-link  {{ $current_route == 'list-salary' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ $current_route_one == 'other_incomes' ? 'menu-is-opening menu-open' : null }}">
                <a href="#" class="nav-link {{ $current_route_one == 'other_incomes' ? 'active' : null }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Other Income
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display:{{ $current_route_one == 'other_incomes' ? 'block' : 'none' }}">
                    <li class="nav-item">
                        <a href="{{ url('other_incomes/create-income') }}" class="nav-link  {{ $current_route == 'create-income' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Income</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('other_incomes/list-income') }}" class="nav-link  {{ $current_route == 'list-income' ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Income List</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
