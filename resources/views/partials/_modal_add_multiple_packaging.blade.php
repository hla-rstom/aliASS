<div class="row">
    <p><b>Packaging Materials</b></p>
    <div class="col-12">
        <div id="packaging-options" class="pt-3">
            @foreach ($transaction->packagingtransaction as $packagingtransaction)
            <div class="d-flex align-items-center justify-content-between mb-2">
                <button type="button" class="remove-packaging btn btn-danger btn-sm"> <i class="fas fa fa-trash"></i> </button>
                <div class="mr-2">
                    <select name="packaging_id[]" class="form-control packaging-type">
                        @foreach ($packagings as $packaging)
                        <option class="col-md-6" value="{{ $packaging->id }}" {{ $packaging->id == $packagingtransaction->packaging->id ? 'selected' : '' }}>{{ $packaging->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-outline-primary minus-btn" data-id="{{ $packagingtransaction->id }}">-</button>
                    <input type="text" name="qty[]" id="qtyupdate{{ $packagingtransaction->id }}" class="form-control col-md-4 mx-2" value="{{ $packagingtransaction->qty }}" readonly>
                    <button type="button" class="btn btn-outline-primary plus-btn" data-id="{{ $packagingtransaction->id }}">+</button>
                </div>
                <div>RM. <span class="price">{{ number_format($packagingtransaction->packaging->price) }}</span></div>
            </div>
            @endforeach
        </div>
        <button id="addMaterialPackaging" type="button" class="btn btn-primary mb-4 btn-block">+ Add Material Packaging</button>

    </div>
</div>
<!-- Modal packaging add-->
<div class="modal fade" id="addMaterialPackaging" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Packaging Materials</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-2">
                    <div class="col-auto ml-4">
                        <div class="input-group">
                            <input type="text" id="searchInputpackaging" class="form-control" placeholder="Search packaging here">
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <!-- Column 8 -->
                        <div class="col-8">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row" id="staticpackagings">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th><input type="checkbox" id="checkAll" class="large-checkbox mr-2" style="transform: scale(1.5);"> packaging</th>
                                                </tr>
                                            </thead>
                                            <tbody id="packagingTableBody">
                                                @foreach ($packagings as $packaging)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-start">
                                                            <input type="checkbox" name="checked_items[]" class="checkItem large-checkbox mr-2" style="transform: scale(1.5);" value="{{ $packaging->id }}">
                                                            <div>
                                                                <h5 class="card-title d-inline">{{ $packaging->name }}</h5>
                                                                <p>SKU: {{ $packaging->sku }}</p>
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

                        <!-- Column 4 -->
                        <div class="col-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <ul id="selectedpackagingsList"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary">Close</button>
                <button id="submitModal" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#searchInputpackaging').keyup(function() {
            var query = $(this).val().trim();

            if (query.length < 3) {
                $('#searchResults').empty().hide();
                $('#staticpackagings').show();
                return;
            }

            $.ajax({
                url: '/search-packagings',
                type: 'GET',
                data: {
                    query: query
                },
                success: function(data) {

                    $('#searchResults').empty();
                    if (data.length > 0) {
                        var html = '';
                        $.each(data, function(index, packaging) {
                            html += `
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">packaging</th>
                                    </tr>
                                </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-start">
                                            <input type="checkbox" name="checked_items[]" class="checkItem large-checkbox mr-2" style="transform: scale(1.5); value="${packaging.id}">
                                            <div>
                                                <h5 class="card-title d-inline">${packaging.name}</h5>
                                                <p>SKU: ${packaging.sku}</p>
                                                <img src="${photoPath}" style="width: 10%; height: auto; display: block; margin-top: 10px;" class="rounded">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                             `;
                        });
                        $('#searchResults').html(html).show();
                        $('#staticpackagings').hide();
                    } else {
                        $('#searchResults').html('<p>No packagings found.</p>').show();
                        $('#staticpackagings').hide();
                    }
                },
                error: function(request, status, error) {
                    $('#searchResults').html('<p>Error fetching search results.</p>').show();
                    $('#staticpackagings').hide();
                }
            });
        });

        $('#checkAll').click(function() {
            var isChecked = $(this).is(':checked');

            // Check or uncheck all checkboxes in #staticpackagings and #searchResults
            $('#staticpackagings .checkItem, #searchResults .checkItem').prop('checked', isChecked);

            // If checked, add all to selectedpackagingsList. If unchecked, clear the list.
            if (isChecked) {
                $('.checkItem:checked').each(function() {
                    var packagingId = $(this).val();
                    var packagingDetails = $(this).closest('.d-flex');
                    var packagingName = packagingDetails.find('.card-title').text();
                    var packagingSKU = packagingDetails.find('p').text().replace('SKU: ', '');
                    var listItem = $('<li></li>').text(`${packagingName} (SKU: ${packagingSKU})`).attr('id', 'packaging-' + packagingId);
                    $('#selectedpackagingsList').append(listItem);
                });
            } else {
                $('#selectedpackagingsList').empty();
            }
        });

        $('#staticpackagings, #searchResults').on('change', '.checkItem', function() {
            const packagingId = $(this).val();
            const packagingDetails = $(this).closest('.d-flex');
            const packagingName = packagingDetails.find('.card-title').text();
            const packagingSKU = packagingDetails.find('p').text().replace('SKU: ', '');
            const isChecked = $(this).is(':checked');

            if (isChecked) {
                const listItem = $('<li></li>').text(`${packagingName} (SKU: ${packagingSKU})`).attr('id', 'packaging-' + packagingId);
                $('#selectedpackagingsList').append(listItem);
            } else {
                $('#packaging-' + packagingId).remove();
            }
        });

        $('#submitModal').click(function() {
            $('#selectedpackagingsList li').each(function() {
                var packagingDetails = $(this).text().split(' (SKU: ');
                var packagingName = packagingDetails[0];
                var packagingSKU = packagingDetails[1].replace(')', '');
                var packagingId = $(this).attr('id').replace('packaging-', '');

                var newRow = `
        <tr>
            <td class="col-md-2">${packagingSKU}</td>
            <td class="col-md-4">${packagingName}</td>
            <td class="qty-input">
                <button type="button" class="btn btn-outline-primary minus-btn" data-id="${packagingId}">-</button>
                <input type="hidden" name="packaging_id[]" class="form-control" value="${packagingId}">
                <input type="number" name="qty[]" id="qtyupdate${packagingId}" class="form-control col-md-2">
                <button type="button" class="btn btn-outline-primary plus-btn" data-id="${packagingId}">+</button>
            </td>
            <td></td>
            <td></td>
        </tr>
        `;

                $('#packaging-main tbody').append(newRow);
            });
            $('#myModal').modal('hide');
            $('#selectedpackagingsList').empty();
        });


        $('#submitBoth').click(function(e) {
            e.preventDefault();

            // Cek apakah form kedua memiliki input yang diisi

            var hasInput = false;
            $('#form2 input[type="number"]').each(function() {
                if ($(this).val() !== '') {
                    hasInput = true;
                    return false; // break loop
                }
            });

            if (!hasInput) {
                // Tampilkan modal peringatan
                $('#warningModal').modal('show');
            } else {
                // Kirim data kedua form
                mergeAndSubmitForms();
            }
        });
    });

    // Event delegation for minus button
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

    // Event delegation for plus button
    $(document).on('click', '.plus-btn', function() {
        const id = $(this).data('id');
        const input = $('#qtyupdate' + id);
        let currentValue = parseInt(input.val(), 10);
        if (isNaN(currentValue)) {
            currentValue = 0;
        }
        input.val(currentValue + 1);
    });


    function mergeAndSubmitForms() {
        var form2Data = new FormData(document.getElementById('form2'));
        form2Data.forEach(function(value, key) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = value;
            document.getElementById('form1').appendChild(input);
        });
        document.getElementById('form1').submit();
    }
</script>
