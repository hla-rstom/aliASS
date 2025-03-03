<style>
    .rounded-image {
        border-radius: 50%;
        width: 100px;
        height: 100px;
    }

    .logistic-service {
        display: inline-block;
        margin-right: 10px;
    }

    .logistic-service img {
        width: 50px;
        /* or any size that fits your design */
        height: auto;
    }

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

    <h6 class="h3 mb-3 text-gray-800 ml-3">Set Your Retail Data</h6>
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('storewarehouse') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                        @csrf
                        <div class="mr-4 mt-2">
                            <div class="form-group">
                                <label class="mb-1" for="bank_name">Retail Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="mr-4 mt-2">
                            <div class="form-group">
                                <label class="mb-1" for="bank_name">Phone Number</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="mr-4 mt-2">
                            <div class="form-group">
                                <label class="mb-1" for="bank_name">Short Introduction</label>
                                <textarea class="form-control" cols="60" rows="4" placeholder="Address" name="address">{{ old('address', $warehouse->address ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="mr-4 mt-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection