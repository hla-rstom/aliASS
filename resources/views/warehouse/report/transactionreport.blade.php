@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-between">
        <h6 class="h3 mb-3 text-gray-800 ml-3">Report Transacation</h6>
        <div class="col-lg-6 text-right mt-4 mb-4">
            <form action="{{ route('warehousetransactionexport') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-primary mr-2">
                    <i class="fas fa-solid fa-download"></i> Download Report
                </button>
            </form>


        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="col-lg-12 ml-4 mb-4">
                    <form action="{{ route('warehousetransactionreport') }}" method="GET">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="">Seller</label>
                                <select class="form-control" name="seller">
                                    <option value="All">All</option>
                                    @foreach ($transactions as $transaction)
                                    <option value="{{$transaction->seller->id}}">{{$transaction->seller->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- <div class="form-group col-md-3">
                            <label for="">SKU</label>
                            <select class="form-control" id="select3-sort">
                                <option value="all">All</option>
                            </select>
                        </div> -->
                            <div class="form-group col-md-3">
                                <label for="">Date Range</label><br>
                                <input type="text" class="form-control" id="dateRange" name="date_range" value="{{ request('date_range') }} placeholder=" Search by Date">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="" class="mb-4" style="margin: 9;"></label><br>
                                <div class="input-group justify-content-end">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}" aria-label="Search" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="mb-4" for=""></label>
                                <button type="submit" class="btn btn-primary ml-4 btn-block">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row ml-4">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Invoice</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Seller</th>
                                    <th scope="col">Recipients</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction )
                                <tr>
                                    <!-- <td><i class="fas fa-solid fa-file-import"></i></td> -->
                                    <td>{{$transaction->invoice_code}}</td>
                                    <td>{{$transaction->date}}</td>
                                    <td>{{$transaction->seller->name ?? ''}}</td>
                                    <td>{{$transaction->recipientransaction->name}}</td>
                                    <td>
                                        @switch($transaction->status)
                                        @case(1)
                                        <span class="badge badge-secondary">Not Picked</span>
                                        @break
                                        @case(2)
                                        <span class="badge badge-warning">Ready to Pack</span>
                                        @break
                                        @case(3)
                                        @case(4)
                                        @case(5)
                                        <span class="badge badge-success">
                                            @if ($transaction->status == 3)
                                            Packed
                                            @elseif ($transaction->status == 4)
                                            Request Pick Up
                                            @else
                                            Done
                                            @endif
                                        </span>
                                        @break
                                        @case(7)
                                        <span class="badge badge-danger">Return</span>
                                        @break
                                        @default
                                        <span class="badge badge-info">Unknown Status</span>
                                        @endswitch
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
    $('#dateRange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $(function() {
        $('input[name="date_range"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>

@endsection