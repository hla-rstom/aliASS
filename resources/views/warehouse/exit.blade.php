@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-between">
        <div class="col-lg-6">
            <h6 class="h3 mb-3 text-gray-800 ml-3">Warehouse Exit List</h6>
        </div>

    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="col-lg-6">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select class="form-control" id="warehouseDropdown">
                                <option value="all">All Warehouse</option>
                                <!-- Add other warehouse options here -->
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <input type="text" class="form-control" name="daterange" id="dateSearch" placeholder="Search by Date">

                        </div>
                        <div class="form-group col-md-3">
                            <select class="form-control" id="statusDropdown">
                                <option value="all">All Status</option>
                                <!-- Add other status options here -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row ml-4">
                    <div class="col-lg-11">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No Transaction</th>
                                    <th scope="col">Qty SKU</th>
                                    <th scope="col">Qty Item</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction )
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$transaction->invoice_code}}</td>
                                    <td>{{$totalProducts}}</td>
                                    <td>{{$totalQty}}</td>
                                    <td> @php
                                        $statusClasses = [
                                        1 => 'badge-secondary',
                                        2 => 'badge-primary',
                                        'READY_TO_SHIP' => 'badge-warning',
                                        4 => 'badge-success',
                                        5 => 'badge-success',
                                        ];
                                        $statusTexts = [
                                        1 => 'Ready to Process',
                                        2 => 'Being Processed',
                                        'READY_TO_SHIP' => 'Ready to Ship',
                                        4 => 'Shipped',
                                        5 => 'Done',
                                        ];
                                        $statusClass =
                                        $statusClasses[$transaction->status] ??
                                        'badge-secondary';
                                        $statusText =
                                        $statusTexts[$transaction->status] ??
                                        'Unknown Status';
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker();
    });
</script>
@endsection