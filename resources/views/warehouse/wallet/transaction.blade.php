@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-4">
            <div class="row ml-2">
                <a href="{{ url()->previous() }}"><i class="fas fa-solid fa-chevron-left"></i> Wallet</a> &nbsp;
                <div class="small-text"> </div>

            </div>
            <div class="card mt-4 mb-4">
                <div class="card-body">

                    <h6><strong>Transaction History</strong></h6>
                    <table id="example" class="table table-borderless mt-4" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Date</th>
                                <th>Balance</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($wallets))
                            @foreach ($wallets as $wallet)
                            <tr>
                                <td>{{ $wallet->date }}</td>
                                <td>
                                    @if ($wallet->action === 'increment')
                                    <div class="fa fa-plus text-success"></div>
                                    @else
                                    <div class="fa fa-minus text-danger"></div>
                                    @endif
                                    {{ number_format($wallet->balance, 2) }}

                                </td>

                                <td>
                                    @if ($wallet->type === 'warehouse_order_percentage')
                                    Fee Order Invoice : {{ $wallet->description_param }}
                                    @elseif ($wallet->type == 'storage_cost')
                                    Storage Cost fee
                                    @else

                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-end">
                        {{ $wallets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection