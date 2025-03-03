<style>
    .container {
        background-color: #f0f4f7;
        padding: 20px;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .btn-warning {
        background-color: #f0ad4e;
        border: none;

    }

    .btn-warning:hover {
        background-color: #ec971f;

    }
</style>
@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <div class="col-lg-12">
        <div class="col-md-6 text-left mb-2">

        </div>
        <div class="card shadow mb-4">
            <!-- Nav link -->
            <div class="card-header py-3 mb-4">
                <div class="row ml-2">
                    <a href="{{ route('request') }}"><i class="fas fa-solid fa-chevron-left"></i> Warehouse Storage Requests</a> &nbsp;
                    <div class="small-text"> </div>
                    <div class="ml-auto mr-4">
                        <div class="row">

                            @if ($request->status == 'Pending Approval')
                            <form action="{{ route('reject', $id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                @csrf
                                <button type="submit" class="btn btn-secondary mr-2">Reject</button>
                            </form>
                            <form action="{{ route('accept', $id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                @csrf
                                <button type="submit" class="btn btn-warning">Accept</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card mt-4 mb-4">
                    <div class="card-body">
                        <div class="card alert-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title mb-2">You received a Warehouse Usage Request from:</h6>
                                        <div class="row">
                                            <div class="col-md-3">
                                                @if(isset($request->user->photo))
                                                <img id="profilePhoto" src="{{ asset('storage/'. $request->user->photo) }}" class="rounded" alt="Profile Photo" style="width: 70px; height: auto;">
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <p class="card-text mb-0"><small>{{ $request->user->name }} <br> {{ $request->user->email }}</small></p>
                                                <p class="card-text"><small></small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('contact', $request->user->phone) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Contact Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <table id="example" class="table table-borderless mt-4" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>SKU</th>
                                    <th>Qty</th>
                                    <th>Product Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warehouseRequests as $request)
                                @foreach ( $request->product_request as $productrequest)
                                <tr>
                                    <td> {{ $productrequest->product->name ?? ''}} </td>
                                    <td>
                                        @php
                                            $images = optional($productrequest->product)->image ? json_decode($productrequest->product->image, true) : null;
                                        @endphp

                                        @if (!empty($images) && is_array($images) && !empty($images[0]))
                                            <img src="{{ asset($images[0]) }}" alt="Main Photo" style="width: 50px; height: auto;">
                                        @else
                                            <img src="{{ asset('asset/img/default.png') }}" alt="Default Photo" style="width: 50px; height: auto;">
                                        @endif
                                    </td>

                                    <td> {{ $productrequest->product->sku ?? ''}} - {{ $productrequest->variation->model_sku ?? ''}} </td>
                                    <td> {{$productrequest->qty}} </td>
                                    <td> {{ $productrequest->product->consumer_price ?? ''}} </td>
                                </tr>
                                @endforeach
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

            <!-- end card tim saya -->
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