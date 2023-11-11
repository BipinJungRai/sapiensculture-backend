@extends('layout.main')
@section('title')
    Orders
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Orders</li>
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
                                    First Name
                                </th>
                                <th style="">
                                    Last Name
                                </th>
                                <th style="">
                                    Phone Number
                                </th>
                                <th style="">
                                    Email
                                </th>
                                <th style="">
                                    Delivery Address
                                </th>

                                <th style="">
                                    Date
                                </th>
                                <th style="">
                                    Status
                                </th>
                                <th style="" class="text-center">
                                    Payment Status
                                </th>
                                <th style="">
                                    Paypal Order ID
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
                                        {{ $item->firstname }}
                                    </td>
                                    <td>
                                        {{ $item->lastname }}
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
                                        ordered
                                    </td>
                                    <td>
                                        {{$item->payment_status}}
                                    </td>
                                    <td>
                                        {{ $item->order_id_from_paypal }}
                                    </td>
                                    <td>
                                        <form action="{{ route('category2.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" href="">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
