<style>
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
    <div class="row justify-content-between">
        <h6 class="h3 mb-3 text-gray-800 ml-3">My Warehouses</h6>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 mb-4">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item col-md-6">
                        <a class="nav-link active text-center" id="mywarehouse-tab" data-toggle="tab" href="#mywarehouse" role="tab" aria-controls="profile" aria-selected="false">My Warehouse</a>
                    </li>
                    <li class="nav-item col-md-6">
                        <a class="nav-link text-center" id="warehouse-request-tab" data-toggle="tab" href="#warehouse-request" role="tab" aria-controls="contact" aria-selected="false">Warehouse Request</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content col-md-12">
                    <div class="tab-pane fade show active" id="mywarehouse" role="tabpanel" aria-labelledby="mywarehouse-tab">
                        <table id="example" class="table table-borderless" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>Warehouse Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Area</th>
                                    <!--<th>Your Review</th>-->
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($mywarehouse->isNotEmpty())
                                @foreach ($mywarehouse as $request)
                                @php
                                $warehouse = $request->warehouse;
                                @endphp
                                <tr>
                                    <td> <a href="{{ route('mywarehousedetail', $request->warehouse_id)}}">{{ $warehouse->name }} </a></td>
                                    <td>{{ $warehouse->user->email }}</td>
                                    <td>{{ $warehouse->user->phone }}</td>
                                    <td> {{ $warehouse->area }} </td>
                                    
                                    <!--<td>-->
                                    <!--    @if($warehouse->warehousereviews->isNotEmpty())-->
                                    <!--        @foreach ($warehouse->warehousereviews as $review)-->
                                    <!--            @for ($i = 1; $i <= 5; $i++)-->
                                    <!--                @if ($i <= $review->star)-->
                                    <!--                    <span class="star checked">&#9733;</span> {{-- Filled yellow star --}}-->
                                    <!--                @else-->
                                    <!--                    <span class="star">&#9734;</span> {{-- Empty star --}}-->
                                    <!--                @endif-->
                                    <!--            @endfor-->
                                    <!--            <br>-->
                                    <!--        @endforeach-->
                                    <!--    @else-->
                                    <!--        <span>No reviews yet</span>-->
                                    <!--    @endif-->
                                    <!--</td>-->
                                    <td> {{ $request->status }} </td>
                                </tr>
                                
                                @endforeach
                                @else
                                <p>Data Not Found.</p>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="warehouse-request" role="tabpanel" aria-labelledby="warehouse-request-tab">
                        <table id="example" class="table table-borderless" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>Warehouse Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Area</th>
                                    <!--<th>Your Review</th>-->
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($warehouseRequests->isNotEmpty())
                                @foreach ($warehouseRequests as $request)
                                @php
                                $warehouse = $request->warehouse;
                                @endphp
                                <tr>
                                    <td> <a href="{{ route('mywarehousedetail', $request->warehouse_id)}}">{{ $warehouse->name ?? '' }} </a></td>
                                    <td>{{ $warehouse->user->email ?? '' }}</td>
                                    <td>{{ $warehouse->user->phone ?? '' }}</td>
                                    <td> {{ $warehouse->area ?? '' }} </td>
                                    <!--<td>-->
                                    <!--    @if($warehouse->warehousereviews->isNotEmpty())-->
                                    <!--        @foreach ($warehouse->warehousereviews as $review)-->
                                    <!--            @for ($i = 1; $i <= 5; $i++)-->
                                    <!--                @if ($i <= $review->star)-->
                                    <!--                    <span class="star checked">&#9733;</span> {{-- Filled yellow star --}}-->
                                    <!--                @else-->
                                    <!--                    <span class="star">&#9734;</span> {{-- Empty star --}}-->
                                    <!--                @endif-->
                                    <!--            @endfor-->
                                    <!--            <br>-->
                                    <!--        @endforeach-->
                                    <!--    @else-->
                                    <!--        <span>No reviews yet</span>-->
                                    <!--    @endif-->
                                    <!--</td>-->
                                    <td> {{ $request->status ?? '' }} </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6">Data Not Found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection