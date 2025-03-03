<style>
    .scrollable-table {
        max-height: 400px;
        overflow-y: auto;
    }
</style>
<h6 class="mt-4"><b>Select products to be sent to the warehouse</b></h6>
<div class="row mt-4">
    <div class="col-auto ml-auto">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">+ Add Product</button>
    </div>
</div>
<div class="table-wrapper scrollable-table">
<table id="product-main" class="table table-borderless table-striped mt-2" style="width:100%">
    <thead>
        <tr>
            <th>Sku</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Qc</th>
            <th>Expired</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
</div>
<!-- Modal Product Add-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
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
                    <div class="justify-content-end">
                        <button id="submitModal" type="button" class="btn btn-primary" data-dismiss="modal">Add</button>
                        <button type="button" class="btn btn-secondary">Close</button>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-11">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" id="checkAll" class="large-checkbox mr-2" style="transform: scale(1.5);"> 
                                                        Product
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="productTableBody">
                                                @foreach ($products as $product)
                                                    @php
                                                        $images = json_decode($product->image, true);
                                                    @endphp  
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-start">
                                                                <input type="checkbox" name="checked_items[]" class="checkItem large-checkbox mr-2" style="transform: scale(1.5);" value="{{ $product->id }}" data-stock_seller="{{ $product->stock }}">
                                                                <div>
                                                                    <h5 class="card-title d-inline">{{ $product->name }}</h5>
                                                                    <p>SKU: {{ $product->sku ?? '' }} <br>
                                                                        <b class="text-primary">Stock Seller: {{ $product->stock ?? '' }}</b>
                                                                    </p>
                                                                    @if (!empty($images) && is_array($images) && !empty($images[0]))
                                                                        <img src="{{ asset($images[0]) }}" alt="Main Photo" style="width: 50px; height: auto;">
                                                                    @else
                                                                        <span>No Photo</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row" id="searchResults" style="display: none;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        var selectedProducts = {}; 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#searchInputproduct').keyup(function() {
            var query = $(this).val().trim();
            console.log('Input value:', query); // Debugging: check the input value

            if (query.length < 3) {
                $('#searchResults').empty().hide();
                $('#productTableBody').show(); // Show original products if query is too short
                return;
            }

            $.ajax({
                url: '/search-products',
                type: 'GET',
                data: { query: query },
                success: function(data) {
                    console.log('AJAX success, data received:', data); // Debugging: check the response data
                    $('#searchResults').empty();

                    if (data.length > 0) {
                        var html = '';
                        $.each(data, function(index, product) {
                            console.log('Processing product:', product); // Debugging: check each product object

                            try {
                                if (!product.name || !product.sku || !product.id) {
                                    console.warn('Missing product data:', product); // Warn if essential data is missing
                                    return; // Skip this product
                                }

                                var images = typeof product.image === 'string' ? JSON.parse(product.image) : product.image;
                                var imageHtml = images && images.length > 0 ? `<img src="${images[0]}" alt="Main Photo" style="width: 50px; height: auto;">` : 'No Photo';

                                html += `
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-start">
                                                        <input type="checkbox" name="checked_items[]" class="checkItem large-checkbox mr-2" style="transform: scale(1.5);" value="${product.id}">
                                                        <div>
                                                            <h5 class="card-title d-inline">${product.name}</h5>
                                                            <p>SKU: ${product.sku} <br>
                                                            <b class="text-primary">Stock Seller: ${product.stock || 'N/A'}</b>
                                                            </p>
                                                            <td>${imageHtml}</td>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                `;
                            } catch (error) {
                                console.error('Error building HTML for item:', index, product, error);
                            }
                        });

                        $('#searchResults').html(html).show();
                        $('#productTableBody').hide();
                    } else {
                        $('#searchResults').html('<p>No products found.</p>').show();
                        $('#productTableBody').hide();
                    }
                },
                error: function(request, status, error) {
                    console.error('AJAX error:', status, error); // Debugging: check for AJAX errors
                    $('#searchResults').html('<p>Error fetching search results.</p>').show();
                    $('#productTableBody').hide();
                }
            });
        });

        $('#checkAll').click(function() {
            var isChecked = $(this).is(':checked');
            $('.checkItem').prop('checked', isChecked);

            $('.checkItem').each(function() {
                var productId = $(this).val();

                if (isChecked) {
                    var productDetails = $(this).closest('.d-flex');
                    var productName = productDetails.find('.card-title').text();
                    var productSKU = productDetails.find('p').text().replace('SKU: ', '');

                    selectedProducts[productId] = {
                        productId: productId,
                        name: productName,
                        sku: productSKU
                    };
                } else {
                    delete selectedProducts[productId];
                }
            });
        });

        $('#submitModal').click(function() {
            var html = '';
            $('.checkItem:checked').each(function() {
                var productId = $(this).val();
                var productDetails = $(this).closest('.d-flex');
                var productName = productDetails.find('.card-title').text();
                var productSKU = productDetails.find('p').text().replace('SKU: ', '');
                var sellerStock = productDetails.find('b.text-primary').text().replace('Stock Seller: ', '') || 1;

                html += `
                <tr>
                    <td class="col-md-2">${productSKU}</td>
                    <td class="col-md-4">${productName}</td>
                    <td class="qty-input">
                        <button type="button" class="btn btn-outline-primary minus-btn" data-id="${productId}">-</button>
                        <input type="hidden" name="product_id[]" class="form-control col-md-2" value="${productId}">
                        <input type="number" name="qty[]" id="qtyupdate${productId}" class="form-control col-md-4" value="${sellerStock}">
                        <button type="button" class="btn btn-outline-primary plus-btn" data-id="${productId}">+</button>
                    </td>
                    <td></td>
                    <td></td>
                    <td><button type="button" class="btn btn-danger removeSelectedProducts"><i class="fas fa-trash"></i></button></td>
                </tr>
                `;
            });
            $('#product-main tbody').html(html);
            $('#exampleModal').modal('hide');
        });


        $(document).on('click', '.removeSelectedProducts', function() {
            var productId = $(this).closest('tr').find('.minus-btn').data('id');
            delete selectedProducts[productId]; // Remove from selectedProducts
            $(this).closest('tr').remove(); // Remove the row from the table
        });

        $(document).on('click', '.minus-btn', function() {
            const id = $(this).data('id');
            const input = $('#qtyupdate' + id);
            let currentValue = parseInt(input.val(), 10);
            if (isNaN(currentValue)) {
                currentValue = 0;
            }
            if (currentValue > 0) {
                input.val(currentValue - 1);
            }
        });

        $(document).on('click', '.plus-btn', function() {
            const id = $(this).data('id');
            const input = $('#qtyupdate' + id);
            let currentValue = parseInt(input.val(), 10);
            if (isNaN(currentValue)) {
                currentValue = 0;
            }
            input.val(currentValue + 1);
        });
    });
</script>
