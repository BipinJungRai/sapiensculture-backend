@extends('layout.main')

@section('content')
    <?php
    use App\Models\Order;
    use App\Models\Category;
    use App\Models\Product;
    use App\Models\Subscribe;
    use Carbon\Carbon;
    
    // Get the current date
    $currentDate = Carbon::now()->toDateString(); // This will give you the current date in 'Y-m-d' format.
    
    // Query for delivered orders on the current date
    $todaySales = Order::where('payment_status', 'paid')
        ->where('status', 'delivered')
        ->whereDate('updated_at', $currentDate)
        ->get();
    
    // Calculate the total amount for the current date
    $total = 0;
    
    if ($todaySales) {
        foreach ($todaySales as $item) {
            $price = $item->grand_total;
            $total += $price;
        }
    }
    
    // $total now contains the total amount of money from delivered products for the current date (today).
    
    $newOrders = Order::where('payment_status', 'paid')
        ->where('status', 'ordered')
        ->count();
    $pendingOrders = Order::where('payment_status', 'paid')
        ->where('status', 'pending')
        ->count();
    $deliveredOrders = Order::where('payment_status', 'paid')
        ->where('status', 'delivered')
        ->count();
    $cancelledOrders = Order::where('payment_status', 'paid')
        ->where('status', 'cancelled')
        ->count();
    $activeCategories = Category::where('status', 'active')->count();
    $activeProducts = Product::where('feature', 'yes')->count();
    $inactiveProducts = Product::where('feature', 'no')->count();
    $subscribers = Subscribe::count();
    $grandTotal = 0;
    $ordertotals = Order::where('payment_status', 'paid')
        ->where('status', 'delivered')
        ->get();
    
    if ($ordertotals) {
        foreach ($ordertotals as $item) {
            $price = $item->grand_total;
            $grandTotal += $price;
        }
    }
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $newOrders }}</h3>
                                <p>New Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('paid.orders') }}" class="small-box-footer" target="_blank">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $pendingOrders }}</h3>
                                <p>Pending Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('pending.orders') }}" class="small-box-footer" target="_blank">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $deliveredOrders }}</h3>
                                <p>Delivered Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('delivered.orders') }}" class="small-box-footer" target="_blank">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $cancelledOrders }}</h3>
                                <p>Cancelled Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('cancelled.orders') }}" class="small-box-footer" target="_blank">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $activeCategories }}</h3>
                                <p>Categories</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('category2.index') }}" class="small-box-footer" target="_blank">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3>{{ $activeProducts }}</h3>
                                <p>Active Products</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('product2.index') }}" class="small-box-footer" target="_blank">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $inactiveProducts }}</h3>
                                <p>Inactive Products</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                           
                            <a href="{{ route('product2.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $subscribers }}</h3>
                                <p>Subscribers</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('subscribe2.index') }}" class="small-box-footer" target="_blank">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>£{{ $total }}</h3>
                                <p>Today's Sale</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>                           
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>£{{ $grandTotal }}</h3>
                                <p>Total Revenue</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                           
                        </div>
                    </div>

                </div>

            </div>

            <div class="container-fluid">
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 style="font-weight: bold;">65</h3>
                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer" style="font-weight: bold; color: black;">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>




        </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
@endsection
