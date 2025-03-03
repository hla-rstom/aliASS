<form action="{{ route('inbound') }}" method="GET">
    <div class="form-row mt-4">
        <div class="form-group col-md-2">
            <label for="">Periode</label>
            <select class="form-control" id="select2-periode" name="periode">
                <option value="Month">Month</option>
                <option value="Day">Day</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="" class="mb-4" style="margin: 9;"></label><br>
            <input type="text" class="form-control" id="dateRange" name="date_range" placeholder="Search by Date">
            <input type="month" class="form-control" id="month" name="month" placeholder="Search by Mont">
        </div>
        <div class="form-group col-md-1">
            <label class="mb-4" for=""></label>
            <button type="submit" class="btn btn-primary ml-4 btn-block">
                Submit
            </button>
        </div>
        <div class="form-group col-md-1">
            <label for="" class="mb-4" style="margin: 9;"></label><br>
            <a href="{{ route('inbound') }}" class="btn btn-secondary">Reset</a>
        </div>
        <div class="form-group col-md-3 ml-auto">
            <label for="" class="mb-4" style="margin: 9;"></label><br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Cari..." aria-label="Cari" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $('#dateRange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $('#dateRange').hide();
    $('#month').hide();

    // Listener for change event on the period dropdown
    $('[name="periode"]').change(function() {
        var selectedValue = $(this).val();

        // Check if 'Day' is selected
        if (selectedValue == 'Day') {
            $('#dateRange').show();
            $('#month').hide();
        }
        // Check if 'Month' is selected
        else if (selectedValue == 'Month') {
            $('#dateRange').hide();
            $('#month').show();
        }
        // If neither, or 'all' is selected
        else {
            $('#dateRange').hide();
            $('#month').hide();
        }
    });
</script>
