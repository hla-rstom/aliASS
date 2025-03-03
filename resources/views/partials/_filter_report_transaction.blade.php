<form action="{{ route('transactionreport') }}" method="GET">
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="">Peroid</label><br>
            <input type="text" class="form-control" id="dateRange" name="date_range" placeholder="Search by Date">
        </div>
        <div class="form-group col-md-2">
            <label for="" class="mb-4" style="margin: 9;"></label><br>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Warehouse
                </button>
                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
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
                            <input type="checkbox" class="store" name="stores[]" value="{{ $store['id'] }}" {{ $store['is_checked'] ? 'checked' : '' }} /> {{ $store['shop_name'] }}
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-2">
            <label for="" class="mb-4" style="margin: 9;"></label><br>
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
            <label for="" class="mb-4" style="margin: 9;"></label><br>
            <a href="{{ route('transactionreport') }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>
<script type="text/javascript">
    $('#dateRange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
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

    $('#warehouseCheckboxes .warehouse').click(function() {
        if (false === $(this).prop("checked")) {
            $('#checkAllwarehouse').prop('checked', false);
        }
        if ($('#warehouseCheckboxes .warehouse:checked').length === $('#warehouseCheckboxes .warehouse').length) {
            $('#checkAllwarehouse').prop('checked', true);
        }
    });

    $(function() {
        $('input[name="date_range"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>
