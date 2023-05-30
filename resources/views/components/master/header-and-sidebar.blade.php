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
                        <a href="{{ url('logout') }}" class="btn btn-default btn-right"
                            style="width: 100% !important">Sign out</a>
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

        <img src="{{ asset('assets/image/Digicow_logo.png') }}" alt="AdminLTE Logo"
            class="brand-image elevation-3 rounded-circle" style="opacity: .8; background-color: white;" height="70"
            width="100">
        <span class="brand-text font-weight-light">Digicow Customer</span>
    </a>
    {{--  img-circle     --}}
    <!-- Sidebar -->
    <div class="sidebar">
        {{--  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>  --}}



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php
                $current_route = Illuminate\Support\Facades\Request::segment(2);
                ?>
                <x-backend-navigation menu-title="Dashboard" fa-class="fa-tachometer-alt"
                    routes="{{ url('dashboard') }}" active-route='dashboard' />

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Cows
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ url('cow/new-register') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Register New Cow</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('cow/sold-register') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Record Sold Cow</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('cow/dead-register') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Record Dead Cow</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('cow/genetic-register') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Update Genetic Record </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('cow/list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> View All </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('cow/dead-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> View Dead </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('cow/sold-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> View sold </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('cow/deleted-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> View Deleted </p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Calfs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ url('calfs/new-register') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Register New Calfs</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('calfs/sold-register') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Record Sold Calf</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('calfs/dead-register') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Record Dead Calf</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('calfs/genetic-register') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Update Genetic Record </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('calfs/list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> View All </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('calfs/dead-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> View Dead </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('calfs/sold-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> View sold </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('calfs/deleted-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> View Deleted </p>
                            </a>
                        </li>

                    </ul>
                </li>


                <x-backend-navigation menu-title="Record Milk Production" fa-class="far fa-circle nav-icon"
                    routes="{{ url('record-milk-production/list') }}" active-route='record-milk-production' />


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Milk Production Report
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ url('record-milk-production/per-cow') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Per Cow</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('record-milk-production/all-cow') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Cow</p>
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
