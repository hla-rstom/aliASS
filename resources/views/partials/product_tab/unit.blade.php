<div class="tab-pane fade" id="products-unit" role="tabpanel" aria-labelledby="products-unit-tab">
    <div class="card-body">
        <table id="product-table" class="table table-borderless table-striped" style="width:100%">
            @if($products->isNotEmpty())
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll" class="large-checkbox" style="transform: scale(1.5);"></th>
                    <th>Product</th>
                    <th>Varian</th>
                    <th>Sku</th>
                    <th>Stock</th>
                    <!--<th>Cost of Goods</th>-->
                    <!--<th>Consumer Price</th>-->
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="searchResults">

                @foreach ($products as $product )
                

                <tr>
                    <td class="text-center"><input type="checkbox" name="checked_items[]" class="checkItem large-checkbox" style="transform: scale(1.5);" value="{{ $product->id }}"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->total_variant }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->total_stock_seller }}</td>
                    <!--<td>{{ $product->cost_of_goods }}</td>-->
                    <!--<td>{{ $product->consumer_price }}</td>-->
                    <td>{{ $product->status }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal{{$product->id}}"><i class="fas fa-solid fa-edit"></i> Edit</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-solid fa-arrow-up"></i> Upload To Marketplace</a>
                                <form action="{{ route('deleteproduct', $product->id) }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" href="#" type="submit" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fas fa-regular fa-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else

                <div class="card mb-3 text-center">
                    <div class="card-body">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="{{ asset('storage/images/1705557639_nodata.jpg') }}" alt="...">
                        <h5>There is no Product yet</h5>
                        <p>Let's create your Product.</p>
                        <a class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addModal">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add Product</span>
                        </a>
                    </div>
                </div>
                @endif

            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-4">

            {!! $products->links() !!}
        </div>
    </div>
</div>