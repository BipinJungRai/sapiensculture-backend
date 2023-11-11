@extends('layout.main')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('product2.index') }}">Products</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card p-3">
                <form action="{{ route('product2.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="product_name" placeholder="Enter product name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Enter product price"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select class="form-control" name="category_id" required>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="">Thumbnail (only one, 400x400)</label>
                        <input type="file" class="form-control" name="thumbnail" required>
                    </div>
                    <div class="form-group">
                        <label for="">Images (multiple, 1280x896)</label>
                        <input type="file" class="form-control" name="images[]" multiple required>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="myeditorinstance" placeholder="Enter product description."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="size_ids">Sizes and Stocks</label>
                        <div>
                            @foreach ($sizes as $size)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="size_ids[]"
                                        value="{{ $size->id }}" id="size_{{ $size->id }}"
                                        onchange="toggleNumberInput({{ $size->id }})">
                                    <label class="form-check-label" for="size_{{ $size->id }}">
                                        {{ $size->product_size }}
                                    </label>
                                    <input type="hidden" style="margin-bottom: 5px" name="stock[]" value="0"
                                        id="stock_{{ $size->id }}">
                                </div>
                            @endforeach
                        </div>



                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });


        function toggleNumberInput(sizeId) {
            var numberInput = document.getElementById('stock_' + sizeId);
            var checkbox = document.getElementById('size_' + sizeId);

            if (checkbox.checked) {
                numberInput.type = 'number';
                numberInput.value = '1';
            } else {
                numberInput.type = 'hidden';
                numberInput.value = '0';
            }
        }
    </script>
@endsection
