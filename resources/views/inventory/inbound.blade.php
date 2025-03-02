@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')
    <h6 class="h3 mb-3 text-gray-800 ml-3">Inbound</h6>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group col-md-8">
                <label for="">Choose Warehouse</label>
                <select class="form-control" id="warehouse-filter" name="warehouse_id">
                    <option value="">-Choose-</option>
                    @foreach ($warehouses as $warehouse)
                    <option value="{{$warehouse->id}}"> {{$warehouse->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-8 mt-4">
            <div class="row float-right mr-4">
                <button type="button" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#printBarcodeModal">
                    <i class="fas fa-solid fa-barcode"></i> Print Barcode
                </button>
                <a href="{{ route('exportInbound')}}" type="button" class="btn btn-outline-primary mr-2">
                    <i class="fas fa-solid fa-download"></i> Download Report
                </a>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Create Inbound
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('createinbound')}}">Send Stock</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#batchinbound">Batch Inbound</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Batch Inbound -->
    <div class="modal fade" id="batchinbound" tabindex="-1" aria-labelledby="batchinboundLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mt-4 mb-4">
                        <h4 class="text-primary mb-2 mx-auto">Upload Product</h4>
                    </div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-edit" id="uploadTab-edit" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link nav-link-edit active" id="download-tab-edit" data-toggle="tab" href="#download-pane-edit" role="tab" aria-controls="download" aria-selected="true">Download Template</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-edit" id="upload-tab-edit" data-toggle="tab" href="#upload-pane-edit" role="tab" aria-controls="upload" aria-selected="false">Upload File Template</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content tab-content-edit" id="uploadTabContent-edit">
                        <div class="tab-pane tab-pane-edit fade show active" id="download-pane-edit" role="tabpanel" aria-labelledby="download-tab-edit">
                            <!-- Content for Download Template tab -->
                            <form action="{{ route('exportBatchInbound') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                @csrf
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">Download Template</button>
                                </div>
                                <p>Please download the excel file template here to add Price Change Batches. Easy way to Import Price Change Batches.</p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane tab-pane-edit fade" id="upload-pane-edit" role="tabpanel" aria-labelledby="upload-tab-edit">
                            <form action="{{ route('importBatchInbound') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                @csrf
                                <div class="input-group mb-3 mt-4">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input-edit" id="inputFile-edit" name="file" aria-describedby="inputFileAddon">
                                        <label class="custom-file-label" for="inputFile-edit">Choose file</label>
                                    </div>
                                </div>
                                <p>Please select your Excel file (.xlsx) here. The system can only process the first 500 rows.</p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->

    <!-- Modal print barcode-->
    <div class="modal fade" id="printBarcodeModal" tabindex="-1" aria-labelledby="printBarcodeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printBarcodeModalLabel">Print Barcode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('postbarcode') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-auto ml-auto">
                                <div class="input-group">
                                    <input type="text" id="searchInputBarcode" class="form-control" placeholder="Search here">
                                </div>
                            </div>
                        </div>
                        <table id="productBarcode-table" class="table table-borderless table-striped mt-2" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody id="searchResultsBarcode">

                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Print</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- end modal -->
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="col-lg-12 ml-4 mb-4">
                    <!-- Navigation Tabs -->
                    <ul class="nav nav-tabs justify-content-between" id="orderTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="create-tab" data-toggle="tab" href="#create" role="tab" aria-controls="create" aria-selected="true">Create</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ship-tab" data-toggle="tab" href="#ship" role="tab" aria-controls="ship" aria-selected="false">Shipment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="accept-tab" data-toggle="tab" href="#accept" role="tab" aria-controls="accept" aria-selected="false">Receipt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="confirmed-tab" data-toggle="tab" href="#confirmed" role="tab" aria-controls="confirmed" aria-selected="false">Confirmed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">Done</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="cancel-tab" data-toggle="tab" href="#cancel" role="tab" aria-controls="cancel" aria-selected="false">Cancel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false">All</a>
                        </li>
                    </ul>
                    @include('partials._filter_inbound')
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="create" role="tabpanel" aria-labelledby="create-tab">
                        <div class="row ml-4">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Inbound Code</th>
                                            <th scope="col">Inbound Date</th>
                                            <th scope="col">Total Sku</th>
                                            <th scope="col">Total Qty</th>
                                            <th scope="col">Qc</th>
                                            <th scope="col">Total Cost</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inboundCreateDetails as $inbound)
                                        <tr>
                                            <td>{{ $inbound['inbound_id'] }}</td>
                                            <td>{{ $inbound['inbound_date'] }}</td>
                                            <td>{{ $inbound['totalProducts'] }}</td>
                                            <td>{{ $inbound['totalQty'] }}</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shipInbound"><i class="fas fa-solid fa-rocket"></i> Shipment</a>
                                                        <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#createInbound"><i class="fas fa-solid fa-truck"></i> Request Pickup</a> -->
                                                        <!-- Cancel Button -->
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cancelModal">
                                                            <i class="fas fa-solid fa-ban"></i> Cancel
                                                        </a>



                                                    </div>
                                                </div>

                                                <!-- Cancel Confirmation Modal -->
                                                <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="cancelModalLabel">Confirm Cancellation</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to cancel this inbound process?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <!-- Form for cancellation -->
                                                                <form method="POST" action="{{ route('cancelinbound', $inbound['inbound_id']) }}">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger">Confirm Cancel</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Modal Shipment -->
                                                <div class="modal fade" id="shipInbound" tabindex="-1" aria-labelledby="shipInboundLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <form id="form1" action="{{ route('shipinbound', $inbound['inbound_id'] ) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                                    @csrf
                                                                    <h5 class="font-weight-bold text-primary text-center mt-4 mb-4">Shipment Confirmation</h5>
                                                                    <div id="shipment_entries">

                                                                    </div>
                                                                    <div class="mt-2 mb-4">
                                                                        <button type="button" id="add_shipping_btn" class="btn btn-primary btn-block"><i class="fas fa-plus"></i></button>
                                                                    </div>
                                                                    <div class="card mb-4 mr-2 alert-warning">
                                                                        <div class="card-body">
                                                                            <p>Info : <br>
                                                                                Please input the shipping number and shipping company !
                                                                            </p>

                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ship" role="tabpanel" aria-labelledby="ship-tab">
                        <div class="row ml-4">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Inbound Code</th>
                                            <th scope="col">Inbound Date</th>
                                            <th scope="col">Total Sku</th>
                                            <th scope="col">Total Qty</th>
                                            <th scope="col">Shipment Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inboundShipDetails as $inbound)
                                        <tr>
                                            <td>{{ $inbound['inbound_id'] }}</td>
                                            <td>{{ $inbound['inbound_date'] }}</td>
                                            <td>{{ $inbound['totalProducts'] }}</td>
                                            <td>{{ $inbound['totalQty'] }}</td>
                                            <td>{{ $inbound['number_shipment'] }}</td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="accept" role="tabpanel" aria-labelledby="accept-tab">
                        <div class="row ml-4">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Inbound Code</th>
                                            <th scope="col">Inbound Date</th>
                                            <th scope="col">Total Sku</th>
                                            <th scope="col">Total Qty</th>
                                            <th scope="col">Shipment Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inboundAcceptDetails as $inbound)
                                        <tr>
                                            <td>{{ $inbound['inbound_id'] }}</td>
                                            <td>{{ $inbound['inbound_date'] }}</td>
                                            <td>{{ $inbound['totalProducts'] }}</td>
                                            <td>{{ $inbound['totalQty'] }}</td>
                                            <td>{{ $inbound['number_shipment'] }}</td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="confirmed" role="tabpanel" aria-labelledby="confirmed-tab">
                        <div class="row ml-4">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Inbound Code</th>
                                            <th scope="col">Inbound Date</th>
                                            <th scope="col">Total Sku</th>
                                            <th scope="col">Total Qty</th>
                                            <th scope="col">Shipment Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inboundConfirmDetails as $inbound)
                                        <tr>
                                            <td>{{ $inbound['inbound_id'] }}</td>
                                            <td>{{ $inbound['inbound_date'] }}</td>
                                            <td>{{ $inbound['totalProducts'] }}</td>
                                            <td>{{ $inbound['totalQty'] }}</td>
                                            <td>{{ $inbound['number_shipment'] }}</td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                        <div class="row ml-4">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Inbound Code</th>
                                            <th scope="col">Inbound Date</th>
                                            <th scope="col">Total Sku</th>
                                            <th scope="col">Total Qty</th>
                                            <th scope="col">Shipment Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inboundDoneDetails as $inbound)
                                        <tr>
                                            <td>{{ $inbound['inbound_id'] }}</td>
                                            <td>{{ $inbound['inbound_date'] }}</td>
                                            <td>{{ $inbound['totalProducts'] }}</td>
                                            <td>{{ $inbound['totalQty'] }}</td>
                                            <td>{{ $inbound['number_shipment'] }}</td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                        <div class="row ml-4">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Inbound Code</th>
                                            <th scope="col">Inbound Date</th>
                                            <th scope="col">Total Sku</th>
                                            <th scope="col">Total Qty</th>
                                            <th scope="col">Shipment Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inboundCancelDetails as $inbound)
                                        <tr>
                                            <td>{{ $inbound['inbound_id'] }}</td>
                                            <td>{{ $inbound['inbound_date'] }}</td>
                                            <td>{{ $inbound['totalProducts'] }}</td>
                                            <td>{{ $inbound['totalQty'] }}</td>
                                            <td>{{ $inbound['number_shipment'] }}</td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                        <div class="row ml-4">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Inbound Code</th>
                                            <th scope="col">Inbound Date</th>
                                            <th scope="col">Total Sku</th>
                                            <th scope="col">Total Qty</th>
                                            <th scope="col">Shipment Number</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inboundAllDetails as $inbound)
                                        <tr>
                                            <td>{{ $inbound['inbound_id'] }}</td>
                                            <td>{{ $inbound['inbound_date'] }}</td>
                                            <td>{{ $inbound['totalProducts'] }}</td>
                                            <td>{{ $inbound['totalQty'] }}</td>
                                            <td>{{ $inbound['number_shipment'] }}</td>
                                            <td>
                                                @if ($inbound['inbound_status'] == 1)
                                                <span class="text-secondary font-weight-bold">Waiting for shipment</span>
                                                @elseif ($inbound['inbound_status'] == 2)
                                                <span class="font-weight-bold" style="color: #0A1D56;">Waiting for receipt</span>
                                                @elseif ($inbound['inbound_status'] == 3)
                                                <span class="text-warning font-weight-bold">Already Receipt</span>
                                                @elseif ($inbound['inbound_status'] == 4)
                                                <span class="font-weight-bold" style="color: #3081D0;">Confirm calculation</span>
                                                @elseif ($inbound['inbound_status'] == 5)
                                                <span class="text-success font-weight-bold">Done</span>

                                                @elseif ($inbound['inbound_status'] == 6)
                                                <span class="text-danger font-weight-bold">Cancel</span>
                                                @else
                                                <span>Unknown Status</span>
                                                @endif
                                            </td>
                                            <!-- <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shipInbound"><i class="fas fa-solid fa-rocket"></i> Shipment</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#createInbound"><i class="fas fa-solid fa-truck"></i> Request Pickup</a>
                                                        <a class="dropdown-item" href="#"><i class="fas fa-solid fa-ban"></i> Cancel</a>
                                                    </div>
                                                </div>
                                            </td> -->
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#warehouse-dropdown').change(function() {
            var warehouseId = $(this).val();

            if (warehouseId) {
                $.ajax({
                    url: '/getstock',
                    type: 'GET',
                    data: {
                        id: warehouseId
                    },
                    dataType: 'json',
                    success: function(data) {
                        populateSearchResults(data);
                    },
                    error: function() {
                        $('#searchResults').html('<p>Error fetching warehouse data.</p>');
                    }
                });
            } else {
                $('#searchResults').empty();
            }
        });

        // Handle search within the selected warehouse's stock
        $('#searchInput').keyup(function() {
            var query = $(this).val();
            var warehouseId = $('#warehouse-dropdown').val();
            if (query.length < 3) { // You may want to start searching after 2 or more characters
                return; // Stop the function if the query is too short.
            }
            $.ajax({
                url: '/getstock',
                type: 'GET',
                data: {
                    query: query,
                    warehouse_id: warehouseId // assuming your API needs the warehouse ID
                },
                success: function(data) {
                    populateSearchResults(data);
                },
                error: function() {
                    $('#searchResults').html('<p>Error fetching search results.</p>');
                }
            });
        });

        // Function to populate search results
        function populateSearchResults(data) {
            // Tidak mengosongkan #searchResults untuk mempertahankan hasil sebelumnya
            var existingIds = $('#searchResults tr').map(function() {
                return $(this).data('productId'); // Asumsikan setiap tr memiliki data attribute 'data-productId'
            }).get();

            $.each(data, function(index, item) {
                // Mencegah penambahan duplikat
                if ($.inArray(item.product.id.toString(), existingIds) === -1) {
                    var isSelected = item.product.id == localStorage.getItem('selectedProductId'); // Cek apakah item terpilih
                    var html = `<tr data-productId="${item.product.id}" class="${isSelected ? 'selected' : ''}">
                <td>${item.product.name} <br> ${item.product.sku}</td>
                <td>${item.qty}</td>
                <td>
                    <div class="col-md-6">
                        <input type="hidden" name="product_id[]" value="${item.product.id}">
                        <input type="number" name="qty[]" class="form-control" ${isSelected ? 'value="someValue"' : ''}>
                    </div>
                </td>
                <td></td>
                <td></td>
                <td>
                    <button type="button" class="remove-product btn btn-danger btn-sm">
                        <i class="fas fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;
                    $('#searchResults').append(html); // Menambahkan ke daftar tanpa menghapus yang sudah ada
                }
            });
        }

        $('#searchResults').on('click', '.remove-product', function() {
            $(this).closest('tr').remove();
        });

        // Fungsi untuk menangani pencarian product barcode print
        $('#searchInputBarcode').keyup(function() {
            var query = $(this).val();
            if (query.length < 3) { // You may want to start searching after 2 or more characters
                return; // Stop the function if the query is too short.
            }
            $.ajax({
                url: '/search-products',
                type: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    // Check if new data is actually present
                    if (data.length > 0) {
                        var html = '';
                        $.each(data, function(index, product) {
                            // Ensure the product isn't already added
                            if ($('#productBarcode-table td:contains(' + product.sku + ')').length === 0) {
                                html += `<tr>
                            <td>${product.name}</td>
                            <td>
                                <div class="col-md-6">
                                    <input type="hidden" name="sku[]" value="${product.sku}">
                                    <input type="hidden" name="name[]" value="${product.name}">
                                    <input type="number" name="qty[]" class="form-control">
                                </div>
                            </td>
                            <td></td>
                            <td>
                                <button type="button" class="remove-productBarcode btn btn-danger btn-sm">
                                    <i class="fas fa fa-trash"></i>
                                </button>
                            </td>

                        </tr>`;
                            }
                        });
                        // Append the new HTML to the existing results
                        $('#searchResultsBarcode').append(html);
                    }
                },
                error: function(request, status, error) {
                    $('#searchResultsBarcode').html('<p>Error fetching search results.</p>');
                }
            });
        });
        $('#searchResultsBarcode').on('click', '.remove-productBarcode', function() {
            $(this).closest('tr').remove();
        });


        $('#warehouse-filter').change(function() {
            var warehouseId = $(this).val();
            // console.log(warehouseId);
            $.ajax({
                url: '/filterInbound',
                type: 'GET',
                data: {
                    warehouse_id: warehouseId
                },
                success: function(response) {

                    $('table tbody').html(response);
                },
                error: function(xhr, status, error) {

                    console.error(error);
                }
            });
        });

        $("#add_shipping_btn").click(function() {
            var shipmentEntryHtml = `
            <div class="shipment_entry">
                <div class="form-group mr-2">
                    <label class="col-form-label">Number Shipment</label>
                    <input type="text" class="form-control no_ship" name="no_ship[]">
                </div>
                <div class="form-group mr-2">
                    <label class="col-form-label">Shipping Company</label>
                    <input type="text" class="form-control shipping_company" name="shipping_company[]">
                </div>
                <button type="button" class="remove-packaging btn btn-danger btn-block">
                    <i class="fas fa-trash"></i>
                </button>
            </div>`;
            $("#shipment_entries").append(shipmentEntryHtml);
        });

        // Event delegation to handle click events on dynamically created remove buttons
        $("#shipment_entries").on('click', '.remove-packaging', function() {
            $(this).closest('.shipment_entry').remove();
        });
    });
</script>
@endsection