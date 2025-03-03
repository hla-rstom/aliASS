<!-- Modal Mapping -->

    <div class="modal fade" id="productMappingModal" tabindex="-1" role="dialog" aria-labelledby="productMappingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productMappingModalLabel"> Pull Product Marketplace</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                <form action="{{ route('mappingproduct') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" id="selectedProductId">

                    <div class="row">
                        <!-- Product Selection Section -->
                        <div class="col-md-6">
                            <h6>Choose product</h6>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="searchProduct" placeholder="Search here...">
                            </div>
                            <div class="table-wrapper scrollable-table">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Store</th>
                                            <th>SKU</th>
                                        </tr>
                                    </thead>
                                    <tbody id="resultMapping">
                                        @foreach($products as $product)
                                        @php

                                        $mappedCount = $product->mappings->count();
                                        $images = json_decode($product->image, true);
                                        @endphp
                                        <tr data-product-id="{{$product->id}}">
                                            <td class=" text-center">
                                                <input type="checkbox" name="mapped_product_ids[]" class="checkItem large-checkbox" style="transform: scale(1.5);" value="{{ $product->id }}">
                                            </td>
                                            <td>
                                                @if (!empty($images) && is_array($images) && !empty($images[0]))
                                                <img src="{{ asset($images[0]) }}" alt="Main Photo" style="width: 50px; height: auto;">
                                                @else
                                                <span>No Photo</span>
                                                @endif


                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                @if ($product->mappings->isNotEmpty())
                                                @foreach ($product->mappings as $mapping)
                                                {{ $mapping->store->shop_name ?? 'Unknown Shop' }} - {{ $mapping->store->driver ?? 'Unknown Driver' }} <br>
                                                @endforeach
                                                @elseif ($product->store)
                                                {{ $product->store->shop_name ?? 'Unknown Shop' }} - {{ $product->store->driver ?? 'Unknown Driver' }} <br>
                                                @else


                                                <span> No shops available</span>
                                                @endif

                                            </td>
                                            <td>{{ $product->sku }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Mapped Products Section -->
                        <div class="col-md-6">
                            <h6>Mapping Product</h6>
                            <div class="table-wrapper scrollable-table">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Store</th>
                                            <th>SKU</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="mappedProducts">
                                        <!-- Mapped products will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Mapping Products</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-xl {
        max-width: 90%;
    }

    .scrollable-table {
        max-height: 400px;
        overflow-y: auto;
    }
</style>

<script>
    $(document).ready(function() {
        let selectedProductId;

        // Load modal with mapped products
        $(document).on('click', '[data-toggle="modal"]', function() {
            selectedProductId = $(this).data('product-id');
            $('#selectedProductId').val(selectedProductId);

            $.ajax({
                url: '/get-mapped-products/' + selectedProductId,
                type: 'GET',
                success: function(data) {
                    let html = '';
                    if (data.length === 0) {
                        html = '<tr><td colspan="5" class="text-center">No mapped products yet.</td></tr>';
                    } else {
                        $.each(data, function(index, mapping) {
                            let product = mapping.product;
                            let images = product.image;
                            let imageHtml = images && Array.isArray(images) && images.length > 0 ? `<img src="${images[0]}" alt="Main Photo" style="width: 50px; height: auto;">` : 'No Photo';
                            var uniqueShops = [];

                            // Process unique shop names if mappings are available
                            if (product.mappings && product.mappings.length > 0) {
                                const shopMap = new Map();

                                // Collect unique shops by shop_name
                                product.mappings.forEach(mapping => {
                                    if (mapping.store && !shopMap.has(mapping.store.shop_name)) {
                                        shopMap.set(mapping.store.shop_name, mapping.store);
                                    }
                                });

                                // Convert the map values to an array
                                uniqueShops = Array.from(shopMap.values());
                            }

                            // Determine the store info string based on unique shops or single store
                            var storeInfo;
                            if (uniqueShops.length > 0) {
                                storeInfo = uniqueShops.map(store => `${store.shop_name || 'Unknown Shop'} - ${store.driver || 'Unknown Driver'}`).join('<br>');
                            } else if (product.store) {
                                storeInfo = `${product.store.shop_name || 'Unknown Shop'} - ${product.store.driver || 'Unknown Driver'}`;
                            } else {
                                storeInfo = '<span>No shops available</span>';
                            }
                            

                            html += `<tr data-shop-id="${mapping.shop_id}" data-product-id="${product.id}">
                            <td>${imageHtml}</td>
                            <td>${product.name || 'No Name Available'}</td>
                            <td class="col-md-3">${storeInfo}</td>
                            <td>${product.sku}</td>
                            <td>
                                <input type="hidden" name="existing_mapped_product_ids[]" value="${product.id}">
                                <button type="button" class="btn btn-danger btn-sm unmapProduct">Unmapping</button>
                            </td>
                        </tr>`;
                        });
                    }
                    $('#mappedProducts').html(html);

                    // Update checkboxes in search results
                    updateSearchResultCheckboxes();
                },
                error: function() {
                    $('#mappedProducts').html('<p>An error occurred while loading mapped products.</p>');
                }
            });
        });

        function updateSearchResultCheckboxes() {
            // Uncheck all checkboxes first
            $('#resultMapping .checkItem').prop('checked', false);

            // Check the boxes for mapped products
            $('#mappedProducts tr').each(function() {
                let productId = $(this).data('product-id');
                $(`#resultMapping tr[data-product-id="${productId}"] .checkItem`).prop('checked', true);
            });
        }

        // Handle checkbox click event for mapping
        $(document).on('change', '.checkItem', function() {
            let row = $(this).closest('tr');
            let productId = row.data('product-id');

            // Ensure productId is defined before proceeding
            if (productId !== undefined && $(this).is(':checked')) {
                // Check if this product ID has already been added
                if ($(`#mappedProducts tr[data-product-id="${productId}"]`).length === 0) {
                    // Clone the row, remove the checkbox cell, and append to the mapped products table
                    let clonedRow = row.clone();
                    clonedRow.find('td:first').remove(); // Remove the checkbox cell
                    clonedRow.append('<td><button type="button" class="btn btn-danger btn-sm unmapProduct">Unmapping</button></td>');
                    clonedRow.appendTo('#mappedProducts');
                }
            } else {
                // Remove the row in mapped products table
                $(`#mappedProducts tr[data-product-id="${productId}"]`).remove();
            }
        });

        // Handle unmapping (remove product from mapped list)
        $(document).on('click', '.unmapProduct', function() {
            let row = $(this).closest('tr');
            let productId = row.data('product-id');

            // Remove only the row that corresponds to the clicked unmap button
            row.remove();

            // Uncheck the corresponding checkbox in the search results
            $(`#resultMapping tr[data-product-id="${productId}"] .checkItem`).prop('checked', false);
        });

        // Ensure all mapped product IDs are included in the form submission
        $('#mappingForm').on('submit', function() {
            // Enable all hidden inputs to ensure they are sent with the form
            $('#mappedProducts input[name="mapped_product_ids[]"]').prop('disabled', false);
        });

        // Search functionality
        $('#searchProduct').keyup(function() {
            var query = $(this).val();
            $.ajax({
                url: '/search-sku',
                type: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    if (data.length === 0) {
                        var noDataHtml = `<tr>
                        <td colspan="5" class="text-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="/storage/images/1705557639_nodata.jpg" alt="No Data Available">
                                    <h5>There is no Product yet</h5>
                                    <p>Let's create your Product.</p>
                                </div>
                            </div>
                        </td>
                    </tr>`;
                        $('#resultMapping').html(noDataHtml);
                    } else {
                        var html = '';
                        $.each(data, function(index, product) {
                            var images = typeof product.image === 'string' ? JSON.parse(product.image) : product.image;
                            var uniqueShops = [];

                            // Process unique shop names if mappings are available
                            if (product.mappings && product.mappings.length > 0) {
                                const shopMap = new Map();

                                // Collect unique shops by shop_name
                                product.mappings.forEach(mapping => {
                                    if (mapping.store && !shopMap.has(mapping.store.shop_name)) {
                                        shopMap.set(mapping.store.shop_name, mapping.store);
                                    }
                                });

                                // Convert the map values to an array
                                uniqueShops = Array.from(shopMap.values());
                            }

                            // Determine the store info string based on unique shops or single store
                            var storeInfo;
                            if (uniqueShops.length > 0) {
                                storeInfo = uniqueShops.map(store => `${store.shop_name || 'Unknown Shop'} - ${store.driver || 'Unknown Driver'}`).join('<br>');
                            } else if (product.store) {
                                storeInfo = `${product.store.shop_name || 'Unknown Shop'} - ${product.store.driver || 'Unknown Driver'}`;
                            } else {
                                storeInfo = '<span>No shops available</span>';
                            }

                            var imageHtml = images && images.length > 0 ? `<img src="${images[0]}" alt="Main Photo" style="width: 50px; height: auto;">` : 'No Photo';

                            html += `<tr data-product-id="${product.id}">
                                <td class="text-center">
                                    <input type="checkbox" name="mapped_product_ids[]" class="checkItem large-checkbox" style="transform: scale(1.5);" value="${product.id}">
                                </td>
                                <td>${imageHtml}</td>
                                <td>${product.name || 'No Name Available'}</td>
                                <td class="col-md-3">${storeInfo}</td>
                                <td>${product.sku}</td>
                            </tr>`;
                        });
                        $('#resultMapping').html(html);

                    }
                },
                error: function() {
                    $('#resultMapping').html('<p>An error occurred while searching.</p>');
                }
            });
        });
    });
</script>