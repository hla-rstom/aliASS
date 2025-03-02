@extends('index')

@section('content')
<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('productCategory.update', $productCategory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-xl-8">
                <!-- BEGIN: seller Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Seller Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="name">Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="" value="{{ old('name', $productCategory->name) }}" />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('category') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: seller Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection