<div>
    <div
        x-data="{
            lat: @entangle($getStatePath('latitude')),
            lng: @entangle($getStatePath('longitude')),
            mapLoaded: false,

            initMap() {
                const defaultLat = this.lat || 3.139003;
                const defaultLng = this.lng || 101.686855;

                const mapOptions = {
                    center: {
                        lat: parseFloat(defaultLat),
                        lng: parseFloat(defaultLng)
                    },
                    zoom: 12
                };

                const map = new google.maps.Map(this.$refs.map, mapOptions);

                const marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(defaultLat),
                        lng: parseFloat(defaultLng)
                    },
                    map: map,
                    draggable: true
                });

                google.maps.event.addListener(map, 'click', (event) => {
                    marker.setPosition(event.latLng);
                    this.lat = event.latLng.lat();
                    this.lng = event.latLng.lng();
                });

                google.maps.event.addListener(marker, 'dragend', () => {
                    this.lat = marker.getPosition().lat();
                    this.lng = marker.getPosition().lng();
                });

                const input = this.$refs.searchInput;
                const searchBox = new google.maps.places.SearchBox(input);

                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                map.addListener('bounds_changed', () => {
                    searchBox.setBounds(map.getBounds());
                });

                searchBox.addListener('places_changed', () => {
                    const places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    const bounds = new google.maps.LatLngBounds();

                    places.forEach((place) => {
                        if (!place.geometry || !place.geometry.location) {
                            console.log('Returned place contains no geometry');
                            return;
                        }

                        marker.setPosition(place.geometry.location);
                        this.lat = place.geometry.location.lat();
                        this.lng = place.geometry.location.lng();

                        if (place.geometry.viewport) {
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });

                    map.fitBounds(bounds);
                });

                this.mapLoaded = true;
            },

            loadGoogleMaps() {
                if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
                    const script = document.createElement('script');
                    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAFmDPs9yBFzKNC6o0ozgOP5c_Rmrz7F1k&libraries=places';
                    script.async = true;
                    script.defer = true;

                    script.onload = () => {
                        this.initMap();
                    };

                    document.head.appendChild(script);
                } else {
                    this.initMap();
                }
            }
        }"
        x-init="loadGoogleMaps()"
        class="mb-4"
    >
        <input
            x-ref="searchInput"
            type="text"
            placeholder="Search for a location"
            class="w-full p-2 mb-4 border rounded"
        >

        <div
            x-ref="map"
            class="w-full h-96 border rounded"
        ></div>

        <div class="mt-3 flex space-x-4">
            <div class="w-1/2">
                <label class="block text-sm font-medium text-gray-700">Latitude</label>
                <input
                    type="text"
                    x-model="lat"
                    class="mt-1 block w-full p-2 border rounded"
                    readonly
                >
            </div>
            <div class="w-1/2">
                <label class="block text-sm font-medium text-gray-700">Longitude</label>
                <input
                    type="text"
                    x-model="lng"
                    class="mt-1 block w-full p-2 border rounded"
                    readonly
                >
            </div>
        </div>
    </div>
</div>
