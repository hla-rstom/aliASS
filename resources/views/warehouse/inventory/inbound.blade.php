@extends('layouts.master')

@section('content')
@include('partials._alert')
<div class="container-fluid">
    <div class="row justify-content-between">
        <h6 class="h3 mb-3 text-gray-800 ml-3">Inbound</h6>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="tab-content col-md-12">

                    <table id="example" class="table table-borderless" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Inbound Code</th>
                                <th>Seller</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inbounds as $inbound)
                            <tr>
                                <td>
                                    @if ($inbound->status == 1)
                                    <i class="fa fa-circle" aria-hidden="true" style="color: #6c757d;"></i>
                                    @elseif ($inbound->status == 2)
                                    <i class="fa fa-circle" aria-hidden="true" style="color: #0A1D56;"></i>
                                    @elseif ($inbound->status == 3)
                                    <i class="fa fa-circle" aria-hidden="true" style="color: #ffc107;"></i>
                                    @elseif ($inbound->status == 4)
                                    <i class="fa fa-circle" aria-hidden="true" style="color: #3081D0;"></i>
                                    @else ($inbound->status == 5)
                                    <i class="fa fa-circle" aria-hidden="true" style="color: #28a745;"></i>
                                    @endif
                                </td>
                                <td> {{ $inbound->no_ship }} </td>
                                <td> {{ $inbound->seller->name }} </td>
                                <td> {{ $inbound->date }} </td>
                                <td> @if ($inbound->status == 1)
                                    <span class="text-secondary font-weight-bold">Waiting for shipment</span>
                                    @elseif ($inbound->status == 2)
                                    <span class="font-weight-bold" style="color: #0A1D56;">Waiting for receipt</span>
                                    @elseif ($inbound->status == 3)
                                    <span class="text-warning font-weight-bold">Already Receipt</span>
                                    @elseif ($inbound->status == 4)
                                    <span class="font-weight-bold" style="color: #3081D0;">Confirm calculation</span>
                                    @elseif ($inbound->status == 5)
                                    <span class="text-success font-weight-bold">Done</span>
                                    @elseif ($inbound->status == 6)
                                    <span class="text-secondary font-weight-bold">Cancel</span>
                                    @else
                                    <span>Unknown Status</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($inbound->status == 1)
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detail{{$inbound->id}}"><i class="fas fa-solid fa-info mr-2"></i> Detail</a>

                                            @elseif ($inbound->status == 2)
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detail{{$inbound->id}}"><i class="fas fa-solid fa-info mr-2"></i> Detail</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirm{{$inbound->id}}"><i class="fas fa-solid fa-arrow-down"></i> Confirm Receipt</a>
                                            @elseif ($inbound->status == 3)
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detail{{$inbound->id}}"><i class="fas fa-solid fa-info mr-2"></i> Detail</a>
                                            <a class="dropdown-item" href="{{ route('productcalculation',$inbound->id)}}"><i class="fas fa-solid fa-calculator"></i> Product Calculation</a>
                                            @elseif ($inbound->status == 4)
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detail{{$inbound->id}}"><i class="fas fa-solid fa-info mr-2"></i> Detail</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#doneModal{{$inbound->id}}"><i class="fas fa-solid fa-check"></i> Done Inbound</a>
                                            @elseif ($inbound->status == 5)
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detail{{$inbound->id}}"><i class="fas fa-solid fa-info mr-2"></i> Detail</a>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="detail{{$inbound->id}}" tabindex="-1" aria-labelledby="detail{{$inbound->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h6 class="font-weight-bold">Detail Inbound</h6>
                                                        <p>Inbound Code : <span class="font-weight-bold text-primary">{{ $inbound->no_ship }}</span> </p>
                                                    </div>
                                                    <table id="example" class="table table-borderless" style="width:100%">
                                                        <thead class="thead-light">
                                                            <tr>

                                                                <th>Product Name</th>
                                                                <th>Sku</th>
                                                                <th>Photo</th>
                                                                <th>Qty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($inbound->productinbound as $product)
                                                            <tr>
                                                                <td>{{ optional($product->product)->name ?? '' }}</td>
                                                                <td>{{ optional($product->product)->sku ?? '' }} - {{ optional($product->variation)->model_sku ?? '' }}</td>
                                                                <td>
                                                                    @if ($product->product)
                                                                    @php
                                                                    $images = json_decode($product->product->image, true);
                                                                    @endphp

                                                                    @if (!empty($images) && is_array($images) && !empty($images[0]))
                                                                    <img src="{{ asset($images[0]) }}" alt="Main Photo" style="width: 50px; height: auto;">
                                                                    @else
                                                                    <img src="{{ asset('asset/img/default.png') }}" alt="Default Photo" style="width: 50px; height: auto;">
                                                                    @endif
                                                                    @else
                                                                    <img src="{{ asset('asset/img/default.png') }}" alt="Default Photo" style="width: 50px; height: auto;">
                                                                    @endif
                                                                </td>
                                                                <td>{{ $product->qty }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary btn-lg btn-block" data-dismiss="modal">close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal confirm receipt of goods -->
                                    <div class="modal fade" id="confirm{{$inbound->id}}" tabindex="-1" aria-labelledby="confirm{{$inbound->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h6 class="font-weight-bold">Confirm Receipt of Goods</h6>
                                                        <p>Inbound Code : <span class="font-weight-bold text-primary">{{ $inbound->no_ship }}</span> </p>
                                                    </div>
                                                    <table id="example" class="table table-borderless" style="width:100%">
                                                        <thead class="thead-light">
                                                            <tr>

                                                                <th>Product Name</th>
                                                                <th>Sku</th>
                                                                <th>Photo</th>
                                                                <th>Qty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($inbound->productinbound as $product)
                                                            <tr>
                                                                <td>{{ optional($product->product)->name ?? '' }}</td>
                                                                <td>{{ optional($product->product)->sku ?? '' }} - {{ optional($product->variation)->model_sku ?? '' }}</td>
                                                                <td>
                                                                    @if ($product->product)
                                                                    @php
                                                                    $images = json_decode($product->product->image, true);
                                                                    @endphp

                                                                    @if (!empty($images) && is_array($images) && !empty($images[0]))
                                                                    <img src="{{ asset($images[0]) }}" alt="Main Photo" style="width: 50px; height: auto;">
                                                                    @else
                                                                    <img src="{{ asset('asset/img/default.png') }}" alt="Default Photo" style="width: 50px; height: auto;">
                                                                    @endif
                                                                    @else
                                                                    <img src="{{ asset('asset/img/default.png') }}" alt="Default Photo" style="width: 50px; height: auto;">
                                                                    @endif
                                                                </td>
                                                                <td>{{ $product->qty }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="modal-footer">
                                                    <form action="{{ route('confirminbound',$inbound->id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                        @csrf
                                                        <input type="hidden" name="inbound_id" value="{{ $inbound->id }}">
                                                        <button type="submit" class="btn btn-primary text-center btn-lg btn-block">Confirmation Received</button>
                                                    </form>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Done Modal -->
                                    <div class="modal fade" id="doneModal{{$inbound->id}}" tabindex="-1" role="dialog" aria-labelledby="done{{$inbound->id}}ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('doneinbound') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="text-center mt-4">
                                                            <h6 class="font-weight-bold">Confirmation Data</h6>
                                                            <p>Please confirm if all inbound data is in accordance with the incoming physical data.
                                                                <br>Inbound Code : <span class="font-weight-bold text-primary">{{ $inbound->no_ship }}</span>
                                                            </p>
                                                        </div>
                                                        <input type="hidden" name="inbound_id" value="{{$inbound->id}}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Correct Data</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    });
</script>


@endsection