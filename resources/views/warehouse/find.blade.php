@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h6 class="h3 mb-3 text-gray-800 ml-3">List Warehouses</h6>
    <div class="col-lg-12">
        <div class="input-group ">
            <input type="text" class="form-control" id="searchInput" placeholder="find warehouse here" aria-label="find warehouse here" aria-describedby="basic-addon2">
        </div>

        <div class="card shadow mb-4 mt-4">
            <div class="card-body">
                <!-- <div class="row mt-3 mb-4">
                    <button type="button" class="btn btn-outline-warning ml-4 mr-2"><i class="fas fa-solid fa-list"></i> Filter</button>
                    <button type="button" class="btn btn-outline-secondary">All</button>
                </div> -->

                <div class="" id="searchResults">

                </div>
                @if($warehouses->isNotEmpty())
                <div class="warehouse-list">
                    @foreach ($warehouses as $warehouse)
                    <div class="card mt-4">
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
                                    <div class="row">
                                        <h5 class="card-title font-weight-bold">{{ $warehouse->name }}</h5>
                                        <a href="{{ route('warehousedetail', $warehouse->id) }}" type="button" class="btn btn-warning ml-auto">View Detail</a>
                                    </div>
                                    <p class="card-text"><i class="fas fa-solid fa-map-pin"></i> {{ $warehouse->address ?? '' }},  {{ $warehouse->user->region ?? '' }}</p>
                                    <p class="card-text"><i class="fas fa-solid fa-home"></i> {{ $warehouse->user->retail_type ?? '' }}</p>
                                    <p class="card-text"><small class="text-muted"><b>{{$warehouse->warehousedetail->capacity ?? ''}}</b> Rack</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else

                    <div class="card mb-3 text-center">
                        <div class="card-body">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="{{ asset('storage/images/1705557639_nodata.jpg') }}" alt="...">
                            <h5>There is no Warehouse yet</h5>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center mt-4">

                    {!! $warehouses->links() !!}
                </div>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            var storageBaseUrl = "{{ asset('storage/') }}/";
            var baseUrl = "{{ route('warehousedetail', ':id') }}";
            $('#searchInput').keyup(function() {
                var query = $(this).val();

                $.ajax({
                    url: '/find',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        console.log(data);
                        var html = '';
                        $.each(data, function(index, warehouse) {
                            if (data.length === 0) {
                                html += `
                                        <div class="card mt-4">
                                            <div class="card-body text-center">
                                                <h5>No Warehouse Found</h5>
                                            </div>
                                        </div>`;
                            } else {
                                // Replace the ':id' placeholder in the base URL with the actual warehouse ID
                                var warehouseDetailUrl = baseUrl.replace(':id', warehouse.id);

                                html += `
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-md-2">
                                                    <img src="${storageBaseUrl}${warehouse.photo}" alt="Main Photo" style="width: 200px; height: auto;" class="rounded">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <h5 class="card-title font-weight-bold">${warehouse.name}</h5>
                                                        <a href="${warehouseDetailUrl}" type="button" class="btn btn-warning ml-auto">View Detail</a>
                                                    </div>
                                                    <p class="card-text"><i class="fas fa-solid fa-map-pin"></i> ${warehouse.address}</p>
                                                    <p class="card-text"><small class="text-muted">${warehouse.warehousedetail.capacity}</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                            }
                        });

                        $('#searchResults').html(html);
                        $(".warehouse-list").hide();
                    },
                    error: function(request, status, error) {
                        $('#searchResults').html('<p>Warehouse Not Found.</p>');
                    }
                });
            });
        });
    </script>

    @endsection
