<form action="{{ route('pricesetting') }}" method="GET">
    <div class="row ml-4 mb-4">
        <div class="form-group col-md-2">
            <label for="" class="mb-4" style="margin: 9;"></label><br>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Marketplaces
                </button>
                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                    <label class="dropdown-item text-truncate ml-2">
                        <input type="checkbox" id="checkAllmarketplace" /> Check All
                    </label>
                    <div id="marketplaceCheckboxes">
                        @foreach ($marketplaces as $marketplace)
                        <label class="dropdown-item text-truncate ml-2">
                            <input type="checkbox" class="marketplace" name="marketplaces[]" value="{{ $marketplace['id'] }}" {{ $marketplace['is_checked'] ? 'checked' : '' }} /> {{ $marketplace['driver'] }}
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-2">
            <label for="" class="mb-4" style="margin: 9;"></label><br>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Stores
                </button>
                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                    <label class="dropdown-item text-truncate ml-2">
                        <input type="checkbox" id="checkAllstore" /> Check All
                    </label>
                    <div id="storeCheckboxes">
                        @foreach ($stores as $store)
                        <label class="dropdown-item text-truncate ml-2">
                            <input type="checkbox" class="store" name="stores[]" value="{{ $store['shop_id'] }}" {{ $store['is_checked'] ? 'checked' : '' }} /> {{ $store['shop_name'] }}
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-1">
            <label class="mb-4" for=""></label>
            <button type="submit" class="btn btn-primary ml-2 btn-block">
                Submit
            </button>
        </div>
        <div class="form-group col-md-1 ml-2">
            <label for="" class="mb-4" style="margin: 9;"></label><br>
            <a href="{{ route('pricesetting') }}" class="btn btn-secondary">Reset</a>
        </div>
        <div class="col-auto ml-auto">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Search here">
            </div>
        </div>

    </div>
</form>
<script>
    $(document).ready(function() {
        var deleteProductBaseUrl = "{{ url('deleteproduct') }}";
        $('#searchInput').keyup(function() {
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
                    <td colspan="7" class="text-center">
                        <div class="card mb-3">
                            <div class="card-body">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="/storage/images/1705557639_nodata.jpg" alt="No Data Available">
                                <h5>There is no Product yet</h5>
                                <p>Let's create your Product.</p>
                                <a class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#addModal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Add Product</span>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>`;
                        $('#searchResults').html(noDataHtml);
                    } else {
                        var html = '';
                        $.each(data, function(index, product) {
                            var storeInfo = product.store ? `${product.store.shop_name || 'Unknown Shop'} - ${product.store.driver || 'Unknown Driver'}` : '<span>No shops available</span>';
                            var images = typeof product.image === 'string' ? JSON.parse(product.image) : product.image;
                            var imageHtml = images && images.length > 0 ? `<img src="${images[0]}" alt="Main Photo" style="width: 50px; height: auto;">` : 'No Photo';

                            // Access the mapping count directly from the product object
                            var mappedCount = product.mappings_count;

                            html += `<tr>
                                            
                                            <td>${imageHtml}</td>
                                            <td>${product.name} <br>SKU : ${product.sku} </td>
                                            <td>${product.consumer_price}</td>
                                            <td>
                                                <div class="row">
                                                    Last Updated <br> ${product.updated_at}
                                                </div>
                                            </td>
                                            
                                        </tr>`;
                        });





                        $('#searchResults').html(html);
                    }
                },
                error: function(request, status, error) {
                    $('#searchResults').html('<p>An error occurred while searching.</p>');
                }
            });
        });


        $('#checkAllstore').click(function() {
            $('#storeCheckboxes .store').prop('checked', this.checked);
        });

        $('#storeCheckboxes .store').click(function() {
            if (false === $(this).prop("checked")) {
                $('#checkAllstore').prop('checked', false);
            }
            if ($('#storeCheckboxes .store:checked').length === $('#storeCheckboxes .store').length) {
                $('#checkAllstore').prop('checked', true);
            }
        });
        $('#checkAllmarketplace').click(function() {
            $('#marketplaceCheckboxes .marketplace').prop('checked', this.checked);
        });

        $('#marketplaceCheckboxes .marketplace').click(function() {
            if (false === $(this).prop("checked")) {
                $('#checkAllmarketplace').prop('checked', false);
            }
            if ($('#marketplaceCheckboxes .marketplace:checked').length === $('#marketplaceCheckboxes .marketplace').length) {
                $('#checkAllmarketplace').prop('checked', true);
            }
        });

        $('#checkAllwarehouse').click(function() {
            $('#warehouseCheckboxes .warehouse').prop('checked', this.checked);
        });
    });
</script>