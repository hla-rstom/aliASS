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
</style>
@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <div class="row justify-content-between">
        <h6 class="h3 mb-3 text-gray-800 ml-3">Create Inbound</h6>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="tab-content col-md-12">
                    <form id="form1" action="{{ route('storeinbound') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h6 class="font-weight-bold">General Information</h6>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Choose Warehouse</label>
                                            <select class="form-control" id="filter-dropdown" name="warehouse_id">
                                                <option value="">-Choose-</option>
                                                @foreach ($warehouses as $warehouse)
                                                <option value="{{$warehouse->id}}"> {{$warehouse->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name" class="col-form-label">Note</label>
                                            <textarea name="note" id="" class="form-control" cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>

                                @include('partials._modal_add_multiple_product_inbound')
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection