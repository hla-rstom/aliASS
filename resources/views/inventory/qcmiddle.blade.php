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

    <h6 class="h3 mb-3 text-gray-800 ml-3">QC List</h6>
    <div class="row justify-content-between">
        <div class="col-lg-4">
            <div class="form-group col-md-8">
                <label for="">Choose Warehouse</label>
                <select class="form-control" id="filter-dropdown">
                    <option value="">-Choose-</option>
                    @foreach ($warehouses as $warehouse)
                    <option value="{{$warehouse->id}}"> {{$warehouse->name}} </option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="col-lg-6 text-right mt-4">
            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#requestQC">
                <i class="fas fa-solid fa-plus"></i> Create Request
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="requestQC" data-keyboard="false" tabindex="-1" aria-labelledby="requestQCLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestQCLabel">Create Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('storeqc') }}" method="POST" enctype="multipart/form-data" class="ml-3" id="productForm">
                        @csrf
                        <div class="form-group">
                            <label for="">Choose Warehouse</label>
                            <select class="form-control" id="filter-dropdown" name="warehouse_id">
                                <option value="">-Choose-</option>
                                @foreach ($warehouses as $warehouse)
                                <option value="{{$warehouse->id}}"> {{$warehouse->name}} </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product-search">Find Product</label>
                            <input type="text" class="form-control" id="searchInputproduct" placeholder="Product name/ SKU">
                        </div>
                        <table class="table table-borderless">
                            <thead class="thead-light">
                                <tr>
                                    <th><input type="checkbox" id="selectAll" class="large-checkbox" style="transform: scale(1.5);"></th>
                                    <th>Product Name</th>
                                    <th>Sku</th>
                                </tr>
                            </thead>
                            <tbody id="searchResults">

                            </tbody>
                        </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="col-lg-12 ml-4 mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Date</label><br>
                            <input type="text" class="form-control" id="dateRange" placeholder="Search by Date">

                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Filter</label>
                            <select class="form-control" id="select2-sort">
                                <option value="all">All</option>
                                <!-- Add other status options here -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row ml-4">
                    <div class="col-lg-11">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">QC Date</th>
                                    <th scope="col">Product Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requestQcs as $request )
                                <tr>
                                    <td>{{ $request->qc_date}}</td>
                                    <td>{{ $request->qty_sku}}</td>
                                    <td>{{$request->status}}</td>
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
<script type="text/javascript">
    $('#dateRange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });


    $('#searchInputproduct').keyup(function() {
        var query = $(this).val().trim();

        if (query.length < 3) {
            $('#searchResults').empty().hide();
            return;
        }

        $.ajax({
            url: '/search-products',
            type: 'GET',
            data: {
                query: query
            },
            success: function(data) {
                $('#searchResults').empty();

                if (data.length > 0) {
                    var html = '';
                    $.each(data, function(index, product) {
                        html += `<tr>
                                    <td><input type="checkbox" name="checked_items[]" value="${product.id}" class="checkItem large-checkbox" style="transform: scale(1.5);" onchange="updateQtySku();"></td>
                                    <td>${product.name}</td>
                                    <td>${product.sku}</td>
                                </tr>`;
                    });
                    $('#searchResults').html(html).show();
                } else {
                    $('#searchResults').html('<p>No products found.</p>').show();
                }
            },
            error: function(request, status, error) {
                $('#searchResults').html('<p>Error fetching search results.</p>').show();
            }
        });
    });

    updateQtySku = function() {
        var checkedItemsCount = $('.checkItem:checked').length;
        $('input[name="qty_sku"]').val(checkedItemsCount);
    };

    // Select or deselect all checkboxes
    $('#selectAll').click(function() {
        $('.checkItem').prop('checked', this.checked);
        updateQtySku();
    });
</script>

@endsection
