@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <h6 class="h3 mb-3 text-gray-800 ml-3">Stock Opname List</h6>
        <div class="row justify-content-between">
            <div class="col-lg-4">
                <div class="form-group col-md-8">
                    <label for="">Choose Warehouse</label>
                    <select class="form-control" id="filter-dropdown">
                        <option value="">-Choose-</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}"> {{ $warehouse->name }} </option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-lg-6 text-right mt-4">
                <button data-toggle="modal" data-target="#requestOpname" type="button" class="btn btn-primary mr-2">
                    <i class="fas fa-solid fa-plus"></i> Create Request
                </button>
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
                            <div class="form-group col-md-2">
                                <label for="">Filter</label>
                                <select class="form-control" id="select2-sort">
                                    <option value="all">All</option>
                                    <!-- Add other status options here -->
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">Status</label>
                                <select class="form-control" id="select2-sort">
                                    <option value="all">All</option>
                                    <!-- Add other status options here -->
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="" class="mb-4" style="margin: 9;"></label><br>
                                <div class="input-group text-right">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Find..." aria-label="Cari"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ml-4">
                        <div class="col-lg-11">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>

                                        <th scope="col">Reference</th>
                                        <th scope="col">So Date</th>
                                        <th scope="col">Product Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>Otto</td>
                                    </tr>
                                    <!-- Add other table rows here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="requestOpname" tabindex="-1" aria-labelledby="requestOpname" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Create Opname Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        When Stock Taking starts, you can still send transactions to the warehouse but the transaction will
                        only be processed by the warehouse after the Stock Taking process is complete
                    </div>

                    <div class="d-flex flex-column gap-2 gap-lg-0 flex-lg-row justify-content-lg-between">
                        <div class="d-flex flex-column">
                            <div class="form-group">
                                <label for="start_date" style="margin: 9;"></label><br>
                                <div class="input-group text-right">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control" name="start_date" id="start_date"
                                        aria-describedby="basic-addon1" value="{{ now()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <small>
                                *for opname request Day+2 minimal
                            </small>
                        </div>
                        <div class="d-flex flex-column">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" placeholder="note for warehouse" name="note" id="note" cols="30"
                                rows="5"></textarea>
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-group">
                            <label for="product"></label><br>
                            <div class="input-group text-right">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" name="product" id="product"
                                    placeholder="Product Name / SKU Number" value="">
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" data-field="0">
                                        <input class="form-control w-50" type="checkbox" name="check-all"
                                            id="check-all">
                                    </th>
                                    <th rowspan="2" data-field="1">
                                        <div class="th-inner ">Sku</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th rowspan="2" data-field="2">
                                        <div class="th-inner ">Nama produk</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th class="text-center" colspan="2">
                                        <div class="th-inner ">Stock Tersedia - Data Seller</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                </tr>
                                <tr>
                                    <th data-field="stock_normal">
                                        <div class="th-inner sortable both">Normal</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th data-field="stock_reject">
                                        <div class="th-inner sortable both">Reject</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5">
                                        SKU data is does'nt exists
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#dateRange').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    </script>
@endsection
