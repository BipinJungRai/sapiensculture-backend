@extends('layout.main')
@section('title')
    Products
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                    <h3 class="card-title">Categories</h3>

                    <div class="card-tools">
                        <a href="{{ route('product2.create') }}" class="btn btn-primary">
                            Add Product
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
                                <th>
                                    Product Name
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Category
                                </th>
                                <th class="text-center">
                                    Feature
                                </th>
                                <th>
                                    Sizes
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="datatable-basic">
                            <?php $sn = 1; ?>
                            @foreach ($products as $item)
                                <tr>
                                    <td>
                                        {{ $sn++ }}
                                    </td>
                                    <td>
                                        {{ $item->product_name }}
                                    </td>
                                    <td>
                                        {{ $item->price }}
                                    </td>
                                    <td>
                                        {{ $item->category }}
                                    </td>
                                    <td class="project-state">
                                        @if ($item->feature == 'yes')
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($item->details as $item2)
                                            {{ $item2->product_size }}<span style="background-color: black; border-radius: 50%; padding: 2%; color: white;">{{$item2->stock}}</span>,
                                        @endforeach
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('product2.edit', $item->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            
                                        </a>

                                    </td>
                                    <td>
                                        <form action="{{ route('product2.destroy', $item->id) }}" method="POST">
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
