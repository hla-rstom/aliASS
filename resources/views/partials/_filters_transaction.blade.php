<form action="{{ route('transaction') }}" method="GET">
    <div class="form-row mt-4">
        <!--<div class="form-group col-md-2">-->
        <!--    <label for="dateRange">Period</label><br>-->
        <!--    <input type="text" class="form-control" id="dateRange" name="date_range" placeholder="Search by Date">-->
        <!--</div>-->
        <div class="form-group col-md-2">
            <label for="warehouses" class="mb-4" style="margin: 9;"></label><br>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle btn-block" type="button" id="dropdownMenuButtonWarehouse" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Warehouse
                </button>
                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButtonWarehouse">
                    <label class="dropdown-item text-truncate ml-2">
                        <input type="checkbox" id="checkAllwarehouse" /> Check All
                    </label>
                    <div id="warehouseCheckboxes">
                        @foreach ($warehouses as $warehouse)
                        <label class="dropdown-item text-truncate ml-2">
                            <input type="checkbox" class="warehouse" name="warehouses[]" value="{{ $warehouse['id'] }}" {{ $warehouse['id'] ? 'checked' : '' }} /> {{ $warehouse['name'] }}
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-2">
            <label for="marketplaces" class="mb-4" style="margin: 9;"></label><br>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle btn-block" type="button" id="dropdownMenuButtonMarketplace" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Marketplaces
                </button>
                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButtonMarketplace">
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
            <label for="stores" class="mb-4" style="margin: 9;"></label><br>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle btn-block" type="button" id="dropdownMenuButtonStore" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Stores
                </button>
                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButtonStore">
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
        <div class="form-group col-md-2">
            <label for="search" class="mb-4" style="margin: 9;"></label><br>
            <div class="input-group justify-content-end">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" name="search" placeholder="Find..." aria-label="Cari" aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="form-group col-md-1">
            <label class="mb-4" for=""></label>
            <button type="submit" class="btn btn-primary ml-4 btn-block">
                Submit
            </button>
        </div>
        <div class="form-group col-md-1">
            <label for="reset" class="mb-4" style="margin: 9;"></label><br>
            <a href="{{ route('transaction') }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        

        $('#checkAllstore').click(function() {
            $('#storeCheckboxes .store').prop('checked', this.checked);
        });

        $('#storeCheckboxes .store').click(function() {
            if (!$(this).prop("checked")) {
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
            if (!$(this).prop("checked")) {
                $('#checkAllmarketplace').prop('checked', false);
            }
            if ($('#marketplaceCheckboxes .marketplace:checked').length === $('#marketplaceCheckboxes .marketplace').length) {
                $('#checkAllmarketplace').prop('checked', true);
            }
        });

        $('#checkAllwarehouse').click(function() {
            $('#warehouseCheckboxes .warehouse').prop('checked', this.checked);
        });

        $('#warehouseCheckboxes .warehouse').click(function() {
            if (!$(this).prop("checked")) {
                $('#checkAllwarehouse').prop('checked', false);
            }
            if ($('#warehouseCheckboxes .warehouse:checked').length === $('#warehouseCheckboxes .warehouse').length) {
                $('#checkAllwarehouse').prop('checked', true);
            }
        });
    });
    
    $(function() {
        $('#dateRange').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear'
            }
        });

        $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>
