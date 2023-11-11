@extends('layout.main')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('product2.index') }}">Products</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card p-3">
                <form action="{{ route('product2.update', $product2->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="product_name" value="{{ $product2->product_name }}"
                            placeholder="Enter product name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Enter product price"
                            value="{{ $product2->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select class="form-control" name="category_id" required>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" @if ($product2->category_id == $item->id) selected @endif>
                                    {{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Thumbnail (only one)</label>
                        <input type="file" class="form-control" name="thumbnail" value="{{ $product2->thumbnail }}">
                    </div>
                    <div class="form-group">
                        <label for="">Images (multiple)</label>
                        <input type="file" class="form-control" name="images[]" multiple value="{{ $product2->images }}">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="myeditorinstance" placeholder="Enter product description.">{{ $product2->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="size_ids">Sizes</label>
                        <div>
                            @for ($i = 0; $i < count($sizes); $i++)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="size_ids[]"
                                        value="{{ $sizes[$i]->id }}" @if (in_array($sizes[$i]->id, $selectedSizeIds)) checked @endif
                                        id="size_{{ $sizes[$i]->id }}" onchange="toggleNumberInput({{ $sizes[$i]->id }})">
                                    <label class="form-check-label" for="size_{{ $sizes[$i]->id }}">
                                        {{ $sizes[$i]->product_size }}
                                    </label>

                                    @if (isset($sizeStockArray[$i]) && $sizeStockArray[$i]['stock'] > 0)
                                        <input type="number" style="margin-bottom: 5px" name="stock[]"
                                            value="{{ $sizeStockArray[$i]['stock'] }}" id="stock_{{ $sizes[$i]->id }}">
                                    @else
                                        <input type="hidden" style="margin-bottom: 5px" name="stock[]" value="0"
                                            id="stock_{{ $sizes[$i]->id }}">
                                    @endif

                                </div>
                            @endfor
                        </div>


                    </div>

                    <div class="form-group">
                        <label for="">Feature</label>
                        <input type="radio" name="feature" value="yes"
                            @if ($product2->feature == 'yes') checked @endif> Yes
                        <input type="radio" name="feature" value="no"
                            @if ($product2->feature == 'no') checked @endif> No

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
                // numberInput.disabled = false;
                numberInput.value = '1';
            } else {
                numberInput.type = 'hidden';
                numberInput.value = '0';
                // numberInput.disabled = true;
            }
        }
    </script>
@endsection
