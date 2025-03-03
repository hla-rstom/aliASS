@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <div class="col-lg-12">
        <div class="col-md-6 text-left">
            <h3 class=" text-gray-800">Move Warehouse</h3>
            <div class="row ml-2">
                <a href="{{ route('mywarehouse') }}">My Warehouse /</a> &nbsp;
                <a href="{{ route('mywarehousedetail',$id) }}">My Warehouse Detail /</a> &nbsp;
                <div class="small-text"> Move</div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('storetransaction') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                    @csrf
                    <input type="hidden" name="type" value="move">
                    <input type="hidden" name="warehouse_id" value="{{$id}}">
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="mb2"><b>Warehouse Info </b></p>
                            <div class="row ml-1">
                                <div class="form-group col-lg-5 mr-3">
                                    <label for="recipient_name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" value="{{$warehousename}}" disabled>
                                    <input type="hidden" class="form-control" name="warehouse_before" value="{{$warehouseid}}">
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="warehouse_id" class="col-form-label">Warehouse</label>
                                    <select class="form-control" name="warehouse_id" id="warehouse_id">
                                        <option value="">Select Warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                            {{ $warehouse->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="mb2"><b>Transfer Scheme</b></p>
                            <p>Please select a scheme for transferring warehouses:</p>
                            <div class="row ml-1">
                                <div class="form-check mr-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="transferScheme" id="scheme500" value="scheme500" checked>
                                        <label class="form-check-label" for="scheme500">
                                            Transaction with a scheme of 500 units (Minimum 100 SKU units)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="transferScheme" id="schemeWarehouse" value="schemeWarehouse">
                                        <label class="form-check-label" for="schemeWarehouse">
                                            Transaction with a warehouse scheme
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-lg-12 mb-3">
                        <div class="card-body">
                            <p class="mb-2"><b>The product is sent as a master product</b></p>

                            <table id="product-main" class="table table-borderless table-striped mt-2" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Qc</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#exampleModal">+ Add Product</button>
                        </div>
                    </div>
                    <!-- Modal Product add-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mt-2">
                                        <div class="col-auto ml-4">
                                            <div class="input-group">
                                                <input type="text" id="searchInputproduct" class="form-control" placeholder="Search product here">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container mt-4">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="card shadow">
                                                    <div class="card-body">
                                                        <div class="row" id="staticProducts">
                                                            @foreach ($products as $product)
                                                            @php
                                                            $dataJson = json_decode($product->data_json, true);
                                                            $image = $dataJson['image']['image_url_list'][0] ?? '';
                                                            @endphp
                                                            <div class="col-md-6">
                                                                <div class="d-flex align-items-start">
                                                                    <input type="checkbox" name="checked_items[]" class="checkItem large-checkbox mr-2" value="{{ $product->id }}">
                                                                    <div>
                                                                        <h5 class="card-title d-inline">{{ $product->name }}</h5>
                                                                        <img src="{{ $image }}" style="width: 30%; height: auto; display: block; margin-top: 10px;" class="rounded">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="row" id="searchResults" style="display: none;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="card shadow">
                                                    <div class="card-body">
                                                        <ul id="selectedProductsList"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button id="submitModal" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-lg-12 mb-3">
                        <div class="card-body">
                            <p class="mb-2"><b>Packaging</b></p>
                            <div class="row mt-4">

                                <div class="col-auto ml-auto">
                                    <div class="input-group">
                                        <input type="text" id="searchInputpackaging" class="form-control" placeholder="Search here">
                                    </div>
                                </div>
                            </div>
                            <table id="packaging-table" class="table table-borderless table-striped mt-2" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody id="searchResultspackaging">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <p><b>Item Pickup</b></p>
                            <p>Choose pikup method:</p>
                            <div class="row ml-1">
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="radio" name="pikupmethod" id="selfpickup" value="selfpickup" checked>
                                    <label class="form-check-label" for="selfpickup">
                                        Self pickup
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pikupmethod" id="reguler" value="reguler">
                                    <label class="form-check-label" for="reguler">
                                        Reguler
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Notes</label>
                                <textarea class="form-control" id="message-text" cols="40" name="notes">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="recipient">
                        <div class="card-body">
                            <p class="mb-2"><b>Recipient Information</b></p>
                            <div class="form-row">
                                <div class="form-group col-lg-6 mr-3">
                                    <label for="recipient_name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" name="recipient_name" value="{{ old('recipient_name') }}">
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="recipient_phone" class="col-form-label">Phone</label>
                                    <input type="text" class="form-control" name="recipient_phone" value="{{ old('recipient_phone') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Address</label>
                                <textarea class="form-control" id="message-text" cols="40" name="recipient_address">{{ old('recipient_address') }}</textarea>
                            </div>

                        </div>
                    </div>
                    <div class="card" id="logistic">
                        <div class="card-body">
                            <p class="mb-2"><b>Logistic Information</b></p>
                            <div class="form-row">
                                <div class="form-group col-lg-5">
                                    <label for="logistic_id" class="col-form-label">Logistic</label>
                                    <select class="form-control" name="logistic_name" id="logistic_id">
                                        <option value="">Select Logistic</option>
                                        @foreach ($logistics as $logistic)
                                        <option value="{{ $logistic->name }}" {{ old('logistic_id') == $logistic->id ? 'selected' : '' }}>
                                            {{ $logistic->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="booking_code" class="col-form-label">Booking Code</label>
                                    <input type="text" class="form-control" name="booking_code" value="{{ old('booking_code') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        var storageBaseUrl = "{{ asset('storage/') }}";
        // Fungsi untuk menangani pencarian product
        $('#searchInputproduct').keyup(function() {
            var query = $(this).val().trim();

            if (query.length < 3) {
                $('#searchResults').empty().hide();
                $('#staticProducts').show();
                return;
            }

            $.ajax({
                url: '/search-products',
                type: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#searchResults').empty();

                    if (data.length > 0) {
                        var html = '';
                        $.each(data, function(index, product) {
                            html += `<div class="col-md-6">
                                                                <div class="d-flex align-items-start">
                                                                    <input type="checkbox" name="checked_items[]" class="checkItem large-checkbox mr-2">
                                                                    <div>
                                                                        <h5 class="card-title d-inline">${product.name}</h5>
                                                                        <img src="${storageBaseUrl}/${product.photo1}" style="width: 30%; height: auto; display: block; margin-top: 10px;" class="rounded">
                                                                    </div>
                                                                </div>
                                                            </div>`;
                        });
                        // Replace the search results with new HTML and show them
                        $('#searchResults').html(html).show();
                        $('#staticProducts').hide(); // Hide the static products list
                    } else {
                        // Show a message if no products are found and hide the static products list
                        $('#searchResults').html('<p>No products found.</p>').show();
                        $('#staticProducts').hide();
                    }
                },
                error: function(request, status, error) {
                    $('#searchResults').html('<p>Error fetching search results.</p>').show();
                    $('#staticProducts').hide();
                }
            });
        });


        $('#staticProducts, #searchResults').on('change', '.checkItem', function() {
            const productId = $(this).val();
            const productName = $(this).closest('.d-flex').find('.card-title').text();
            const isChecked = $(this).is(':checked');

            if (isChecked) {
                // Add the product to the list in col-4
                const listItem = $('<li></li>').text(productName).attr('id', 'product-' + productId);
                $('#selectedProductsList').append(listItem);
            } else {
                // Remove the product from the list in col-4
                $('#product-' + productId).remove();
            }
        });

        $('#submitModal').click(function() {
            $('#selectedProductsList li').each(function() {
                var productName = $(this).text();
                var productId = $(this).attr('id').replace('product-', '');

                var newRow = `
                <tr>
                    <td>${productName}</td>
                    <td class="qty-input">

                                    <button type="button" class="btn btn-outline-primary minus-btn" data-id="${productId}">-</button>
                                    <input type="hidden" name="product_id[]" class="form-control" value="${productId}">
                                    <input type="text" name="productqty[]" id="qtyupdate${productId}" class="form-control" value="1">
                                    <button type="button" class="btn btn-outline-primary plus-btn" data-id="${productId}">+</button>

                                </td>
                    <td></td>
                </tr>
            `;


                $('#product-main tbody').append(newRow);
            });
            $('#myModal').modal('hide');
            $('#selectedProductsList').empty();

        });


        // Fungsi untuk menangani pencarian packaging
        $('#searchInputpackaging').keyup(function() {
            var query = $(this).val();
            if (query.length < 3) {
                return;
            }
            $.ajax({
                url: '/search-packagings',
                type: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    console.log(data)

                    if (data.length > 0) {
                        var html = '';
                        $.each(data, function(index, packaging) {

                            if ($('#packaging-table td:contains(' + packaging.id + ')').length === 0) {
                                html += `<tr>
                            <td>${packaging.name}</td>
                            <td>${packaging.price}</td>
                            <td class="qty-input">

                                    <button type="button" class="btn btn-outline-primary minus-btn" data-id="${packaging.id}">-</button>
                                    <input type="hidden" name="packaging_id[]" class="form-control" value="${packaging.id}">
                                    <input type="text" name="packaging_qty[]" id="qtyupdate${packaging.id}" class="form-control" value="1">
                                    <button type="button" class="btn btn-outline-primary plus-btn" data-id="${packaging.id}">+</button>

                                </td>
                            <td></td>
                            <td>
                                <button type="button" class="remove-packaging btn btn-danger btn-sm">
                                    <i class="fas fa fa-trash"></i>
                                </button>
                            </td>

                        </tr>`;
                            }
                        });
                        // Append the new HTML to the existing results
                        $('#searchResultspackaging').append(html);
                    }
                },
                error: function(request, status, error) {
                    $('#searchResultspackaging').html('<p>Error fetching search results.</p>');
                }
            });
        });
        $('#searchResultspackaging').on('click', '.remove-packaging', function() {
            $(this).closest('tr').remove();
        });


        $(document).on('click', '.minus-btn', function() {
            const id = $(this).data('id');
            const input = $('#qtyupdate' + id);
            let currentValue = parseInt(input.val(), 10);
            if (isNaN(currentValue) || currentValue <= 0) {
                currentValue = 1; // Initialize with a default value of 1 if not set or negative
            }
            if (currentValue > 1) { // Prevents quantity from going below 1
                input.val(currentValue - 1);
            }
        });

        // Event delegation for plus button
        $(document).on('click', '.plus-btn', function() {
            const id = $(this).data('id');
            const input = $('#qtyupdate' + id);
            let currentValue = parseInt(input.val(), 10);
            if (isNaN(currentValue)) {
                currentValue = 0; // Initialize with 0 if the current value isn't a number
            }
            input.val(currentValue + 1);
        });


    });
</script>
@endsection