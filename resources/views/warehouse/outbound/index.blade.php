<style>
    .upload-box {
        border: 2px dashed #ccc;
        border-radius: 5px;
        text-align: center;
        padding: 10px;
        cursor: pointer;
    }

    .upload-box-content {
        display: block;
        margin: 0 auto;
        width: 440px;
        /* Adjust the size as needed */
        height: 200px;
        /* Adjust the size as needed */
        line-height: 200px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }

    .upload-box-content span {
        display: block;
        font-size: 0.875em;
        color: #6c757d;
    }

    #awbPicture {
        opacity: 0;
        position: absolute;
        z-index: -1;
        width: 0.1px;
        height: 0.1px;
    }

    #imageUploadBox {
        position: relative;
        overflow: hidden;
        background-size: cover;
        background-position: center;
        display: block;
        margin: 0 auto;
        width: 440px;
        /* Adjust the size as needed */
        height: 200px;
        /* Adjust the size as needed */
        line-height: 200px;
    }
</style>
@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <h6 class="h3 mb-3 text-gray-800 ml-3">Outbound</h6>

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs justify-content-between" id="orderTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link text-warning fw-bold" id="topick-tab" data-toggle="tab" href="#topick" role="tab" aria-controls="topick" aria-selected="true"><b>To Pick</b></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link text-warning fw-bold" id="picking-tab" data-toggle="tab" href="#picking" role="tab" aria-controls="picking" aria-selected="true"><b>Picking</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-warning fw-bold" id="packing-tab" data-toggle="tab" href="#packing" role="tab" aria-controls="packing" aria-selected="false"><b>Packing</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-warning fw-bold" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="false"><b>Shipping</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-warning fw-bold" id="sent-tab" data-toggle="tab" href="#sent" role="tab" aria-controls="sent" aria-selected="false"><b>Sent</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-warning fw-bold" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false"><b>Done</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-warning fw-bold" id="Returns-tab" data-toggle="tab" href="#Returns" role="tab" aria-controls="Returns" aria-selected="false"><b>Returns</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-warning fw-bold" id="outbound-tab" data-toggle="tab" href="#outbound" role="tab" aria-controls="outbound" aria-selected="false"><b>All Outbound</b></a>
        </li>
    </ul>

    <div class="col-lg-12 mt-4">
        <!--<div class="card shadow mb-3">-->
        <!--    <div class="card-body">-->
        <!--        <div class="col-lg-12 ml-4 mb-4">-->
        <!--            <div class="form-row mt-4">-->
        <!--                <div class="form-group col-md-4">-->
        <!--                    <label for="">Transaction Type</label>-->
        <!--                    <select class="form-control" id="select2-sort">-->
        <!--                        <option value="all">Date Inbound</option>-->
        <!-- Add other status options here -->
        <!--                    </select>-->
        <!--                </div>-->
        <!--                <div class="form-group col-md-4">-->
        <!--                    <label for="">Seller</label>-->
        <!--                    <select class="form-control" id="select2-sort">-->
        <!--                        <option value="all">Date Inbound</option>-->
        <!-- Add other status options here -->
        <!--                    </select>-->
        <!--                </div>-->
        <!--                <div class="form-group col-md-2">-->
        <!--                    <label class="mb-4" for=""></label>-->
        <!--                    <button type="button" class="btn btn-primary ml-4 btn-block">-->
        <!--                        <i class="fas fa-solid fa-search"></i>-->
        <!--                    </button>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
    </div>

    <div class="col-lg-12 mt-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <!-- Tab Content -->
                <div class="tab-content">
                    @include('partials.outbound_tab.to_pick')
                    @include('partials.outbound_tab.picking')
                    @include('partials.outbound_tab.packing')
                    @include('partials.outbound_tab.shipping')
                    @include('partials.outbound_tab.sent')
                    @include('partials.outbound_tab.done')
                    @include('partials.outbound_tab.return')
                    @include('partials.outbound_tab.outbound')
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
                $.ajax({
                    url: '/getstock',
                    type: 'GET',
                    data: {
                        query: query,
                        warehouse_id: warehouseId
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
                var html = '';
                $.each(data, function(index, item) {
                    html += `<tr>
                <td>${item.product.name} <br> ${item.product.sku}</td>
                <td>${item.qty}</td>
                <td>
                    <div class="col-md-6">
                        <input type="hidden" name="product_id[]" value="${item.product.id}">
                        <input type="number" name="qty[]" class="form-control">
                    </div>
                </td>
                <td></td>
                <td></td>
            </tr>`;
                });
                $('#searchResults').html(html);
            }



            $('#awbPicture').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imageUploadBox').css('background-image', 'url("' + e.target.result + '")');
                        $('.upload-box-content').hide();
                    }
                    reader.readAsDataURL(file);
                }
            });


        });
    </script>
    @endsection