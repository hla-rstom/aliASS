<form action="{{ route('product') }}" method="GET">
    <div class="form-row mt-4">
       
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
                            <input type="checkbox" class="marketplace" name="marketplaces[]" value="{{ $marketplace['driver'] }}" {{ $marketplace['is_checked'] ? 'checked' : '' }} /> {{ $marketplace['driver'] }}
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
                            <input type="checkbox" class="store" name="stores[]" value="{{ $store['id'] }}" {{ $store['is_checked'] ? 'checked' : '' }} /> {{ $store['shop_name'] }}
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group col-md-2">
            <label for="" class="mb-4" style="margin: 9;"></label><br>
            <div class="btn-group btn-block" role="group">
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
                <!-- Reset Button -->
                <a href="{{ route('product') }}" class="btn btn-secondary">
                    Reset
                </a>
            </div>
        </div>

        <div class="col-auto ml-auto">
                        <div class="input-group mt-4">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search here">
                        </div>
                    </div>
    </div>
</form>
<script type="text/javascript">

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

    
    
    
</script>
