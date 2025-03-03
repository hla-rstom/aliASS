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
            <h6 class="h3 mb-3 text-gray-800"><a href="{{ route('qcrequest')}}"><i class="fas fa-solid fa-chevron-left"></i> Detail</a></h6>
            <div class="form-group mb-3 d-flex justify-content-end col-md-6">
                <a href="{{ route('rejectqc',$id) }}" type="button" class="btn btn-outline-danger mr-2"> Reject</a>
                <a href="{{ route('acceptqc',$id) }}" type="button" class="btn btn-outline-primary mr-2"> Accept</a>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h6>Seller</h6>
                        <p>{{$requestQcs->seller->name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-between align-items-center">

                        <div class="form-group mb-3 d-flex justify-content-end col-md-3">
                            <input type="text" class="form-control" id="searchInputproduct" placeholder="Search">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Category Qc</th>
                                    <th scope="col">Step Qc</th>
                                    <th scope="col">Qty Pass</th>
                                    <th scope="col">Qty Fail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($qcDetail as $detail )
                                <tr>
                                    <td>{{ $detail->product->name}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
