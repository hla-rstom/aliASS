<div class="tab-pane fade" id="InProcess" role="tabpanel" aria-labelledby="InProcess-tab">
    <div class="row ml-4">
        <div class="col-lg-12">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No Transaction</th>
                        <th scope="col">Date</th>
                        <th scope="col">Store Name</th>
                        <th scope="col">Marketplace</th>
                        <th scope="col">Total Invoice</th>
                        <th scope="col">Logistic</th>
                        <th scope="col">No AWB</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions['3'] as $transaction)
                    <tr>
                        <td data-toggle="modal" data-target="#detail{{ $transaction->id }}">
                            <b class="text-primary">{{ $transaction->invoice_code }}</b>
                        </td>
                        <td> {{ $transaction->date }} </td>
                        <td>{{ $transaction->marketplacestore->shop_name ?? '' }}</td>
                        <td>{{ $transaction->marketplacestore->driver ?? '' }}</td>
                        <td>{{$transaction->currency}} {{ $transaction->payment->total_transaction ?? '' }}</td>
                        <td>{{ $transaction->logisticransaction->shipping_carrier ?? '' }}</td>
                        <td>{{ $transaction->logisticransaction->tracking_no ?? '' }}</td>
                        <td>{{ $transaction->status_order ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-4">

                {!! $transactions['3']->appends(['tab' => 'InProcess'])->links() !!}

            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {
        $('.close-top-modal').click(function() {
            $('#addproduct').modal('hide');
        });

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
                                <div class="row">
                                    <button type="button" class="btn btn-outline-primary minus-btn" data-id="${productId}">-</button>
                                    <input type="hidden" name="product_id[]" class="form-control" value="${productId}">
                                    <input type="text" name="productqty[]" id="qtyupdate${productId}" class="form-control col-md-3" value="1">
                                    <button type="button" class="btn btn-outline-primary plus-btn" data-id="${productId}">+</button>
                                </div>
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
                                <div class="row">
                                    <button type="button" class="btn btn-outline-primary minus-btn" data-id="${packaging.id}">-</button>
                                    <input type="hidden" name="packaging_id[]" class="form-control" value="${packaging.id}">
                                    <input type="text" name="packaging_qty[]" id="qtyupdate${packaging.id}" class="form-control col-md-3" value="1">
                                    <button type="button" class="btn btn-outline-primary plus-btn" data-id="${packaging.id}">+</button>
                                </div>
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