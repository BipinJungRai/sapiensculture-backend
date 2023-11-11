@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('category2.index')}}">Categories</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
       <div class="card p-3">
        <form action="{{route('category2.store')}}" method="POST">
            @csrf
            <div class="form-group">
              
              <input type="text" class="form-control" name="category_name" placeholder="Enter category name" required>
             
            </div>            
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
       </div>
    </section>
</div>
@endsection