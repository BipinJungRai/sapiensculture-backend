@extends('layout.main')
@section('title')
    Delivery Add & Fees
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Delivery Add & Fees</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Delivery Add & Fees</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <p class="text-sm mb-3">
                <input type="text" id="myInput" class="form-control" placeholder="Search ..">
            </p>

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Delivery Add & Fees</h3>

                    <div class="card-tools">
                        <a href="{{ route('deliveryfee2.create') }}" class="btn btn-primary">
                            Add Delivery Add & Fee
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="">
                                    Delivery Address
                                </th>
                                <th style="">
                                    Fee
                                </th>
                                <th style="width: 10%" class="text-center">
                                    Status
                                </th>
                                <th style="width: 25%">
                                </th>
                                <th style="width: 25%">
                                </th>
                            </tr>
                        </thead>
                        <tbody id="datatable-basic">
                            <?php $sn = 1; ?>
                            @foreach ($delivery as $item)
                                <tr>
                                    <td>
                                        {{ $sn++ }}
                                    </td>
                                    <td>
                                        {{ $item->delivery_address }}
                                    </td>
                                    <td>
                                        {{ $item->delivery_fee }}
                                    </td>
                                    <td class="project-state">
                                        @if ($item->status == 'active')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('deliveryfee2.edit', $item->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>

                                    </td>
                                    <td>
                                        <form action="{{ route('deliveryfee2.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" href="">
                                                <i class="fas fa-trash">
                                                </i>
                                                
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
