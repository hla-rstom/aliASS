<style>
    .rounded-image {
        border-radius: 50%;
        width: 100px;
        height: 100px;
    }

    .logistic-service {
        display: inline-block;
        margin-right: 10px;
    }

    .logistic-service img {
        width: 50px;
        /* or any size that fits your design */
        height: auto;
    }

    .rating {
        font-family: Arial, sans-serif;
        text-align: center;
    }

    .rating-label,
    .rating-date {
        display: block;
    }

    .stars {
        color: #ccc;
        /* Color for the empty stars */
    }

    .star {
        font-size: 1.5em;
        margin: 0.1em;
    }

    .checked {
        color: #ff0;
        /* Yellow color for the filled stars */
    }
</style>
@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <h6 class="h3 mb-3 text-gray-800 ml-3">Your Retail Data</h6>
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <ul class="nav nav-tabs justify-content-between mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="location-tab" data-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="false">Location</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="photo-tab" data-toggle="tab" href="#photo" role="tab" aria-controls="photo" aria-selected="false">Photo</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="text-center mb-4">
                                @if(isset($warehouse->photo))

                                <img id="profilePhoto" src="{{ asset('storage/'. $warehouse->photo) }}" class="rounded-image" alt="Profile Photo">
                                @endif
                            </div>
                            <form action="{{ route('storegeneral') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                @csrf
                                <div class="mr-4 mt-2">
                                    <div class="form-group">
                                        <input type="hidden" name="warehouse_id" value="{{$warehouse->id}}">
                                        <label class="mb-1" for="bank_name">Retail Name</label>
                                        <input type="text" class="form-control" value="{{ old('name', $warehouse->name ?? '') }}" placeholder="Name" name="name">
                                    </div>
                                </div>
                                <div class="mr-4 mt-2">
                                    <div class="form-group">
                                        <label class="mb-1" for="bank_name">Phone Number</label>
                                        <input type="text" class="form-control" value="{{ old('phone', $warehouse->warehousedetail->phone ?? '') }}" placeholder="Phone" name="phone">
                                    </div>
                                </div>
                                <div class="mr-4 mt-2">
                                    <div class="form-group">
                                        <label class="mb-1" for="bank_name">Short Introduction</label>
                                        <input type="text" class="form-control" value="{{ old('description', $warehouse->warehousedetail->description ?? '') }}" placeholder="Description" name="description">
                                    </div>
                                </div>
                                <div class="mr-4 mt-2">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                            <form action="{{ route('storeaddress') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                @csrf
                                <div class="mr-4 mt-2">
                                    <div class="form-group">
                                        <input type="hidden" name="warehouse_id" value="{{$warehouse->id}}">
                                        <textarea class="form-control" cols="60" rows="4" placeholder="Address" name="address"> {{ old('address', $warehouse->address ?? '') }} </textarea>
                                    </div>
                                </div>
                                <div class="mr-4 mt-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{ old('area', $user->region ?? '') }}" placeholder="Area" name="area">
                                    </div>
                                </div>
                                <div class="mr-4 mt-2">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="photo" role="tabpanel" aria-labelledby="photo-tab">
                            <div class="text-center">
                                @if(isset($warehouse->photo))

                                <img id="profilePhoto" src="{{ asset('storage/'. $warehouse->photo) }}" class="rounded-image" alt="Profile Photo">
                                @endif
                                <form action="{{ route('storephoto') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="warehouse_id" value="{{$warehouse->id}}">
                                    <label for="photoInput" class="btn btn-outline-primary mb-4 mt-4">Choose Photo</label>
                                    <input type="file" id="photoInput" name="photo" style="display: none;" onchange="previewImage()">
                                    <button type="submit" class="btn btn-primary mb-4 mt-4">Add Photo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <!-- card -->
                <div class="col-lg-12">
                    <div class="mb-4 mt-4">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-solid fa-plus"></i> Add Bank</button>
                    </div>
                    <!-- Modal add-->
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Add Bank</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('banks.store') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="small mb-1" for="bank_name">Bank Name</label>
                                            <input class="form-control form-control-solid @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" type="text" placeholder="" value="{{ old('bank_name') }}" />
                                            @error('bank_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="small mb-1" for="account_name">Account Name</label>
                                            <input class="form-control form-control-solid @error('account_name') is-invalid @enderror" id="account_name" name="account_name" type="text" placeholder="" value="{{ old('account_name') }}" />
                                            @error('account_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="small mb-1" for="account">Account</label>
                                            <input class="form-control form-control-solid @error('account') is-invalid @enderror" id="account" name="account" type="text" placeholder="" value="{{ old('account') }}" />
                                            @error('account')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal add -->
                    @if($banks->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            No bank records found. Please add a bank account.
                        </div>
                    @else
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bank Name</th>
                                    <th scope="col">Account Name</th>
                                    <th scope="col">Account</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banks as $bank)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $bank->bank_name }}</td>
                                    <td>{{ $bank->account_name }}</td>
                                    <td>{{ $bank->account }}</td>

                                    <td>
                                        <div class="row">
                                            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#updateModal{{$bank->id}}">
                                                <i class="fas fa-solid fa-user-edit"></i>
                                            </button>

                                            <div class="modal fade" id="updateModal{{$bank->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="updateModalLabel">Update Category</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('banks.update', $bank->id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label class="small mb-1" for="bank_name">Bank Name</label>
                                                                    <input class="form-control form-control-solid @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" type="text" placeholder="" value="{{ old('bank_name', $bank->bank_name) }}" />
                                                                    @error('bank_name')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="small mb-1" for="account_name">Account Name</label>
                                                                    <input class="form-control form-control-solid @error('account_name') is-invalid @enderror" id="account_name" name="account_name" type="text" placeholder="" value="{{ old('account_name', $bank->account_name) }}" />
                                                                    @error('account_name')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="small mb-1" for="account">Account</label>
                                                                    <input class="form-control form-control-solid @error('account') is-invalid @enderror" id="account" name="account" type="text" placeholder="" value="{{ old('account', $bank->account) }}" />
                                                                    @error('account')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('banks.destroy', $bank->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm ml-2" onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="fas fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif


                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- Navigation bar -->
                <div class="row mt-4 mb-4">
                    <ul class="nav nav-tabs mx-auto" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="information-tab" data-toggle="tab" href="#information" role="tab" aria-controls="home" aria-selected="true">Retail Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="retailmode-tab" data-toggle="tab" href="#retailmode" role="tab" aria-controls="contact" aria-selected="false">Retail Mode</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="retailperiode-tab" data-toggle="tab" href="#retailperiode" role="tab" aria-controls="contact" aria-selected="false">Retail Periode</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="facility-tab" data-toggle="tab" href="#facility" role="tab" aria-controls="profile" aria-selected="false">Facility</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="logistic-tab" data-toggle="tab" href="#logistic" role="tab" aria-controls="contact" aria-selected="false">Logistic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="photo-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="contact" aria-selected="false">Photo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="contact" aria-selected="false">Review</a>
                        </li>
                    </ul>
                </div>

                <!-- Tab panes -->
                <div class="tab-content col-md-12">
                    <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-4 mb-4">
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card  shadow h-60 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Warehouse Capacity Utilized</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-home fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card  shadow h-60 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                            Total Transaction</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-truck fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card  shadow h-60 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                            Total Seller</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalOfSellers}}</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('storeinformation') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col-md-3"><b>Retail Type </b><br>
                                            <input type="hidden" name="warehouse_id" value="{{$warehouse->id}}">
                                            <input type="text" class="form-control" name="type" value="{{ old('type', $warehouse->user->retail_type ?? '') }}" placeholder="Type">
                                        </div>
                                        <div class="col-md-3"><b>Transaction Fee </b><br>
                                            <input type="text" class="form-control" name="transaction_fee" value="{{ old('transaction_fee', $warehouse->warehousedetail->transaction_fee ?? '') }}" placeholder="Transaction Fee">
                                        </div>
                                        <div class="col-md-3"><b>Handling Fee </b><br>
                                            <input type="text" class="form-control" name="handling_fee" value="{{ old('handling_fee', $warehouse->warehousedetail->handling_fee ?? '') }}" placeholder="Handling Fee">
                                        </div>
                                        <div class="col-md-3"><b>Other Fee </b><br>
                                            <input type="text" class="form-control" name="other_price" value="{{ old('other_price', $warehouse->warehousedetail->other_price ?? '') }}" placeholder="Other Price">
                                        </div>
                                        <div class="col-md-3 mt-4"><b>Capacity </b><br>
                                            <input type="text" class="form-control" name="capacity" value="{{ old('capacity', $warehouse->warehousedetail->capacity ?? '') }}" placeholder="Capacity Rack">
                                        </div>
                                        <div class="col-md-6 mt-4"><b>Notes </b><br>
                                            <textarea class="form-control" cols="60" rows="4" name="notes" placeholder="Notes"> {{ old('notes', $warehouse->warehousedetail->notes ?? '') }} </textarea>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Cut Off Time</h6>
                                <div class="mb-4">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-solid fa-plus"></i> Add Cut Off</button>
                                </div>
                                <!-- Modal add-->
                                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addModalLabel">Add Cut Off</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('addcuttOff') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                    @csrf
                                                    <div class="form-group mr-3">
                                                        <label for="exampleFormControlInput1">Day</label>
                                                        <input type="hidden" name="warehouse_id" value="{{$warehouse->id}}">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="day">
                                                    </div>
                                                    <div class="form-group mr-3">
                                                        <label for="exampleFormControlInput1">Inbound</label>
                                                        <input type="time" class="form-control" id="exampleFormControlInput1" name="inbound">
                                                    </div>
                                                    <div class="form-group mr-3">
                                                        <label for="exampleFormControlInput1">Outbound</label>
                                                        <input type="time" class="form-control" id="exampleFormControlInput1" name="outbound">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal add -->
                                <table class="table table-borderless">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Day</th>
                                            <th scope="col">Inbound</th>
                                            <th scope="col">Outbound</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($warehouse->warehousecutoffs as $cutoff )
                                        <tr>
                                            <td> {{ $cutoff->day }} </td>
                                            <td> {{ \Carbon\Carbon::parse($cutoff->inbound)->format('H:i') }} </td>
                                            <td> {{ \Carbon\Carbon::parse($cutoff->outbound)->format('H:i') }} </td>
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#updateModal{{$cutoff->id }}"><i class="fas fa-solid fa-user-edit"></i></button>

                                                    <!-- Modal update-->
                                                    <div class="modal fade" id="updateModal{{$cutoff->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="updateModalLabel">Update Team</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('updateCutOff',$cutoff->id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                                        @csrf

                                                                        <div class="form-group mr-3">
                                                                            <label for="exampleFormControlInput1">Day</label>
                                                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="day" value="{{ $cutoff->day }}">
                                                                        </div>
                                                                        <div class="form-group mr-3">
                                                                            <label for="exampleFormControlInput1">Inbound</label>
                                                                            <input type="time" class="form-control" id="exampleFormControlInput1" name="inbound" value="{{ \Carbon\Carbon::parse($cutoff->inbound)->format('H:i') }}">
                                                                        </div>
                                                                        <div class="form-group mr-3">
                                                                            <label for="exampleFormControlInput1">Outbound</label>
                                                                            <input type="time" class="form-control" id="exampleFormControlInput1" name="outbound" value="{{ \Carbon\Carbon::parse($cutoff->outbound)->format('H:i') }}">
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal update -->

                                                    <form action="{{ route('deleteCutOff', $cutoff->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm ml-2" onclick="return confirm('Are you sure you want to delete this record?')">
                                                            <i class="fas fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="retailmode" role="tabpanel" aria-labelledby="retailmode-tab">
                        <div class="card mt-4">
                            <div class="card-body">
                                <form action="{{ route('saveWarehouseretailmodes', $warehouse->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <h6 class="font-weight-bold">Retail Mode</h6>
                                    @php
                                    // Assuming $warehouse->warehouselogistics contains all logistic entries for the warehouse.
                                    $warehouseLogisticIds = $warehouse->warehouselogistics->pluck('logistic_id')->map(function ($ids) {
                                    // Split the string into an array of IDs and then merge into one array if there are multiple entries
                                    return explode(',', $ids);
                                    })->flatten()->all();
                                    @endphp
                                    <div class="logistics-container mb-4">
                                        @foreach($option_retail_modes as $retailmode)
                                        <div class="logistic-service">
                                            <label for="logistic_{{ $retailmode->id }}">
                                                <input type="checkbox" id="logistic_{{ $retailmode->id }}" name="retailmodes[]" value="{{ $retailmode->id }}" {{ in_array($retailmode->id, $warehouseLogisticIds) ? 'checked' : '' }}>
                                                <span>{{ $retailmode->value }}</span>
                                            </label>
                                        </div><br>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="retailperiode" role="tabpanel" aria-labelledby="retailperiode-tab">
                        <div class="card mt-4">
                            <div class="card-body">
                                <form action="{{ route('saveWarehouseretailperiodes', $warehouse->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <h6 class="font-weight-bold">Rental Periode</h6>
                                    @php
                                    // Assuming $warehouse->warehouselogistics contains all logistic entries for the warehouse.
                                    $warehouseLogisticIds = $warehouse->warehouselogistics->pluck('logistic_id')->map(function ($ids) {
                                    // Split the string into an array of IDs and then merge into one array if there are multiple entries
                                    return explode(',', $ids);
                                    })->flatten()->all();
                                    @endphp
                                    <div class="logistics-container mb-4">
                                        @foreach($option_retail_periodes as $retailperiode)
                                        <div class="logistic-service">
                                            <label for="logistic_{{ $retailperiode->id }}">
                                                <input type="checkbox" id="logistic_{{ $retailperiode->id }}" name="retailperiodes[]" value="{{ $retailperiode->id }}" {{ in_array($retailperiode->id, $warehouseLogisticIds) ? 'checked' : '' }}>
                                                <span>{{ $retailperiode->value }}</span>
                                            </label>
                                        </div><br>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="facility" role="tabpanel" aria-labelledby="facility-tab">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold mt-4">Facility</h6>
                                        @if($warehouse->warehousefacilitys && $warehouse->warehousefacilitys->count() > 0)
                                        <ul>
                                            @foreach($warehouse->warehousefacilitys as $warehouseFacility)
                                            {{-- Displaying related facilities by resolving IDs --}}
                                            @if($warehouseFacility->facility)
                                            @php
                                            $facilityIds = explode(',', $warehouseFacility->facility);
                                            $facilities = \App\Models\Facility::findMany($facilityIds);
                                            @endphp
                                            @foreach($facilities as $facility)
                                            <li>{{ $facility->name }}</li> {{-- Displaying the facility name --}}
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6 class="font-weight-bold mt-4">Addition Facility</h6>
                                        <ul>
                                            {{-- Displaying additional facilities --}}
                                            @if($warehouseFacility->addition_facility)
                                            @php
                                            $additionalFacilities = explode(',', $warehouseFacility->addition_facility);
                                            @endphp
                                            @foreach($additionalFacilities as $addFacility)
                                            <li>{{ $addFacility }}</li>
                                            @endforeach
                                            @endif
                                            @endforeach
                                        </ul>
                                        @endif
                                    </div>
                                </div>

                                <form action="{{ route('saveWarehouseFacilities', $warehouse->id) }}" method="POST">
                                    @csrf
                                    <div id="FacilitiesList">
                                        <div class="input-group mb-3">
                                            <select class="custom-select" name="facility[]">
                                                <option selected>Choose Facilities</option>
                                                @foreach ($masterfacilities as $facility)
                                                <option value="{{$facility->id}}">{{$facility->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-danger remove-material" type="button"><i class="fas fa-trash-alt"></i></button>
                                                <button class="btn btn-outline-primary" id="addFacilities" type="button"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <h6 class="font-weight-bold mt-4">Addition Facility</h6>
                                    <div id="otherFacilitiesList">
                                        <div class="input-group mb-3">
                                            <input type="text" name="addition_facility[]" class="form-control" placeholder="Enter Other Facility">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-danger remove-material" type="button"><i class="fas fa-trash-alt"></i></button>
                                                <button class="btn btn-outline-primary" id="addOtherFacilities" type="button"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="logistic" role="tabpanel" aria-labelledby="logistic-tab">
                        <div class="card mt-4">
                            <div class="card-body">
                                <form action="{{ route('saveWarehouseLogistics', $warehouse->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <h6 class="font-weight-bold">Logistics</h6>
                                    @php
                                    // Assuming $warehouse->warehouselogistics contains all logistic entries for the warehouse.
                                    $warehouseLogisticIds = $warehouse->warehouselogistics->pluck('logistic_id')->map(function ($ids) {
                                    // Split the string into an array of IDs and then merge into one array if there are multiple entries
                                    return explode(',', $ids);
                                    })->flatten()->all();
                                    @endphp

                                    <div class="logistics-container">
                                        @foreach($logisticsmaster as $logistic)
                                        <div class="logistic-service">
                                            <label for="logistic_{{ $logistic->id }}">
                                                <img src="{{ asset('storage/'.$logistic->photo) }}" alt="{{ $logistic->name }}">
                                                <input type="checkbox" id="logistic_{{ $logistic->id }}" name="logistics[]" value="{{ $logistic->id }}" {{ in_array($logistic->id, $warehouseLogisticIds) ? 'checked' : '' }}>
                                                <span>{{ $logistic->name }}</span>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="accept_cod" value="no">
                                                    <input type="checkbox" class="custom-control-input" id="accept_codSwitch" name="accept_cod" value="yes" {{ $accept_cod == 'yes' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="accept_codSwitch">Accept COD</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="accept_return" value="no">
                                                    <input type="checkbox" class="custom-control-input" id="accept_returnSwitch" name="accept_return" value="yes" {{ $accept_return == 'yes' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="accept_returnSwitch">Accept Return</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="accept_dropship" value="no">
                                                    <input type="checkbox" class="custom-control-input" id="accept_dropshipSwitch" name="accept_dropship" value="yes" {{ $accept_dropship == 'yes' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="accept_dropshipSwitch">Accept Dropship</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                        <div class="card mt-4">
                            <div class="card-body">
                                <h6>Photo</h6>
                                @foreach ($warehouse->photos as $photo )
                                @if(isset($photo->photo))

                                <img id="profilePhoto" src="{{ asset('storage/'. $photo->photo) }}" style="width: 200px; height: auto;" alt="Profile Photo">
                                @endif
                                @endforeach
                                <form action="{{ route('saveWarehousePhotos', $warehouse->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mt-4">
                                        <label for="warehouse_photos">Upload Photos</label>
                                        <input type="file" class="form-control-file" id="warehouse_photos" name="photos[]" multiple>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">Save</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">

                        <div class="card-body">
                            @foreach ($warehouse->warehousereviews as $review )
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="rating">
                                        <span class="rating-label font-weight-bold"> {{ $review->reviewer }} </span>
                                        <span class="rating-comment"> {{ $review->comment }} </span>
                                        <span class="rating-date">{{\Carbon\Carbon::parse($review->date)->format('F, Y')}}</span>
                                        <div class="stars">

                                            @for ($i = 1; $i <= 5; $i++) @if ($i <=$review->star)
                                                <span class="star checked">&#9733;</span>
                                                @else
                                                <span class="star">&#9734;</span>
                                                @endif
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Function to add new material packaging input
        $('#addOtherFacilities').click(function() {
            var newInputGroup = $('#otherFacilitiesList .input-group:first').clone();
            newInputGroup.find('select').val(""); // Resets select input
            newInputGroup.find('input').val(""); // Resets quantity input
            $('#otherFacilitiesList').append(newInputGroup);
        });

        // Event delegation for dynamically added remove buttons
        $('#otherFacilitiesList').on('click', '.remove-material', function() {
            if ($('#otherFacilitiesList .input-group').length > 1) {
                $(this).closest('.input-group').remove();
            } else {
                alert('You must have at least one material packaging input.');
            }
        });

        $('#addFacilities').click(function() {
            var newInputGroup = $('#FacilitiesList .input-group:first').clone();
            newInputGroup.find('select').val(""); // Resets select input
            newInputGroup.find('input').val(""); // Resets quantity input
            $('#FacilitiesList').append(newInputGroup);
        });

        // Event delegation for dynamically added remove buttons
        $('#FacilitiesList').on('click', '.remove-material', function() {
            if ($('#FacilitiesList .input-group').length > 1) {
                $(this).closest('.input-group').remove();
            } else {
                alert('You must have at least one material input.');
            }
        });

        $('#addLogistic').click(function() {
            var newInputGroup = $('#LogisticList .input-group:first').clone();
            newInputGroup.find('select').val(""); // Resets select input
            newInputGroup.find('input').val(""); // Resets quantity input
            $('#LogisticList').append(newInputGroup);
        });

        // Event delegation for dynamically added remove buttons
        $('#LogisticList').on('click', '.remove-material', function() {
            if ($('#LogisticList .input-group').length > 1) {
                $(this).closest('.input-group').remove();
            } else {
                alert('You must have at least one material input.');
            }
        });
    });
</script>
@endsection