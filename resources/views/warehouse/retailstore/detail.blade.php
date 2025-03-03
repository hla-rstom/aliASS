@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <h6 class="h3 mb-3 text-gray-800 ml-3">Details Store</h6>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="col-lg-12">
                <div class="card-body">
                    <h5>Name: {{ $store->name }}</h5>
                    <p  style="width: 100%;">Address: {{ $store->address }}</p>
                    <p  style="width: 100%;">Description: {{ $store->description }}</p>
                    <button id="toggleMap" class="btn btn-primary">Show Location on Map</button>
                    <div id="map" style="width: 100%; height: 400px; display: none;" class="mt-4 mb-4"></div>
                    <a href="{{ route('retailstore') }}" class="btn btn-secondary">Back to Stores</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">            
            <div class="col-lg-12">
               <div class="mb-4 mt-4">
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-solid fa-plus"></i> Add Rack</button>
                </div>
                <!-- Modal add-->
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Add rack</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('rackstore') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                    @csrf
                                    <input type="hidden" name="retail_store_id" value="{{ $store->id }}" />
                                    <div class="mb-3">
                                        <label class="small mb-1" for="name">Name <span class="text-danger">*</span></label>
                                        <input class="form-control form-control-solid @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="" value="{{ old('name') }}" />
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Pricing Section -->
                                    <div class="mb-3">
                                        <label class="small mb-1">Pricing (at least one is required)</label>
                                        <div class="pricing-container">
                                            <!-- Per Day Price -->
                                            <div class="mb-2">
                                                <label class="small mb-1" for="price_per_day">Price Per Day</label>
                                                <input class="form-control form-control-solid @error('price_per_day') is-invalid @enderror" 
                                                    id="price_per_day" 
                                                    name="price_per_day" 
                                                    type="number" 
                                                    step="0.01"
                                                    min="0"
                                                    placeholder="Enter daily price" 
                                                    value="{{ old('price_per_day') }}" />
                                                @error('price_per_day')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <!-- Per Week Price -->
                                            <div class="mb-2">
                                                <label class="small mb-1" for="price_per_week">Price Per Week</label>
                                                <input class="form-control form-control-solid @error('price_per_week') is-invalid @enderror" 
                                                    id="price_per_week" 
                                                    name="price_per_week" 
                                                    type="number" 
                                                    step="0.01"
                                                    min="0"
                                                    placeholder="Enter weekly price" 
                                                    value="{{ old('price_per_week') }}" />
                                                @error('price_per_week')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <!-- Per Month Price -->
                                            <div class="mb-2">
                                                <label class="small mb-1" for="price_per_month">Price Per Month</label>
                                                <input class="form-control form-control-solid @error('price_per_month') is-invalid @enderror" 
                                                    id="price_per_month" 
                                                    name="price_per_month" 
                                                    type="number" 
                                                    step="0.01"
                                                    min="0"
                                                    placeholder="Enter monthly price" 
                                                    value="{{ old('price_per_month') }}" />
                                                @error('price_per_month')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            @error('pricing')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="small mb-1" for="length">Length <span class="text-danger">*</span></label>
                                        <input class="form-control form-control-solid @error('length') is-invalid @enderror" id="length" name="length" type="text" placeholder="" value="{{ old('length') }}" />
                                        @error('length')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="width">Width <span class="text-danger">*</span></label>
                                        <input class="form-control form-control-solid @error('width') is-invalid @enderror" id="width" name="width" type="text" placeholder="" value="{{ old('width') }}" />
                                        @error('width')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="capacity">Capacity <span class="text-danger">*</span></label>
                                        <input class="form-control form-control-solid @error('capacity') is-invalid @enderror" id="capacity" name="capacity" type="text" placeholder="" value="{{ old('capacity') }}" />
                                        @error('capacity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="small mb-1" for="addPhoto">Add Photo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" name="photo" id="addPhoto" aria-describedby="inputGroupFileAddon01" accept="image/*">
                                            <label class="custom-file-label" for="addPhoto">Choose file</label>
                                        </div>
                                        <img id="addPhotoPreview" src="#" alt="Add Image Preview" style="display: none; margin-top: 10px; max-width: 100%; height: auto;"/>
                                        @error('photo')
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


                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>                            
                            <th scope="col">Image</th>                            
                            <th scope="col">Length</th>
                            <th scope="col">Width</th>
                            <th scope="col">Capacity</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($store->racks as $rack)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                            @if($rack->photo)
                                <img src="{{ asset('storage/' . $rack->photo) }}" alt="{{ $rack->name }}" style="max-width: 100px; max-height: 100px;" class="img-fluid">
                            @else
                                <span>No Image</span>
                            @endif
                            </td>
                            <td class="col-2">{{ $rack->name }}</td>
                            <td>{{ $rack->length }}</td>
                            <td>{{ $rack->width }}</td>
                            <td>{{ $rack->capacity }}</td>
                            <td class="col-1">
                                <div class="row">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#updateModal{{$rack->id}}"><i class="fas fa-solid fa-user-edit"></i></button>


                                    <div class="modal fade" id="updateModal{{$rack->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel">Update Rack</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('rackupdate', $rack->id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3">
                                                            <label class="small mb-1" for="name">Name <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-solid @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="" value="{{ old('name', $rack->name) }}" />
                                                            @error('name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <!-- Pricing Section -->
                                                        <div class="mb-3">
                                                            <label class="small mb-1">Pricing (at least one is required)</label>
                                                            <div class="pricing-container">
                                                                <!-- Per Day Price -->
                                                                <div class="mb-2">
                                                                    <label class="small mb-1" for="price_per_day">Price Per Day</label>
                                                                    <input class="form-control form-control-solid @error('price_per_day') is-invalid @enderror" 
                                                                        id="price_per_day" 
                                                                        name="price_per_day" 
                                                                        type="number" 
                                                                        step="0.01"
                                                                        min="0"
                                                                        placeholder="Enter daily price" 
                                                                        value="{{ old('price_per_day', $rack->price_per_day) }}" />
                                                                    @error('price_per_day')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Per Week Price -->
                                                                <div class="mb-2">
                                                                    <label class="small mb-1" for="price_per_week">Price Per Week</label>
                                                                    <input class="form-control form-control-solid @error('price_per_week') is-invalid @enderror" 
                                                                        id="price_per_week" 
                                                                        name="price_per_week" 
                                                                        type="number" 
                                                                        step="0.01"
                                                                        min="0"
                                                                        placeholder="Enter weekly price" 
                                                                        value="{{ old('price_per_week', $rack->price_per_week) }}" />
                                                                    @error('price_per_week')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Per Month Price -->
                                                                <div class="mb-2">
                                                                    <label class="small mb-1" for="price_per_month">Price Per Month</label>
                                                                    <input class="form-control form-control-solid @error('price_per_month') is-invalid @enderror" 
                                                                        id="price_per_month" 
                                                                        name="price_per_month" 
                                                                        type="number" 
                                                                        step="0.01"
                                                                        min="0"
                                                                        placeholder="Enter monthly price" 
                                                                        value="{{ old('price_per_month', $rack->price_per_month) }}" />
                                                                    @error('price_per_month')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>

                                                                @error('pricing')
                                                                <div class="text-danger small">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="small mb-1" for="length">Length <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-solid @error('length') is-invalid @enderror" id="length" name="length" type="text" placeholder="" value="{{ old('length', $rack->length) }}" />
                                                            @error('length')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="small mb-1" for="width">Width <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-solid @error('width') is-invalid @enderror" id="width" name="width" type="text" placeholder="" value="{{ old('width', $rack->width) }}" />
                                                            @error('width')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="small mb-1" for="capacity">Capacity <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-solid @error('capacity') is-invalid @enderror" id="capacity" name="capacity" type="text" placeholder="" value="{{ old('capacity', $rack->capacity) }}" />
                                                            @error('capacity')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="small mb-1" for="photo">Photo</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" name="photo" id="photo" aria-describedby="inputGroupFileAddon01" accept="image/*">
                                                                <label class="custom-file-label" for="photo">Choose file</label>
                                                            </div>

                                                            <!-- Display existing image if available -->
                                                            @if($rack->photo)
                                                                <div style="margin-top: 10px;">
                                                                    <img id="existingPhoto" src="{{ asset('storage/' . $rack->photo) }}" alt="Existing Image" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            @endif

                                                            <!-- Preview for the new image -->
                                                            <img id="photoPreview" src="#" alt="Image Preview" style="display: none; margin-top: 10px; max-width: 100%; height: auto;"/>
                                                            
                                                            @error('photo')
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
                                    <form action="{{ route('rackdestroy', $rack->id) }}" method="POST" class="ml-2">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this rack?')">
                                            <i class="fas fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-end mt-4">
                                       
                </div>
            </div>
        </div>
        
    </div>
</div>
<script>
    let mapInitialized = false;

    function initMap() {
        const storeLocation = { lat: {{ $store->latitude }}, lng: {{ $store->longitude }} };

        // Buat peta dan set lokasi
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: storeLocation,
        });

        // Tambahkan marker untuk toko
        const marker = new google.maps.Marker({
            position: storeLocation,
            map: map,
            title: '{{ $store->name }}',
        });
    }

    document.getElementById('toggleMap').addEventListener('click', function () {
        const mapDiv = document.getElementById('map');
        if (mapDiv.style.display === "none") {
            mapDiv.style.display = "block"; // Tampilkan peta
            if (!mapInitialized) {
                initMap(); // Inisialisasi peta hanya sekali
                mapInitialized = true;
            }
            this.textContent = "Hide Location on Map"; // Ubah teks tombol
        } else {
            mapDiv.style.display = "none"; // Sembunyikan peta
            this.textContent = "Show Location on Map"; // Kembali ke teks awal
        }
    });
</script>
<script>
function setupPhotoPreview(inputId, previewId) {
    document.getElementById(inputId).addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result; // Set the source of the image preview to the selected file
                preview.style.display = 'block'; // Show the image preview
            }
            
            reader.readAsDataURL(file); // Convert the file to a Data URL
        } else {
            preview.src = '#'; // Reset the source if no file is selected
            preview.style.display = 'none'; // Hide the image preview
        }
    });
}

// Setup previews for both add and update inputs
setupPhotoPreview('addPhoto', 'addPhotoPreview');
setupPhotoPreview('photo', 'photoPreview');

</script>

<script>
// Function to validate prices
function validatePrices(form) {
    const pricePerDay = parseFloat(form.querySelector('[name="price_per_day"]').value) || 0;
    const pricePerWeek = parseFloat(form.querySelector('[name="price_per_week"]').value) || 0;
    const pricePerMonth = parseFloat(form.querySelector('[name="price_per_month"]').value) || 0;

    if (pricePerDay <= 0 && pricePerWeek <= 0 && pricePerMonth <= 0) {
        alert('Please enter at least one non-zero price (Daily, Weekly, or Monthly)');
        return false;
    }
    return true;
}

// Add validation to both add and update forms
document.addEventListener('DOMContentLoaded', function() {
    // Add form validation
    const addForm = document.querySelector('form[action="{{ route("rackstore") }}"]');
    if (addForm) {
        addForm.addEventListener('submit', function(e) {
            if (!validatePrices(this)) {
                e.preventDefault();
            }
        });
    }

    // Update form validation (for all update forms)
    const updateForms = document.querySelectorAll('form[action^="{{ route("rackupdate", "") }}"]');
    updateForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validatePrices(this)) {
                e.preventDefault();
            }
        });
    });

    // Add input validation to ensure non-negative numbers
    const priceInputs = document.querySelectorAll('input[name^="price_per_"]');
    priceInputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });

        // Format number with 2 decimal places when focus is lost
        input.addEventListener('blur', function() {
            if (this.value) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });
    });
});
</script>



@endsection
