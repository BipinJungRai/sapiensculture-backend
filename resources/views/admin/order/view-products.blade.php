  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#paid-products{{$item->id}}">
                                            View
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="paid-products{{$item->id}}" tabindex="-1"
                                            aria-labelledby="paid-productsLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="paid-productsLabel">Ordered Products
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-dark">
                                                            <thead>
                                                                <tr>
                                                                    <th>Product</th>
                                                                    <th>Size</th>
                                                                    <th>Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($item->productDetails as $item2)
                                                                    <tr>
                                                                        <td>{{ $item2['product_name'] }}</td>
                                                                        <td>{{ $item2['size'] }}</td>
                                                                        <td>{{ $item2['price'] }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>