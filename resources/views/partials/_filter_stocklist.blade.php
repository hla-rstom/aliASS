<form action="{{ route('stocklist') }}" method="GET">
    <input type="hidden" name="tab" value="summary">
    <div class="d-flex align-items-end justify-content-around" style="align-items: end;width: 80%">
        <div class="d-flex flex-column">
            <label for="">Choose Product</label>
            <select id="product-search" style="width: 12rem" class="custom-select select2" name="product_id" name="product_id"></select>

        </div>
        <div class="form-group mb-0">
            <label for="start_date">Start Date</label>
            <div class="input-group text-right">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="date" class="form-control" name="start_date" id="start_date" aria-describedby="basic-addon1" value="{{ now()->format('Y-m-d') }}">
            </div>
        </div>
        <div class="form-group mb-0">
            <label for="end_date">End Date</label>
            <div class="input-group text-right">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="date" class="form-control" name="end_date" id="end_date" aria-describedby="basic-addon1" value="{{ now()->format('Y-m-d') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary text-light">Show</button>
    </div>
</form>

<script type="text/javascript">
    $('#dateRange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $('#product-search').select2({
        placeholder: 'Search product',
        ajax: {
            url: '/search-products',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 1
    });

    $(function() {
        $('input[name="date_range"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                'YYYY-MM-DD'));
        });

        $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>