<div class="tab-pane fade" id="packing" role="tabpanel" aria-labelledby="packing-tab">
    <div class="row ml-4">
        <div class="col-lg-12">
            <p class="mb-3 text-large text-gray-800 ml-3"><b>Packing List</b></p>
            <table class="table" id="transactionTable">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Seller</th>
                        <th scope="col">Recipients</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions2 as $transaction )
                    <tr>
                        <td><i class="fas fa-solid fa-file-import"></i></td>
                        <td>{{$transaction->invoice_code}}</td>
                        <td>{{$transaction->currency}} {{$transaction->total_amount ?? ''}}</td>
                        <td>{{$transaction->seller->name ?? ''}}</td>
                        <td>{{ $transaction->recipientransaction->name ?? '' }}</td>
                        <td data-toggle="modal" data-target="#packing{{$transaction->id}}">
                            @switch($transaction->status)
                            @case(1)
                            <span class="badge badge-secondary">Not Picked</span>
                            @break
                            @case(2)
                            <button class="btn btn-warning">Ready to Pack</button>
                            @break
                            @case(3)
                            @case(4)
                            @case(5)
                            <span class="badge badge-success">
                                @if ($transaction->status == 3)
                                Packed
                                @elseif ($transaction->status == 4)
                                Request Pick Up
                                @else
                                Done
                                @endif
                            </span>
                            @break
                            @case(7)
                            <span class="badge badge-danger">Return</span>
                            @break
                            @default
                            <span class="badge badge-info">Unknown Status</span>
                            @endswitch
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            @foreach ($transactions2 as $transaction)
            <!-- Modal -->
            <div class="modal fade" id="packing{{ $transaction->id }}" tabindex="-1" aria-labelledby="packing{{ $transaction->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="packing{{ $transaction->id }}Label">Invoice: {{ $transaction->invoice_code }}</h5>
                            <div class="text-right">
                                <form action="{{ route('viewAwbdoc') }}" method="GET" target="_blank">
                                    <input type="hidden" name="ordersn" value="{{ $transaction->invoice_code }}">
                                    <button type="submit" class="btn btn-outline-warning">Print Label</button>
                                </form>
                                <!-- <button type="button" class="btn btn-outline-danger">Cancel Picking</button> -->
                            </div>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('packed', $transaction->id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Seller</label>
                                        <p>{{$transaction->seller->name ?? ''}}</p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="text-right">
                                            <label for=""></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Scan Packaging barcode" aria-label="Scan Packaging barcode" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>

                                            <th scope="col">Product Name</th>
                                            <th scope="col">Photo</th>
                                            <th scope="col">SKU</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction->producttransaction as $producttransaction )
                                        <tr>

                                            <td>{{$producttransaction->product->name ?? ''}} </td>
                                            <td>

                                                @php
                                                $product = $producttransaction->product;
                                                $images = $product ? json_decode($product->image, true) : asset('asset/img/default.png');
                                                @endphp

                                                @if (!empty($images) && is_array($images) && !empty($images[0]))
                                                <img src="{{ asset($images[0]) }}" alt="Main Photo" style="width: 50px; height: auto;">
                                                @else
                                                <span>No Photo</span>
                                                @endif


                                            </td>
                                            <td>{{$producttransaction->product->sku ?? ''}} </td>
                                            <td>{{$producttransaction->qty}}</td>
                                            <td>MYR {{ $transaction->total_amount }}</td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="row">
                                    <input type="text" class="form-control mb-3 searchPackaging" placeholder="Search Packaging">
                                    <button type="button" class="btn btn-warning mb-3 toggle-template">Use Template</button>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr class="single-packaging-headers">
                                            <th>Select</th>
                                            <th>Packaging</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                        <tr class="template-packaging-headers d-none">
                                            <th>Select</th>
                                            <th>Template</th>
                                            <th>Packaging</th>
                                            <th>Qty Packaging</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="packaging-materials"></tbody>
                                </table>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-warning">Done</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>
<script>
    let templateMode = false;

    $(document).ready(function() {
        fetchPackagingAndTemplates();

        $('.toggle-template').on('click', function() {
            templateMode = !templateMode;
            toggleHeaders(templateMode);
            fetchPackagingAndTemplates();
        });

        $('.searchPackaging').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.packaging-materials tr').each(function() {
                $(this).toggle($(this).text().toLowerCase().includes(searchTerm));
            });
        });

        $('.packaging-materials').on('click', '.plus-btn, .minus-btn', function() {
            const isAddition = $(this).hasClass('plus-btn');
            updateQuantity(this, isAddition ? 1 : -1);
        });

        $('.packaging-materials').on('change', '.select-material', function() {
            const $row = $(this).closest('tr');
            calculateRowTotal($row);
            calculateTotalPrice();
        });
    });

    function fetchPackagingAndTemplates() {
        $.ajax({
            url: '/getPackagingOptions',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Data received:', data);
                const $tableBody = $('.packaging-materials').empty();
                if (templateMode) {
                    addTemplateOptionsToTable(data.templateOptions, $tableBody);
                } else {
                    addSinglePackagingOptionsToTable(data.packagingOptions, $tableBody);
                }
            },
            error: function() {
                console.error('Error fetching data');
            }
        });
    }

    function addSinglePackagingOptionsToTable(options, $tableBody) {
        const rowsHtml = options.map(option => `
            <tr>
                <td><input type="checkbox" class="select-material" name="packaging_id[]" value="${option.id}"></td>
                <td>${option.packaging_name}</td>
                <td><button type="button" class="btn btn-outline-primary minus-btn">-</button>
                    <input type="number" class="form-control qty-input" name="qty[]" value="0" min="0" style="width: 60px; display: inline-block;">
                    <button type="button" class="btn btn-outline-primary plus-btn">+</button>
                </td>
                <td>${parseFloat(option.price).toFixed(2)}</td>
                <td class="row-total">0.00</td>
            </tr>`).join('');
        $tableBody.append(rowsHtml);
    }

    function addTemplateOptionsToTable(options, $tableBody) {
        Object.entries(options).forEach(([templateName, materials]) => {
            // Calculate the total quantity and price for the entire template
            let totalQty = 0;
            let totalPrice = 0;

            materials.forEach(material => {
                templateId = material.template_id;
                totalQty += parseInt(material.qty);
                totalPrice += parseFloat(material.price) * parseInt(material.qty);
            });

            // Add the first row with checkbox and template name
            $tableBody.append(`
            <tr>
                <td rowspan="${materials.length}"><input type="checkbox" class="select-material" name="template_id[]" value="${templateId}"></td>
                <td rowspan="${materials.length}">${templateName}</td>
                <td>${materials[0].packaging_name}</td>
                <td>${materials[0].qty}</td>
                <td>${parseFloat(materials[0].price).toFixed(2)}</td>
                <td>${(parseFloat(materials[0].price) * parseInt(materials[0].qty)).toFixed(2)}</td>
            </tr>
        `);

            // Add the remaining rows for materials under the template
            for (let i = 1; i < materials.length; i++) {
                const material = materials[i];
                $tableBody.append(`
                <tr>
                    <td>${material.packaging_name}</td>
                    <td>${material.qty}</td>
                    <td>${parseFloat(material.price).toFixed(2)}</td>
                    <td>${(parseFloat(material.price) * parseInt(material.qty)).toFixed(2)}</td>
                </tr>
            `);
            }

            // Optionally, add a summary row for the total quantity and price
            $tableBody.append(`
            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total</td>
                <td>${totalQty}</td>
                <td></td>
                <td><input type="hidden" name="total_price" value="${totalPrice.toFixed(2)}">${totalPrice.toFixed(2)}</td>
            </tr>
        `);
        });
    }

    function updateQuantity(button, delta) {
        const $row = $(button).closest('tr');
        const qtyInput = $row.find('.qty-input');
        let currentQty = Math.max(0, (parseInt(qtyInput.val()) || 0) + delta);
        qtyInput.val(currentQty);
        calculateRowTotal($row);
        calculateTotalPrice();
    }

    function calculateRowTotal($row) {
        const isChecked = $row.find('.select-material').is(':checked');
        const price = parseFloat($row.find('td').eq(-2).text()) || 0;
        const quantity = parseInt($row.find('.qty-input').val()) || 0;
        const total = isChecked ? (price * quantity) : 0;
        $row.find('.row-total').text(total.toFixed(2));
    }

    function calculateTotalPrice() {
        let total = 0;
        $('.row-total').each(function() {
            total += parseFloat($(this).text()) || 0;
        });
        $('.totalPrice').text(total.toFixed(2));
    }

    function toggleHeaders(isTemplate) {
        if (isTemplate) {
            $('.single-packaging-headers').addClass('d-none');
            $('.template-packaging-headers').removeClass('d-none');
            $('.toggle-template').text('Use Single Packaging');
        } else {
            $('.single-packaging-headers').removeClass('d-none');
            $('.template-packaging-headers').addClass('d-none');
            $('.toggle-template').text('Use Template');
        }
    }
</script>