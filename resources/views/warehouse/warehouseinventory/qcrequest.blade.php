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

    <div class="row">
        <div class="col d-flex justify-content-between align-items-center">
            <h6 class="h3 mb-3 text-gray-800">QC Request</h6>
            <div class="form-group mb-3 d-flex justify-content-end col-md-3">
                <input type="text" class="form-control" id="searchInputproduct" placeholder="Search">
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Seller</th>
                                    <th scope="col">Qty SKU</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requestQcs as $request )
                                <tr>
                                    <td>{{ $request->seller->name}}</td>
                                    <td>{{ $request->qty_sku}}</td>
                                    <td><a href="{{ route('qcrequestdetail', $request->id )}}">{{$request->status}}</a></td>
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

@endsection
