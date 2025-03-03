@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-between">
        <div class="col-md-4">
            <h6 class="h3 text-gray-800 ml-3">Stock Special Events</h6>
            <!-- <div class="row ml-3 mb-2">
                <a href="{{ route('marketplace') }}">Marketplace /</a> &nbsp;
                <div class="small-text"> Marketplace Detail</div>
            </div> -->
        </div>
        <div class="text-right mr-4 col-md-3">
            <div class="form-group">
                <div class="row">
                    <label for="">Marketplace</label>
                    <select class="form-control" id="select2-sort">
                        <option value="all">All</option>
                        <!-- Add other status options here -->
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card shadow mb-4 ml-4 mt-4">
                    <div class="card-body">
                        <h3>{{$store->shop_name}}</h3>
                        <div class="d-flex justify-content-end">
                            <p>Last Updated : {{$store->updated_at}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card tim saya -->
</div>

<script>

</script>

@endsection