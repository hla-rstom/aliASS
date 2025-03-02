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
    @include('partials._alert')

    <div class="col-lg-12">
        <div class="col-md-6 text-left mb-2">
            <h3 class=" text-gray-800">Warehouse Detail</h3>
            <div class="row ml-2">
                <a href="{{ route('searchwarehouse') }}">Warehouse List /</a> &nbsp;
                <div class="small-text"> Warehouse Detail</div>
            </div>
        </div>

        <!-- Nav link -->
        <div class="card-header py-3 mb-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            @if(isset($warehouse->photo))
                                        <div style="width: 200px; height: 200px; overflow: hidden;">
                                            <img src="{{ asset('storage/'. $warehouse->photo) }}" alt="Main Photo" style="width: 100%; height: 100%; object-fit: cover;" class="rounded">
                                        </div>
                                    @endif
                        </div>
                        <div class="col-md-8">
                            <h5 class="card-title font-weight-bold">{{ $warehouse->name }}</h5>
                            <p class="card-text"><i class="fas fa-solid fa-map-pin"></i> {{ $warehouse->address ?? '' }},  {{ $warehouse->user->region ?? '' }}</p>
                            <p class="card-text"><i class="fas fa-solid fa-home"></i> {{ $warehouse->user->retail_type ?? '' }}</p>

                            @if ($isActiveExitButton)
                                <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#termsModalExit">Exit Warehouse</button>
                            @else
                                <a href="{{ route('warehouserequest', $warehouse->id)}}" class="btn btn-warning">Request for Warehouse Usage</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card  shadow h-60 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
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
             <!-- Modal -->
        <div class="modal fade" id="termsModalExit" tabindex="-1" role="dialog" aria-labelledby="termsModalExitLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalExitLabel">Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{route('exitform',$warehouse_id)}}" type="button" class="btn btn-warning">Agree</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
            <div class="card shadow mb-4">
                <!-- Navigation bar -->
                <div class="row mt-4 mb-4">
                    <ul class="nav nav-tabs mx-auto" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="information-tab" data-toggle="tab" href="#information" role="tab" aria-controls="home" aria-selected="true">Warehouse Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="facility-tab" data-toggle="tab" href="#facility" role="tab" aria-controls="profile" aria-selected="false">Facility</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="logistic-tab" data-toggle="tab" href="#logistic" role="tab" aria-controls="contact" aria-selected="false">Logistic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="photo-tab" data-toggle="tab" href="#photo" role="tab" aria-controls="contact" aria-selected="false">Photo</a>
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
                                <h6 class="font-weight-bold">Description</h6>
                                <div class="row mb-2">
                                    <div class="col-md-4">Warehouse Type <br>
                                        <p class="font-weight-bold">{{ $warehouse->type}}</p>
                                    </div>
                                    <div class="col-md-4">Transaction Fee <br>
                                        <p class="font-weight-bold">{{ $warehouse->warehousedetail->transaction_fee }}</p>
                                    </div>
                                    <div class="col-md-4">Handling Fee <br>
                                        <p class="font-weight-bold"> {{ $warehouse->warehousedetail->handling_fee }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-body">
                                <h6 class="font-weight-bold mb-2">Other Fee</h6><br>
                                <p> {{ $warehouse->warehousedetail->other_price }} </p>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Warehouse Notes</h6><br>
                                <p> {{ $warehouse->warehousedetail->notes }} </p>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Cut Off Time</h6>

                                <table class="table table-borderless">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Day</th>
                                            <th scope="col">Inbound</th>
                                            <th scope="col">Outbound</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($warehouse->warehousecutoffs as $cutoff )
                                        <tr>
                                            <td> {{ $cutoff->day }} </td>
                                            <td> {{ $cutoff->inbound }} </td>
                                            <td> {{ $cutoff->outbound }} </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="facility" role="tabpanel" aria-labelledby="facility-tab">
                        <div class="card mt-4">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Facility</h6>
                                @foreach ($warehouse->warehousefacilitys as $warehouseFacility )
                                <div class="row">
                                    <div class="col-md-2">
                                        @if($warehouseFacility->facility)
                                        @php
                                        $facilityIds = explode(',', $warehouseFacility->facility);
                                        $facilities = \App\Models\Facility::findMany($facilityIds);
                                        @endphp
                                        @foreach($facilities as $facility)
                                        <li>{{ $facility->name }}</li> {{-- Displaying the facility name --}}
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card mt-4 mb-4">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Addition Facility</h6>
                                @foreach ($warehouse->warehousefacilitys as $warehouseFacility )
                                <div class="row">
                                    <div class="col-md-2">
                                        @if($warehouseFacility->addition_facility)
                                        @php
                                        $additionalFacilities = explode(',', $warehouseFacility->addition_facility);
                                        @endphp
                                        @foreach($additionalFacilities as $addFacility)
                                        <li>{{ $addFacility }}</li>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- <div class="card mt-4">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Addition Facility</h6>
                                @foreach ($warehouse->warehousefacilitys as $facility )
                                <div class="row">
                                    <div class="col-md-2">
                                        {{ $facility->other_facility }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div> -->
                    </div>
                    <div class="tab-pane fade" id="logistic" role="tabpanel" aria-labelledby="logistic-tab">
                        <div class="card mt-4 mb-4">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Logistics</h6>
                                @foreach ($warehouse->warehouselogistics as $warehouselogistics )
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ asset('storage/'.$warehouselogistics->logistics->photo) }}" alt="{{ $warehouselogistics->logistics->name }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="photo" role="tabpanel" aria-labelledby="photo-tab">
                        <div class="card mt-4 mb-4">
                            <div class="card-body">
                                <h6>Photo</h6>
                                @foreach ($warehouse->photos as $photo )
                                @if(isset($photo->photo))

                                <img id="profilePhoto" src="{{ asset('storage/'. $photo->photo) }}" style="width: 200px; height: auto;" alt="Profile Photo">
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">

                        <div class="card-body">
                            @foreach ($warehouse->warehousereviews as $review )
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="rating">
                                        <span class="rating-label font-weight-bold"> {{ $review->user->name }} </span>
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
        $('#example').DataTable();

        $('.nav-link-edit').click(function() {
            // Remove active class from all tabs
            $('.nav-link-edit').removeClass('active');
            $('.tab-pane-edit').removeClass('show active');

            // Add active class to clicked tab
            $(this).addClass('active');
            var tabTarget = $(this).attr('href');
            $(tabTarget).addClass('show active');

            // Prevent default anchor behavior
            return false;
        });




    });
</script>
@endsection
