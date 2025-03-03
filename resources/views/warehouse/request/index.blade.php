@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <div class="row justify-content-between">
        <h6 class="h3 mb-3 text-gray-800 ml-3">Storage Requests</h6>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="tab-content col-md-12">

                    <table id="example" class="table table-borderless" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Seller</th>
                                <th>Barcode Type</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warehouseRequests as $request)
                            <tr>
                                <td> <a href="{{ route('detail', $request->id)}}">{{ $request->user->name ?? ''}}</a> </td>
                                <td></td>
                                <td> {{ $request->date ?? '' }} </td>
                                <td> {{ $request->status ?? ''}} </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    });
</script>


@endsection