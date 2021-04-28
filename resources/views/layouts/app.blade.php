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
                    <a href="#" class="nav-link">Home</a>
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
                <img src="{{asset('/storage/logo.png')}}" alt="BGF Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                            <a href="{{route('home')}}" class="nav-link {{ (request()->is('Home')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home text-white"></i>
                                <p class="text-white">
                                    Home
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('assigned.Task')}}" class="nav-link {{ (request()->is('My-Tasks')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-alt text-white"></i>
                                <p class="text-white">
                                    My-Assigned Tasks
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('non.IDconform')}}" class="nav-link {{ (request()->is('Non-confomance-NonID')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book text-white"></i>
                                <p class="text-white">
                                    New Non-conformance
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

                        <li class="nav-item">
                            <a href="{{route('Viewyear.plan')}}" class="nav-link {{ (request()->is('View-Year-Plan')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-eye text-white"></i>
                                <p class="text-white">
                                    View Yearly Plan
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link" data-toggle="control-sidebar">
                                <i class="nav-icon fas fa-tachometer-alt text-white"></i>
                                <p class="text-white">
                                    HOD Review
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('FR.response')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100 font-bold"></i>
                                        <p class="text-grey-100 font-bold">Forestry</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('OP.response')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100 font-bold"></i>
                                        <p class="text-grey-100 font-bold">Operations</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('HR.response')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100 font-bold"></i>
                                        <p class="text-grey-100 font-bold">HR</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('IT.response')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100 font-bold"></i>
                                        <p class="text-grey-100 font-bold">IT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('ACC.response')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100 font-bold"></i>
                                        <p class="text-grey-100 font-bold">Accounts</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('MITI.response')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100 font-bold"></i>
                                        <p class="text-grey-100 font-bold">Miti Magazine</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('CM.response')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100 font-bold"></i>
                                        <p class="text-grey-100 font-bold">Communications</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('ME.response')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-grey-100 font-bold"></i>
                                        <p class="text-grey-100 font-bold">M&E</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('followup')}}" class="nav-link {{ (request()->is('Assign-follow-up-Role')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-hand-holding-usd text-white"></i>
                                <p class="text-white">
                                    Assign Follow-Up Role
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('car.logs')}}" class="nav-link {{ (request()->is('CAR-Logs')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book text-white"></i>
                                <p class="text-white">
                                    CAR logs
                                </p>
                            </a>
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
    <style>
        .la-ball-scale-ripple-multiple,
        .la-ball-scale-ripple-multiple>div {
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .la-ball-scale-ripple-multiple {
            display: block;
            font-size: 0;
            color: #fff;
        }

        .la-ball-scale-ripple-multiple.la-dark {
            color: #333;
        }

        .la-ball-scale-ripple-multiple>div {
            display: inline-block;
            float: none;
            background-color: currentColor;
            border: 0 solid currentColor;
        }

        .la-ball-scale-ripple-multiple {
            width: 32px;
            height: 32px;
        }

        .la-ball-scale-ripple-multiple>div {
            position: absolute;
            top: 0;
            left: 0;
            width: 32px;
            height: 32px;
            background: transparent;
            border-width: 2px;
            border-radius: 100%;
            opacity: 0;
            -webkit-animation: ball-scale-ripple-multiple 1.25s 0s infinite cubic-bezier(.21, .53, .56, .8);
            -moz-animation: ball-scale-ripple-multiple 1.25s 0s infinite cubic-bezier(.21, .53, .56, .8);
            -o-animation: ball-scale-ripple-multiple 1.25s 0s infinite cubic-bezier(.21, .53, .56, .8);
            animation: ball-scale-ripple-multiple 1.25s 0s infinite cubic-bezier(.21, .53, .56, .8);
        }

        .la-ball-scale-ripple-multiple>div:nth-child(1) {
            -webkit-animation-delay: 0s;
            -moz-animation-delay: 0s;
            -o-animation-delay: 0s;
            animation-delay: 0s;
        }

        .la-ball-scale-ripple-multiple>div:nth-child(2) {
            -webkit-animation-delay: .25s;
            -moz-animation-delay: .25s;
            -o-animation-delay: .25s;
            animation-delay: .25s;
        }

        .la-ball-scale-ripple-multiple>div:nth-child(3) {
            -webkit-animation-delay: .5s;
            -moz-animation-delay: .5s;
            -o-animation-delay: .5s;
            animation-delay: .5s;
        }

        .la-ball-scale-ripple-multiple.la-sm {
            width: 16px;
            height: 16px;
        }

        .la-ball-scale-ripple-multiple.la-sm>div {
            width: 16px;
            height: 16px;
            border-width: 1px;
        }

        .la-ball-scale-ripple-multiple.la-2x {
            width: 64px;
            height: 64px;
        }

        .la-ball-scale-ripple-multiple.la-2x>div {
            width: 64px;
            height: 64px;
            border-width: 4px;
        }

        .la-ball-scale-ripple-multiple.la-3x {
            width: 96px;
            height: 96px;
        }

        .la-ball-scale-ripple-multiple.la-3x>div {
            width: 96px;
            height: 96px;
            border-width: 6px;
        }

        /*
 * Animation
 */
        @-webkit-keyframes ball-scale-ripple-multiple {
            0% {
                opacity: 1;
                -webkit-transform: scale(.1);
                transform: scale(.1);
            }

            70% {
                opacity: .5;
                -webkit-transform: scale(1);
                transform: scale(1);
            }

            95% {
                opacity: 0;
            }
        }

        @-moz-keyframes ball-scale-ripple-multiple {
            0% {
                opacity: 1;
                -moz-transform: scale(.1);
                transform: scale(.1);
            }

            70% {
                opacity: .5;
                -moz-transform: scale(1);
                transform: scale(1);
            }

            95% {
                opacity: 0;
            }
        }

        @-o-keyframes ball-scale-ripple-multiple {
            0% {
                opacity: 1;
                -o-transform: scale(.1);
                transform: scale(.1);
            }

            70% {
                opacity: .5;
                -o-transform: scale(1);
                transform: scale(1);
            }

            95% {
                opacity: 0;
            }
        }

        @keyframes ball-scale-ripple-multiple {
            0% {
                opacity: 1;
                -webkit-transform: scale(.1);
                -moz-transform: scale(.1);
                -o-transform: scale(.1);
                transform: scale(.1);
            }

            70% {
                opacity: .5;
                -webkit-transform: scale(1);
                -moz-transform: scale(1);
                -o-transform: scale(1);
                transform: scale(1);
            }

            95% {
                opacity: 0;
            }
        }
    </style>

    <!-- jQuery -->
    <script src="{{asset('parent/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('parent/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('parent/dist/js/adminlte.min.js')}}"></script>
</body>

</html>