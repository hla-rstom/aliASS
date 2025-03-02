@php
    use App\Models\StockMutation;
    $filters = array_unique(StockMutation::all()->pluck('type')->toArray());

@endphp
<form action="{{ route('stocklist') }}" method="GET">
    <input type="hidden" name="tab" value="history">
    <div class="d-flex align-items-end justify-content-around" style="width: 100%">
        <div class="d-flex flex-column">
            <label for="">Choose Product</label>
            <select id="product-search2" style="width: 12rem" class="custom-select select2" name="product_id"
                name="product_id"></select>
        </div>
        <div class="d-flex flex-column">
            <label for="">Filter</label>
            <select style="width: 12rem" class="select2" id="filter" name="filter">
                @foreach ($filters as $filter)
                    <option value="{{ $filter }}">{{ $filter }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-0">
            <label for="start_date" style="margin: 9;"></label><br>
            <div class="input-group text-right">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="date" class="form-control" name="start_date" id="start_date"
                    aria-describedby="basic-addon1" value="{{ now()->format('Y-m-d') }}">
            </div>
        </div>
        <div class="form-group mb-0">
            <label for="start_date" style="margin: 9;"></label><br>
            <div class="input-group text-right">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="date" class="form-control" name="end_date" id="end_date"
                    aria-describedby="basic-addon1" value="{{ now()->format('Y-m-d') }}">
            </div>
        </div>
        <button type="submit" class="btn bg-danger text-light">Show</button>
    </div>
</form>

<script type="text/javascript">
    $('#dateRange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $('#product-search2').select2({
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
