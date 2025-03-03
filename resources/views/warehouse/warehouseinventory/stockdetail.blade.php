<style>
    .qty-input {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-input input {
        text-align: center;
        margin: 0 5px;
        width: 50px;
        /* You can adjust the width as needed */
    }
</style>
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

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="danger-alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="col-md-4 ml-2">
            <h3 class=" text-gray-800">Stock Detail</h3>
            <a href="{{ route('warehouseStock') }}"><i class="fas fa-solid fa-chevron-left"></i> Stock </a>
        </div>
        <div class="text-right">
            <!-- <button type="button" class="btn btn-outline-primary">Manual Update</button> -->
            <button type="button" class="btn btn-primary">Export</button>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="tab-content col-md-12">
                    <form action="{{ route('updateStock') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                        @csrf
                        <table id="example" class="table table-borderless" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>Sku</th>
                                    <th>Product Name</th>
                                    <th>Stock Seller</th>
                                    <th>Stock Warehouse</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                <tr>
                                    <td>{{ $stock->product->sku ?? 'No SKU' }}</td>
                                    <td>{{ $stock->product->name ?? 'Unknown Product' }}</td>
                                    <td></td>
                                    <td class="qty-input">
                                        <input type="hidden" name="original_qty[{{ $stock->id }}]" value="{{ $stock->qty }}">
                                        <input type="hidden" name="stock_id[]" value="{{ $stock->id }}">

                                        <button type="button" class="btn btn-outline-primary minus-btn" data-id="{{ $stock->id }}">-</button>
                                        <input type="text" class="form-control" name="qty[{{ $stock->id }}]" id="qtyupdate{{ $stock->id }}" value="{{ $stock->qty }}">
                                        <button type="button" class="btn btn-outline-primary plus-btn" data-id="{{ $stock->id }}">+</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" data-id="{{ $stock->id }}">Save Manual Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        document.querySelectorAll('.minus-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const input = document.getElementById('qtyupdate' + id);
                const currentValue = parseInt(input.value, 10);
                if (currentValue > 0) {
                    input.value = currentValue - 1;
                }
            });
        });

        document.querySelectorAll('.plus-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const input = document.getElementById('qtyupdate' + id);
                input.value = parseInt(input.value, 10) + 1;
            });
        });
    });
</script>


@endsection