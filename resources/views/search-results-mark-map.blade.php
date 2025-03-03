@extends('theme.app')
@section('content')
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        #container {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 80vh; /* Adjust height as needed */
            z-index: 1;
        }
        #footer {
            position: absolute;
            bottom: 0;
            background: #F8F9FA;
        }
        .module-cta a {
            background: #EF4A23 !important;
            color: white !important;
        }
        .search-bar form {
            width: 100%;
            position: relative;
        }

        #searchInput {
            width: 79%;
        }
        #store-list {
            width: 25%;
            padding: 20px;
            background-color: #f8f9fa;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            max-height: 100%;
        }

        #map {
            width: 75%;
            height: 100%;
        }

        .store-item {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .store-name {
             cursor: pointer;
        }

        .store-item:hover {
            background-color: #e2e6ea;
        }

        .call-button {
            background-color: #EF4A23;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .call-button:hover {
            background-color: #d9441d;
        }

        .search-bar {
            display: flex;
            margin-bottom: 20px;
        }

        .search-bar input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
            outline: none;
        }

        .search-bar button {
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #0056b3;
        }

        /* Autocomplete styling */
        #autocompleteResults {
            position: absolute;
            background-color: #ffffff;
            border: 1px solid #ddd;
            width: 20%;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            margin-top: 50px;
        }

        .autocomplete-result-item {
            padding: 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .autocomplete-result-item:hover {
            background-color: #f1f1f1;
        }

        .rack-info {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .rack-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 10px;
        }

        .info-window-content {
            max-width: 300px;
            max-height: 400px;
            overflow-y: auto;
        }

        .price-info {
            font-size: 0.9em;
            color: #666;
            margin: 5px 0;
        }

        .price-highlight {
            color: #EF4A23;
            font-weight: bold;
        }
    </style>

    <div id="container">
        <div id="store-list">
            <!-- Search Bar -->
            <div class="search-bar">
                <form method="GET" action="">
                    <input type="text" name="search" id="searchInput" value="{{ request()->get('search', '') }}" placeholder="Search for stores...">
                    <button style="background:#EF4A23" type="submit">Search</button>
                </form>
                <div id="autocompleteResults" style="display:none;"></div>
            </div>

            <!-- Store List -->
            <div id="stores">
                @foreach ($stores as $store)
                    <div class="store-item" data-lat="{{ $store->latitude }}" data-lng="{{ $store->longitude }}">
                        <div>
                            <strong class="store-name">{{ $store->name }}</strong><br>
                            <small>Total Racks: {{ count($store->racks) }}</small>
                        </div>
                        @if($store->whatsapp_number)
                        <a href="https://wa.me/60{{ $store->whatsapp_number }}" target="_blank" class="call-button">Call</a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div id="map"></div>
    </div>

<script>
    let map;

    window.initMap = function() {
        const defaultLocation = { lat: 3.139, lng: 101.6869 }; // Default map center
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: defaultLocation,
            styles: [
                {
                    "featureType": "all",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        { "color": "#ffffff" }
                    ]
                },
                {
                    "featureType": "all",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        { "visibility": "off" }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        { "color": "#ffbeaf" }
                    ]
                },
                {
                    "featureType": "poi",
                    "stylers": [
                        { "visibility": "off" }
                    ]
                },
                {
                    "featureType": "road",
                    "stylers": [
                        { "visibility": "on" }
                    ]
                },
                {
                    "featureType": "transit",
                    "stylers": [
                        { "visibility": "off" }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        { "color": "#F49920" }
                    ]
                }
            ]
        });

        const stores = @json($stores);

        function createInfoWindowContent(store) {
            let content = `
                <div class="info-window-content">
                    <h5 style="color: #EF4A23; margin-bottom: 10px;">${store.name}</h5>
                    <p style="margin-bottom: 15px;"><strong>Address:</strong> ${store.address}</p>
            `;

            if (store.racks && store.racks.length > 0) {
                content += '<h6 style="margin-top: 15px; border-top: 1px solid #ddd; padding-top: 10px;">Available Racks:</h6>';
                
                store.racks.forEach(rack => {
                    content += `
                        <div class="rack-info">
                            <div style="display: flex; align-items: start;">
                                ${rack.photo ? 
                                    `<img src="/storage/${rack.photo}" class="rack-image" alt="${rack.name}">` : 
                                    '<div class="rack-image" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center;">No Image</div>'
                                }
                                <div style="flex-grow: 1;">
                                    <strong>${rack.name}</strong>
                                    <div class="price-info">
                                        ${rack.price_per_day ? `<div>Daily: <span class="price-highlight">RM ${parseFloat(rack.price_per_day).toFixed(2)}</span></div>` : ''}
                                        ${rack.price_per_week ? `<div>Weekly: <span class="price-highlight">RM ${parseFloat(rack.price_per_week).toFixed(2)}</span></div>` : ''}
                                        ${rack.price_per_month ? `<div>Monthly: <span class="price-highlight">RM ${parseFloat(rack.price_per_month).toFixed(2)}</span></div>` : ''}
                                    </div>
                                    <div style="font-size: 0.85em; color: #666;">
                                        Size: ${rack.length}m × ${rack.width}m<br>
                                        Capacity: ${rack.capacity} units
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
            } else {
                content += '<p>No racks available at this location.</p>';
            }

            content += '</div>';
            return content;
        }

        stores.forEach(store => {
            const marker = new google.maps.Marker({
                position: { lat: parseFloat(store.latitude), lng: parseFloat(store.longitude) },
                map: map,
                title: store.name,
            });

            const infowindow = new google.maps.InfoWindow({
                content: createInfoWindowContent(store),
                maxWidth: 350
            });

            marker.addListener('click', () => {
                infowindow.open(map, marker);
                map.setZoom(15);
                map.setCenter(marker.getPosition());
            });
        });

        document.querySelectorAll('.store-item .store-name').forEach(item => {
            item.addEventListener('click', () => {
                const parent = item.closest('.store-item');
                const lat = parseFloat(parent.getAttribute('data-lat'));
                const lng = parseFloat(parent.getAttribute('data-lng'));

                map.setZoom(15);
                map.setCenter({ lat, lng });
            });
        });

        const input = document.getElementById('searchInput');
        const autocompleteResults = document.getElementById('autocompleteResults');

        function clearResults() {
            autocompleteResults.innerHTML = '';
            autocompleteResults.style.display = 'none';
        }

        async function fetchCustomStoreData(query) {
            const response = await fetch(`/search-retail-names?query=${query}`);
            return response.json();
        }

        function displayPlacesAutocomplete(query) {
            const service = new google.maps.places.AutocompleteService();
            service.getPlacePredictions(
                { 
                    input: query,
                    componentRestrictions: { country: 'MY' } // Restrict to Malaysia
                },
                (predictions, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK && predictions) {
                    const placeResults = predictions.map(prediction => ({
                        description: prediction.description,
                        place_id: prediction.place_id
                    }));
                    displayResults(placeResults, 'places');
                }
            });
        }

        async function displayResults(results, source) {
            results.forEach(result => {
                const resultItem = document.createElement('div');
                resultItem.classList.add('autocomplete-result-item');

                if (source === 'custom') {
                    resultItem.innerHTML = `<strong>${result.name}</strong>, <small>${result.address}</small>`;
                    resultItem.addEventListener('click', () => {
                        input.value = result.name;
                        autocompleteResults.style.display = 'none';
                        map.setCenter({ lat: parseFloat(result.latitude), lng: parseFloat(result.longitude) });
                        map.setZoom(15);

                        const marker = new google.maps.Marker({
                            position: { lat: parseFloat(result.latitude), lng: parseFloat(result.longitude) },
                            map: map,
                            title: `${result.name}, ${result.address}`,
                        });

                        const infowindow = new google.maps.InfoWindow({
                            content: `<b>${result.name}</b><br>${result.address}`
                        });

                        infowindow.open(map, marker);
                    });
                } else if (source === 'places') {
                    resultItem.innerHTML = `<small>${result.description}</small>`;
                    resultItem.addEventListener('click', () => {
                        input.value = result.description;
                        autocompleteResults.style.display = 'none';

                        const placesService = new google.maps.places.PlacesService(map);
                        placesService.getDetails({ placeId: result.place_id }, (place, status) => {
                            if (status === google.maps.places.PlacesServiceStatus.OK && place.geometry) {
                                map.setCenter(place.geometry.location);
                                map.setZoom(15);

                                const marker = new google.maps.Marker({
                                    position: place.geometry.location,
                                    map: map,
                                    title: result.description,
                                });

                                const infowindow = new google.maps.InfoWindow({
                                    content: `<b>${result.description}</b><br>${place.formatted_address}`
                                });

                                infowindow.open(map, marker);
                            }
                        });
                    });
                }

                autocompleteResults.appendChild(resultItem);
            });

            autocompleteResults.style.display = 'block';
        }

        input.addEventListener('input', async () => {
            const query = input.value.trim();
            if (!query) {
                clearResults();
                return;
            }

            autocompleteResults.innerHTML = '';
            const customStores = await fetchCustomStoreData(query);
            displayResults(customStores, 'custom');
            displayPlacesAutocomplete(query);
        });

        document.addEventListener('click', (e) => {
            if (!input.contains(e.target) && !autocompleteResults.contains(e.target)) {
                clearResults();
            }
        });
    };
</script>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFmDPs9yBFzKNC6o0ozgOP5c_Rmrz7F1k&libraries=places&callback=initMap"></script>
@endsection
