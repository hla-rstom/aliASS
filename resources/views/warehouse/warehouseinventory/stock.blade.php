@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row justify-content-between">
        <h6 class="h3 mb-3 text-gray-800 ml-3">Stock</h6>
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
                                <th>Qty SKU</th>
                                <th>Qty Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sellerTotals as $sellerId => $totals)
                            <tr>
                                <td><a href="{{route('detailStock',$sellerId)}}">{{ $totals['seller_name'] }}</a></td>
                                <td></td>
                                <td>{{ $totals['total_products'] }}</td>
                                <td>{{ $totals['total_stock'] }}</td>
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