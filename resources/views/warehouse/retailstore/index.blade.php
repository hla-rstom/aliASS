@extends('layouts.master')

@section('content')
<style>
    .wa-number {
        position: relative;
        top: 5vh;
        left: -8vw;
    }
    #whatsapp_number {
        padding-left: 3.3vw;
    }
    .autocomplete-result-item {
        padding: 10px;
        cursor: pointer;
        font-size: 14px;
    }
    .autocomplete-result-item:hover {
        background-color: #f1f1f1;
    }
    #autocompleteResults {
        display: none;
        position: absolute;
        background: white;
        border: 1px solid #ddd;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
    }
</style>

<div class="container-fluid">
    @include('partials._alert')

    <h6 class="h3 mb-3 text-gray-800 ml-3">Your Store</h6>

    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="col-lg-12">
                <div class="mb-4 mt-4">
                    <button type="button" class="btn btn-outline-primary" id="addStoreButton"><i class="fas fa-solid fa-plus"></i> Add Store</button>
                </div>

                <!-- Add Store Form -->
                <div id="addStoreForm" style="display: none;">
                    <form action="{{ route('storeretailstore') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                        @csrf
                        <input type="hidden" name="warehouse_id" value="{{ $warehouse_id }}" />
                        <input type="hidden" id="location" name="location">
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">

                        <div class="mb-3">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="whatsapp_number">WhatsApp Number <span class="text-danger">*</span></label>
                            <span class="wa-number">+60</span>
                            <input type="number" class="form-control" id="whatsapp_number" name="whatsapp_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancelButton">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <!-- Location Search Section -->
                <div class="search-bar mb-4">
                    <input type="text" id="searchLocation" class="form-control" placeholder="Search for a location..." autocomplete="off">
                    <div id="autocompleteResults"></div>
                </div>

                <!-- Map Display -->
                <div id="map" style="height: 400px; margin-bottom: 20px;"></div>
                </div>

                <!-- Store List Table -->
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($retailStores as $retailStore)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $retailStore->name }}</td>
                            <td>{{ $retailStore->address }}</td>
                            <td>{{ $retailStore->description }}</td>
                            <td>
                                <a href="{{ route('storeretailshow', $retailStore->id) }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-solid fa-info-circle"></i>
                                </a>
                                <button type="button" class="btn btn-outline-primary btn-sm updateStoreButton" data-store-id="{{ $retailStore->id }}">
                                    <i class="fas fa-solid fa-user-edit"></i>
                                </button>
                                <form action="{{ route('storeretaildestroy', $retailStore->id) }}" method="POST" style="display:inline;">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-4">
                    {!! $retailStores->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function initMap() {
    // Set a default location
    const defaultLocation = { lat: 3.139, lng: 101.6869 };
    const mapOptions = {
        zoom: 8,
        center: defaultLocation,
    };

    const map = new google.maps.Map(document.getElementById("map"), mapOptions);

    let marker = new google.maps.Marker({
        position: defaultLocation,
        map: map,
        draggable: true,
    });

    // Autocomplete input and results container
    const input = document.getElementById('searchLocation');
    const autocompleteResults = document.getElementById('autocompleteResults');

    // Check if places service is available before setting up autocomplete
    if (google.maps.places) {
        const autocompleteService = new google.maps.places.AutocompleteService();
        
        input.addEventListener('input', () => {
            const query = input.value.trim();
            if (!query) {
                clearResults();
                return;
            }
            
            autocompleteService.getPlacePredictions({ input: query, componentRestrictions: { country: 'MY' } }, (predictions, status) => {
                clearResults();
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    predictions.forEach(prediction => {
                        const resultItem = document.createElement('div');
                        resultItem.classList.add('autocomplete-result-item');
                        resultItem.textContent = prediction.description;
                        resultItem.addEventListener('click', () => selectPlace(prediction.place_id, prediction.description));
                        autocompleteResults.appendChild(resultItem);
                    });
                    autocompleteResults.style.display = 'block';
                }
            });
        });

        // Function to select a place and place marker
        function selectPlace(placeId, description) {
            const placesService = new google.maps.places.PlacesService(map);
            placesService.getDetails({ placeId }, (place, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    const location = place.geometry.location;
                    map.setCenter(location);
                    map.setZoom(15);

                    marker.setPosition(location);

                    document.getElementById('location').value = description;
                    document.getElementById('latitude').value = location.lat();
                    document.getElementById('longitude').value = location.lng();
                    autocompleteResults.style.display = 'none';
                }
            });
        }

        // Handle marker drag and update location info
        marker.addListener('dragend', (event) => {
            const position = event.latLng;
            document.getElementById('latitude').value = position.lat();
            document.getElementById('longitude').value = position.lng();

            // Reverse geocode to get address
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ location: position }, (results, status) => {
                if (status === google.maps.GeocoderStatus.OK && results[0]) {
                    document.getElementById('location').value = results[0].formatted_address;
                }
            });
        });
    } else {
        console.error("Google Maps Places library is not loaded.");
    }

    // Clear autocomplete results
    function clearResults() {
        autocompleteResults.innerHTML = '';
        autocompleteResults.style.display = 'none';
    }

    // Hide results when clicking outside the input/results area
    document.addEventListener('click', (e) => {
        if (!input.contains(e.target) && !autocompleteResults.contains(e.target)) {
            clearResults();
        }
    });
}

// Show the Add Store form
document.getElementById('addStoreButton').onclick = function() {
    document.getElementById('addStoreForm').style.display = 'block';
};

// Hide Add Store form on Cancel
document.getElementById('cancelButton').onclick = function() {
    document.getElementById('addStoreForm').style.display = 'none';
};
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFmDPs9yBFzKNC6o0ozgOP5c_Rmrz7F1k&libraries=places&callback=initMap" async defer></script>
@endsection



{{--  AIzaSyAFmDPs9yBFzKNC6o0ozgOP5c_Rmrz7F1k  --}}