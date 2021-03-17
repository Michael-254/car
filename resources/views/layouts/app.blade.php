<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>CAR | App</title>


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{('parent/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('parent/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @livewireStyles
    @livewireScripts
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="hold-transition sidebar-mini font-sans">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <!-- Messages Dropdown Menu -->
            <ul class=" text-white navbar-nav ml-auto navbar-top-links px-4">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user fa-fw"></i> {{auth()->user()->name}}<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar bg-green-900 elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="http://ta.cs4africa.com/TimeAttandance/global_forest/login/images/BGF_Logo.jpg" alt="BGF Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-bold text-white">CAR-App</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->                      

                        <li class="nav-item">
                            <a href="{{route('assigned.Task')}}" class="nav-link {{ (request()->is('My-Tasks')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-alt text-white"></i>
                                <p class="text-white">
                                    My-Assigned Tasks
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('auditee.respond')}}" class="nav-link {{(request()->segment(1) == 'Auditee-Response') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-reply-all text-white"></i>
                                <p class="text-white">
                                    Respond to NC
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview {{ (request()->segment(1) == 'layout') ? 'menu-open' : '' }} ">
                            <a href="#" class="nav-link {{ (request()->segment(1) == 'layout') ? 'bg-blue-700' : '' }}" data-toggle="control-sidebar">
                                <i class="nav-icon fas fa-tachometer-alt text-white"></i>
                                <p class="text-white">
                                    Prepare Report
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100"></i>
                                        <p class="text-grey-100">Short Repo</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100"></i>
                                        <p class="text-grey-100">Long Repo</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview  {{ (request()->segment(1) == 'Base') ? 'menu-open' : '' }} ">
                            <a href="#" class="nav-link {{ (request()->segment(1) == 'Base') ? 'bg-blue-700' : '' }}" data-toggle="control-sidebar">
                                <i class="nav-icon fas fa-tachometer-alt text-white"></i>
                                <p class="text-white">
                                    Starter Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100"></i>
                                        <p class="text-grey-100">Active Page</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100"></i>
                                        <p class="text-grey-100">Inactive Page</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('view.tasks')}}" class="nav-link {{ (request()->is('View-Assigned-Tasks')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-eye text-white"></i>
                                <p class="text-white">
                                    View Assigned-Tasks
                                </p>
                            </a>
                        </li>                       

                        <li class="nav-item">
                            <a href="{{route('addActivity')}}" class="nav-link {{ (request()->is('Add-Activities-To-Audit')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-plus-circle text-white"></i>
                                <p class="text-white">
                                    Add Activities
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('yearly.plan')}}" class="nav-link {{ (request()->is('Yearly-Plan')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-alt text-white"></i>
                                <p class="text-white">
                                    Make Yearly Plan
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('Viewyear.plan')}}" class="nav-link {{ (request()->is('View-Year-Plan')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-eye text-white"></i>
                                <p class="text-white">
                                   View Yearly Plan
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        {{$slot}}
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- Default to the left -->
            <strong>Copyright &copy; 2021 <a href="#">Better Globe Forestry</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
   
    <!-- jQuery -->
    <script src="{{asset('parent/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('parent/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('parent/dist/js/adminlte.min.js')}}"></script>
</body>

</html>