@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')
    <h6 class="h3 mb-3 text-gray-800 ml-3">Stock List</h6>
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
            <button type="button" class="btn btn-outline-primary mr-2">
                <i class="fas fa-solid fa-download"></i> Download Stock
            </button>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="col-lg-12 mb-4">
                    <!-- Nav tabs -->
                    <div class="justify-content-between">
                        <ul class="nav nav-tabs col-md-4" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" id="stock-low-tab" data-toggle="tab" href="#stock-low" role="tab" aria-controls="stock-low" aria-selected="false">Stock Low</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="out-of-stock-tab" data-toggle="tab" href="#out-of-stock" role="tab" aria-controls="out-of-stock" aria-selected="false">Out of Stock</a>
                            </li> -->
                        </ul>
                    </div>
                    <form method="GET" action="{{ route('stock') }}">
                        <div class="form-row justify-content-end mt-4 mr-4">
                            <div class="form-group col-md-3">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" name="search" id="search-input" class="form-control" placeholder="Find..." aria-label="Cari" aria-describedby="basic-addon1" value="{{ request()->input('search') }}">
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Tab panes -->
                    <div class="tab-content mr-2">
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            <div class="row">

                                <div class="col-lg-12">
                                    <table class="table table-bordered" id="results-table">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="text-center">Product</th>
                                                <th colspan="2" class="text-center">Available Stock - Seller Data</th>
                                                <th colspan="2" class="text-center">Available Stock - Warehouse Data</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Normal</th>
                                                <th class="text-center">Reject</th>
                                                <th class="text-center">Normal</th>
                                                <th class="text-center">Reject</th>
                                            </tr>
                                        </thead>
                                        <tbody id="results-body">
                                            @foreach ($stocks as $stock)
                                            <tr>
                                                <td>{{$stock->name ?? ''}} <br>
                                                    <span class="text-primary"><b>{{$stock->sku ?? ''}} </b></span>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#stockModal{{$stock->id}}">{{$stock->stock ?? '0'}}</a></td>
                                                <td></td>
                                                <td>{{$stock->stock->qty ?? '0'}}</td>
                                                <td></td>
                                            </tr>
                                            <!-- Modal Upload Product -->
                                            <div class="modal fade" id="stockModal{{$stock->id}}" tabindex="-1" aria-labelledby="stockModalLabel{{$stock->id}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="row mt-4 mb-4 mr-4">
                                                                <h4 class="mb-2 mx-auto">Set your {{$stock->sku}} stock</h4>
                                                            </div>
                                                            <ul class="nav nav-tabs">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" id="stockin-tab{{$stock->id}}" data-toggle="tab" href="#stockin{{$stock->id}}">Stock In</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="stockout-tab{{$stock->id}}" data-toggle="tab" href="#stockout{{$stock->id}}">Stock Out</a>
                                                                </li>
                                                            </ul>

                                                            <div class="tab-content mt-4 ml-4">
                                                                <!-- Stock In Tab -->
                                                                <div class="tab-pane fade show active" id="stockin{{$stock->id}}">
                                                                    <h6 class="text-success text-center"><b>In</b></h6>
                                                                    <form action="{{ route('stockin') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="product_id" value="{{$stock->id}}">
                                                                        <div class="mb-3">
                                                                            <label for="qtyIn{{$stock->id}}" class="form-label">Qty</label>
                                                                            <input type="number" class="form-control" id="qtyIn{{$stock->id}}" name="qty" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="notesIn{{$stock->id}}" class="form-label">Notes</label>
                                                                            <textarea class="form-control" id="notesIn{{$stock->id}}" name="notes"></textarea>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </form>
                                                                </div>

                                                                <!-- Stock Out Tab -->
                                                                <div class="tab-pane fade" id="stockout{{$stock->id}}">
                                                                    <h6 class="text-danger text-center"><b>Out</b></h6>
                                                                    <form action="{{ route('stockout') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="product_id" value="{{$stock->id}}">
                                                                        <div class="mb-3">
                                                                            <label for="qtyOut{{$stock->id}}" class="form-label">Qty</label>
                                                                            <input type="number" class="form-control" id="qtyOut{{$stock->id}}" name="qty" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="notesOut{{$stock->id}}" class="form-label">Notes</label>
                                                                            <textarea class="form-control" id="notesOut{{$stock->id}}" name="notes"></textarea>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End modal -->


                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end mt-4" id="pagination-links">
                                        {!! $stocks->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="stock-low" role="tabpanel" aria-labelledby="stock-low-tab">

                        </div>
                        <div class="tab-pane fade" id="out-of-stock" role="tabpanel" aria-labelledby="out-of-stock-tab">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById('filter-dropdown').addEventListener('change', function() {
            var warehouseId = this.value;

            fetch(`/filter/${warehouseId}`)
                .then(response => response.json())
                .then(data => {
                    var tableBody = document.getElementById('results-table').querySelector('tbody');
                    tableBody.innerHTML = '';
                    console.log(data)
                    data.forEach(item => {
                        var row = `<tr>
                    <td>${item.product.name}</td>
                    <td>${item.product.stock}</td>
                    <td></td>
                    <td>${item.qty}</td>
                    <td></td>
                    
                </tr>`;
                        tableBody.innerHTML += row;
                    });
                });
        });

        document.getElementById('search-input').addEventListener('keyup', function() {
            let query = this.value;
            if (typeof query === 'string') {
                fetchResults(query);
            }
        });

        function fetchResults(query) {
            if (!query) return; // Ensure query is not empty or undefined
            fetch("{{ route('stock') }}?search=" + encodeURIComponent(query))
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const htmlDocument = parser.parseFromString(data, "text/html");
                    const newBody = htmlDocument.getElementById("results-body").innerHTML;
                    const newPagination = htmlDocument.getElementById("pagination-links").innerHTML;

                    document.getElementById("results-body").innerHTML = newBody;
                    document.getElementById("pagination-links").innerHTML = newPagination;

                    reinitializeModals();
                });
        }


        function reinitializeModals() {
            // Reinitialize any Bootstrap modals
            const modals = document.querySelectorAll('[data-toggle="modal"]');
            modals.forEach(modalTrigger => {
                modalTrigger.addEventListener('click', function() {
                    const target = this.getAttribute('data-target');
                    $(target).modal('show');
                });
            });
        }
    });
</script>
@endsection