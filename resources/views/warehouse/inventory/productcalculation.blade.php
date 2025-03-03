<style>
    .qty-input {
        display: flex;
        align-items: left;
        justify-content: left;
    }

    .qty-input input {
        text-align: left;
        margin: 0 5px;
        width: 50px;
        /* You can adjust the width as needed */
    }

    .scrollable-table {
        max-height: 600px;
        overflow-y: auto;
    }

    .table-responsive {
        max-height: 450px;
        overflow-y: auto;
    }
</style>
@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row justify-content-between">
        <h6 class="h3 mb-3 text-gray-800 ml-3">Product Calculation</h6>
        <p><a href="{{ route('warehouseInbound') }}"><i class="fas fa-solid fa-chevron-left"></i> Inbound</a></p>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="tab-content col-md-12">
                    <div class="table-wrapper scrollable-table">
                        <table id="example" class="table table-borderless" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Sku</th>
                                    <th>Price</th>
                                    <th>Shipment Qty</th>
                                    <th>Receipt Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($inbounds && $inbounds->productinbound)
                                @foreach ($inbounds->productinbound as $productInbound)
                                <tr>
                                    <td>{{ $productInbound->product->name }}</td>
                                    <td>{{ $productInbound->product->sku }} - {{ $productInbound->variation?->model_sku }}</td>
                                    <td>{{ $productInbound->product->consumer_price ??  $productInbound->variation?->price }}</td>
                                    <td>{{ $productInbound->qty }}</td>
                                    <td class="qty-input">

                                        <button type="button" class="btn btn-outline-primary minus-btn" data-id="{{ $productInbound->id }}">-</button>
                                        <input type="text" name="qty[]" id="qtyupdate{{ $productInbound->id }}" class="form-control col-md-6" value="{{ $productInbound->qty }}">
                                        <button type="button" class="btn btn-outline-primary plus-btn" data-id="{{ $productInbound->id }}">+</button>

                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form action="{{ route('selectioncalculation',$inbounds->id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="text-center mt-4">
                                                <h6 class="font-weight-bold">Confirm Receipt of Goods</h6>
                                                <p>Inappropriate quantities will not be processed and will be entered into the next order.
                                                    <br>Inbound Code : <span class="font-weight-bold text-primary">{{ $inbounds->no_ship }}</span>
                                                </p>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Product Name</th>
                                                            <th>Sku</th>
                                                            <th>Shipment Qty</th>
                                                            <th>Receipt Qty</th>
                                                            <th>Difference</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="confirmationData">

                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <textarea class="form-control" rows="2" name="note" placeholder="Note"></textarea>
                                            @foreach ($productId as $key => $val )
                                            <input type="hidden" name="product_id[]" value="{{$val}}">
                                            <input type="hidden" name="inbound_id" value="{{$inbounds->id}}">

                                            @endforeach
                                            <button type="submit" class="btn btn-primary">Rejects Incorrect Data and Stores the Correct Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" id="btnConfirmation" class="btn btn-primary mt-4" data-toggle="modal" data-target="#confirmationModal">Confirmation Calculation</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        document.querySelectorAll('.minus-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const input = document.getElementById('qtyupdate' + id);
                let currentValue = parseInt(input.value, 10);
                // Check if currentValue is NaN, if so, initialize to 0
                if (isNaN(currentValue)) {
                    currentValue = 0;
                }
                if (currentValue > 0) {
                    input.value = currentValue - 1;
                }
            });
        });

        document.querySelectorAll('.plus-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const input = document.getElementById('qtyupdate' + id);
                let currentValue = parseInt(input.value, 10);
                // Check if currentValue is NaN, if so, initialize to 0
                if (isNaN(currentValue)) {
                    currentValue = 0;
                }
                input.value = currentValue + 1;
            });
        });

        $('#btnConfirmation').click(function() {
            var confirmationData = '';

            $('#example tbody tr').each(function() {
                var productName = $(this).find('td').eq(0).text();
                var sku = $(this).find('td').eq(1).text();
                var shipmentQty = parseInt($(this).find('td').eq(3).text()) || 0; // If NaN, default to 0
                var receiptQty = parseInt($(this).find('input[type="text"]').val()) || 0; // If NaN, default to 0 and ensure the input type is "text" as you have in your HTML
                var difference = shipmentQty - receiptQty;
                var differenceText = difference === 0 ? 'Match' : (difference > 0 ? 'Less ' + difference : 'More ' + Math.abs(difference));

                confirmationData +=
                    '<tr>' +
                    '<td>' + productName + '</td>' +
                    '<td>' + sku + '</td>' +
                    '<td>' + shipmentQty + '</td>' +
                    '<td>' + receiptQty + '</td>' +
                    '<td>' + differenceText + '</td>' +
                    '<td>' + '<input type="hidden" name="differenceText[]" value="' + differenceText + '">' +
                    '<input type="hidden" name="shipqty[]" value="' + shipmentQty + '">' + '</td>' +
                    '<input type="hidden" name="receiptqty[]" value="' + receiptQty + '">' + '</td>' +
                    '</tr>';
            });

            $('#confirmationData').html(confirmationData);
            $('#confirmationModal').modal('show');
        });


    });
</script>




@endsection