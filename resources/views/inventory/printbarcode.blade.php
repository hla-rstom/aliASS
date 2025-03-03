@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h6 class="h3 mb-3 text-gray-800 ml-3">Stock Opname List</h6>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="col-lg-12 ml-4 mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Choose Warehouse</label>
                            <select class="form-control" id="filter-dropdown">
                                <option value="">-Choose-</option>
                                @foreach ($warehouses as $warehouse)
                                <option value="{{$warehouse->id}}"> {{$warehouse->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Status</label>
                            <select class="form-control" id="select2-sort">
                                <option value="all">All</option>
                                <!-- Add other status options here -->
                            </select>
                        </div>
                        <div class="form-group col-md-2 text-right">
                            <label for="" class="mb-4" style="margin: 9;"></label><br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Find..." aria-label="Cari" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ml-4">
                    <div class="col-lg-11">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>

                                    <th scope="col">Date</th>
                                    <th scope="col">Warehouse</th>
                                    <th scope="col">Sku Total</th>
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

@endsection