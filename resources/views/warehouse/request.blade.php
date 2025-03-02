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

    @if(session('success_modal'))
    <div class="modal" id="warningModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>{{ session('success') }}</h1>
                <h5>We are processing your request</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-warning"><i class="fas fa-brands fa-whatsapp"></i>Whatsapp Warehouse</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal Warning -->
<div class="modal" id="warningModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Add product before continuing!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="col-lg-12">
    <div class="col-md-6 text-left mb-2">
        <h3 class=" text-gray-800">Request for Warehouse Usage</h3>
        <div class="row ml-2">
            <a href="{{ route('searchwarehouse') }}">Warehouse List /</a>&nbsp;<a href="{{ route('warehousedetail', $warehouse_id) }}">Warehouse Detail /</a> &nbsp;
            <div class="small-text">Request for Warehouse Usage </div>
        </div>
    </div>
    <!-- Nav link -->

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    @if(isset($warehouse->photo))
                    <img src="{{ asset('storage/'. $warehouse->photo) }}" alt="Main Photo" style="width: 200px; height: auto;" class="rounded">
                    @endif
                </div>
                <div class="col-md-8">
                    <h5 class="card-title font-weight-bold">{{ $warehouse->name }}</h5>
                    <p class="card-text"><i class="fas fa-solid fa-map-pin"></i> {{ $warehouse->address }}</p>
                    <a class="btn btn-warning" data-toggle="modal" data-target="#requestModal">Send Request for Warehouse Usage</a>

                    <!-- Modal Add Third-party -->
                    <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="requestModalLabel">Third-party cooperation agreement</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1" action="{{ route('storerequest') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="font-weight-bold">Part ( I ) Seller</h6>
                                                <div class="form-group">
                                                    <label>Seller Type</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input type="hidden" name="warehouse_id" value="{{$warehouse_id}}">
                                                        <input class="form-check-input" type="radio" name="company_type" id="sellerPersonal" value="Personal">
                                                        <label class="form-check-label" for="sellerPersonal">Personal</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="company_type" id="sellerCompany" value="Company">
                                                        <label class="form-check-label" for="sellerCompany">Company</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="name" class="col-form-label">ID Card</label>
                                                            <input type="text" class="form-control" name="owner_card_id">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="name" class="col-form-label">Name</label>
                                                            <input type="text" class="form-control" name="owner_name" value="{{$user->name}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="name" class="col-form-label">Address</label>
                                                            <textarea name="company_address" id="" class="form-control" cols="30" rows="4" readonly>{{$user->address->street_address}}</textarea>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="name" class="col-form-label">Company</label>
                                                            <input type="text" class="form-control" name="company_name" value="{{$user->company->company_name}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <h6 class="font-weight-bold">Part ( II ) Warehouse</h6>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p>Warehouse Name</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p> {{ $warehouse->name }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <h6 class="font-weight-bold">Part ( III ) Fulhive</h6>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p>Company Name</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p> Fulhive </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check mb-3 mt-3 justify-content-between">
                                            <input class="form-check-input" type="checkbox" name="agreement" id="agreementCheckbox" style="transform: scale(1.5);" required>
                                            <label class="form-check-label" for="agreementCheckbox">
                                                I agree to the applicable Tri-Party cooperation agreement
                                            </label>
                                        </div>
                                        <!-- Modal Footer -->
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Reject</button>

                                            <div>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Latter</button>
                                                <button class="btn btn-warning" id="submitBoth" data-dismiss="modal">Agree</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End modal -->
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <h6><b>Your Store List</b></h6>
            <div class="col-lg-12 mb-4">
                <!-- <div class="mb-4">
                    <button type="button" class="btn btn-outline-warning mt-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-solid fa-plus"></i> Add Link Store</button>
                </div> -->
                <!-- Modal Add Shop -->
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Your Store</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('storeshop') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Name</label>
                                        <input type="text" class="form-control" name="shop_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="driver" class="col-form-label">Marketplace</label>
                                        <select class="form-control" name="driver">
                                            <option>-- marketplace --</option>
                                            <option value="shopee">SHOPEE</option>
                                            <option value="tiktok">TIKTOK</option>
                                            <option value="lazada">LAZADA</option>
                                            <option value="woocommers">WOO COMMERS</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="link" class="col-form-label">Link</label>
                                        <input type="text" class="form-control" name="link">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End modal -->
                <table class="table table-borderless">

                    <tbody>
                        @foreach ($shops as $shop )
                        <tr>
                            <th scope="row">{{ $loop->iteration}}</th>
                            <td>{{ $shop->shop_name}}</td>
                            <td>{{ $shop->driver}}</td>
                            <!-- <td><i class="fas fa-solid fa-edit" data-toggle="modal" data-target="#editModal"></td> -->
                            <!-- Modal Edit Shop -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Add Link Store</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('updateshop', $shop->id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                @csrf
                                                @method('put')
                                                <div class="form-group">
                                                    <label for="name" class="col-form-label">Name</label>
                                                    <input type="text" class="form-control" name="shop_name" value="{{ $shop->shop_name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="marketplace" class="col-form-label">Marketplace</label>
                                                    <select class="form-control" name="driver" id="driver">
                                                        <option value="" disabled>-- Select Marketplace --</option>
                                                        <option value="shopee" {{ $shop->driver == 'shopee' ? 'selected' : '' }}>SHOPEE</option>
                                                        <option value="tiktok" {{ $shop->driver == 'tiktok' ? 'selected' : '' }}>TIKTOK</option>
                                                        <option value="lazada" {{ $shop->driver == 'lazada' ? 'selected' : '' }}>LAZADA</option>
                                                        <option value="woocommers" {{ $shop->driver == 'woocommers' ? 'selected' : '' }}>WOO COMMERS</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="sku" class="col-form-label">Link</label>
                                                    <input type="text" class="form-control" name="link" value="{{ $shop->link}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End modal -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('partials._modal_add_multiple_product')

        </div>
    </div>
</div>



@endsection