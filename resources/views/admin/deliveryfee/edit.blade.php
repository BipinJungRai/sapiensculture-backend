@extends('layout.main')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Delivery Address & Fee</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('deliveryfee2.index') }}">Delivery Add & Fee</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Delivery Address & Fee</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card p-3">
                <form action="{{ route('deliveryfee2.update', $deliveryfee2->id) }}" method="POST">                   
                    @csrf
                    @method('PUT')
                    <div class="form-group">

                        <input type="text" class="form-control" name="delivery_address"
                            placeholder="Enter delivery address" value="{{ $deliveryfee2->delivery_address }}" required>

                    </div>

                    <div class="form-group">

                        <input type="number" class="form-control" name="delivery_fee" placeholder="Enter delivery fee"
                            value="{{$deliveryfee2->delivery_fee}}" required>

                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="radio" name="status" value="yes"
                            @if ($deliveryfee2->status == 'active') checked @endif> Active
                        <input type="radio" name="status" value="no"
                            @if ($deliveryfee2->status == 'inactive') checked @endif> Inactive

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </div>
@endsection
