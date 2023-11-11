<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminpanel/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminpanel/dist/css/adminlte.min.css') }}">
    <!-- tiny mce -->
    <script src="https://cdn.tiny.cloud/1/3bogn8o0wx0v9mpi48nnocw42eu7h5jv2l3xpzaj47rpnm13/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    {{-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a> --}}
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <span class="brand-text font-weight-light">Sapient Culture.</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="/" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('category2.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product2.index') }}" class="nav-link">
                                <i class="fab fa-product-hunt"></i>
                                <p>
                                    Product
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('subscribe2.index') }}" class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>
                                    Subscribers
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('create.bulk.email') }}" class="nav-link">
                                <i class="fas fa-envelope"></i>
                                <p>
                                    Bulk Email
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('deliveryfee2.index') }}" class="nav-link">
                                <i class="fas fa-pound-sign"></i>
                                <p>
                                    Delivery Fees
                                </p>
                            </a>
                        </li>                       

                        <li class="nav-item">
                            <a href="{{ route('order2.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Orders
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('paid.orders') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Paid</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('unpaid.orders') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Unpaid</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            {{-- <a href="{{ route('subscribe2.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Subscribers
                                </p>
                            </a> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?php date('Y'); ?> sapientculture.com
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 1.0
                </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('adminpanel/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('adminpanel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('adminpanel/dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('adminpanel/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminpanel/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('adminpanel/dist/js/pages/dashboard3.js') }}"></script>
    {{-- search function --}}
    <script>
        // Get the input field and table body
        const input = document.querySelector('#myInput');
        const tbody = document.querySelector('#datatable-basic');

        // Add event listener to input field
        input.addEventListener('input', () => {
            // Get the input value and convert to lowercase
            const inputValue = input.value.toLowerCase();

            // Loop through each row of the table body
            Array.from(tbody.rows).forEach(row => {
                // Get the text content of each cell and convert to lowercase
                const cellText = Array.from(row.cells).map(cell => cell.textContent.trim().toLowerCase())
                    .join(' ');

                // Check if input value is included in cell text content
                if (cellText.includes(inputValue)) {
                    // Display row if input value is included
                    row.style.display = '';
                } else {
                    // Hide row if input value is not included
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
