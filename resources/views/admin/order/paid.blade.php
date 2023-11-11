@extends('layout.main')
@section('title')
    Ordered
@endsection
@section('content')
    <div class="content-wrapper">
        {{-- nav --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('paid.orders') }}">Ordered <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pending.orders') }}">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('delivered.orders') }}">Delivered</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cancelled.orders') }}">Cancelled</a>
                    </li>

                </ul>

            </div>
        </nav>
        {{-- nav end --}}
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ordered</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Ordered</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <p class="text-sm mb-3">
                <input type="text" id="myInput" class="form-control" placeholder="Search ..">
            </p>

            <!-- Default box -->
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="">
                                    Full Name
                                </th>

                                <th style="">
                                    Phone Number
                                </th>
                                <th style="">
                                    Email
                                </th>
                                <th style="">
                                    Address
                                </th>
                                <th style="">
                                    Date
                                </th>
                                <th style="">
                                    Total
                                </th>
                                <th style="">
                                    Order ID
                                </th>
                                <th style="">
                                    View
                                </th>
                                <th style="">
                                    Status
                                </th>


                            </tr>
                        </thead>
                        <tbody id="datatable-basic">
                            <?php $sn = 1; ?>
                            
                            @foreach ($orders as $item)
                                <tr>
                                    <td>
                                        {{ $sn++ }}
                                    </td>
                                    <td>
                                        {{ $item->firstname }} {{ $item->lastname }}
                                    </td>

                                    <td>
                                        {{ $item->phone_number }}
                                    </td>
                                    <td>
                                        {{ $item->email }}
                                    </td>
                                    <td>
                                        {{ $item->delivery_address }}
                                    </td>

                                    <td>
                                        {{ $item->updated_at }}
                                    </td>
                                    <td>
                                        {{ $item->total }}
                                    </td>
                                    <td>
                                        {{ $item->order_id_from_paypal }}
                                    </td>
                                    <td>                                       
                                        @include('admin.order.view-products')
                                    </td>
                                    <td>
                                        <form action="{{ route('orderstatus.update', $item->id) }}" method="POST">
                                            @csrf
                                            {{-- @method('PUT') --}}
                                            <div class="input-group">
                                                <select class="custom-select" id="inputGroupSelect04"
                                                    aria-label="Example select with button addon" name="status">
                                                    <option selected>Choose...</option>
                                                    <option value="pending">pending</option>
                                                    <option value="delivered">delivered</option>
                                                    <option value="cancelled">cancelled</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="submit">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
