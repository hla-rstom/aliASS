@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')
    <h6 class="h3 mb-3 text-gray-800 ml-3">Stock Mutation List</h6>
    <div class="row justify-content-between">
        <div class="col-lg-4">
            <div class="form-group col-md-8">
                <label for="">Choose Warehouse</label>
                <select class="form-control" id="filter-dropdown">
                    <option value="">-Choose-</option>
                    @foreach ($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}"> {{ $warehouse->name }} </option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>

    <div class="tab-content">
        <div class="tab-pane fade {{ !request()->filled('tab') || request()->input('tab') === 'summary' ? 'show active' : '' }}" id="summary" role="tabpanel" aria-labelledby="summary-tab">
            <div class="row ml-4">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="col-lg-12 ml-4 mb-4">
                                <div class="card-header mb-4">
                                    <div class="row justify-content-between">
                                        <h6 class="mb-3 text-gray-800 text-md font-weight-bold">Stock Mutation</h6>
                                        <button type="button" class="btn btn-primary mr-2">
                                            <i class="fas fa-solid fa-download"></i> Download Stock
                                        </button>
                                    </div>
                                </div>
                                @include('partials._filter_stocklist')
                            </div>
                            <div class="row ml-4">
                                <div class="col-lg-12">
                                    <ul class="mb-3 p-0 d-flex align-content-center gap-2">
                                        <a class="btn rounded-pill fw-bold border-2 border-primary text-primary active" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">
                                            Summary
                                        </a>
                                        <a class="btn text-secondary" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="true">
                                            History
                                        </a>
                                    </ul>
                                    <table class="table" id="summaryTable">
                                        <thead class="thead-light">
                                            <tr>

                                                <th>Product</th>
                                                <th>Early Stock</th>
                                                <th>Last Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stockMutations as $stockMutation)
                                            <tr>
                                                <td>{{ $stockMutation->product->name ?? '-' }}</td>
                                                <td style="font-size: 1rem">{{ $stockMutation->early_stock }}</td>
                                                <td class="d-flex align-items-center" style="gap: .5rem;font-size: 1rem">
                                                    <span class="d-block" style="width: 2.5rem;">
                                                        {{ $stockMutation->last_stock }}
                                                    </span>
                                                    @if ($stockMutation->type === 'inbound' || $stockMutation->type === 'stock_in')
                                                    <div class="fa fa-arrow-up text-success"></div>
                                                    @else
                                                    <div class="fa fa-arrow-down text-danger"></div>
                                                    @endif
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
        </div>
        <div class="tab-pane fade {{ request()->input('tab') === 'history' ? 'show active' : '' }}" id="history" role="tabpanel" aria-labelledby="history-tab">
            <div class="row ml-4">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="col-lg-12 ml-4 mb-4">
                                <div class="card-header mb-4">
                                    <div class="row justify-content-between">
                                        <h6 class="mb-3 text-gray-800 text-md font-weight-bold">Stock Mutation</h6>
                                        <button type="button" class="btn btn-primary mr-2">
                                            <i class="fas fa-solid fa-download"></i> Download Stock
                                        </button>
                                    </div>
                                </div>
                                @include('partials._filter_stocklist_history')
                            </div>
                            <div class="row ml-4">
                                <div class="col-lg-12">
                                    <ul class="mb-3 p-0 d-flex align-content-center gap-2">
                                        <a class="btn text-secondary" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">
                                            Summary
                                        </a>
                                        <a class="btn rounded-pill fw-bold border-2 border-primary text-primary active" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="true">
                                            History
                                        </a>
                                    </ul>
                                    <table class="table" id="historyTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Product</th>
                                                <th>Type</th>
                                                <th>Qty</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stockMutations as $stockMutation)
                                            <tr>
                                                <td>{{ $stockMutation->product->name ?? '' }}<br>
                                                    <span class="text-primary"><b>{{$stock->product->sku ?? ''}}</b>
                                                </td>

                                                <td>
                                                    @if ($stockMutation->type === 'inbound')
                                                    <div class="badge badge-success">Inbound</div>
                                                    @elseif ($stockMutation->type === 'stock_in')
                                                    <div class="badge badge-success">Stock IN</div>
                                                    @elseif ($stockMutation->type === 'stock_out')
                                                    <div class="badge badge-danger">Stock OUT</div>
                                                    @else
                                                    <div class="badge badge-danger">Sales</div>
                                                    @endif
                                                </td>
                                                <td>{{ $stockMutation->last_stock - $stockMutation->early_stock }}</td>
                                                <td>
                                                    @if ($stockMutation->type === 'inbound' || $stockMutation->type === 'invoice')
                                                    {{ $stockMutation->reference_code }}
                                                    @else
                                                    {{ $stockMutation->notes }}
                                                    @endif
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
        </div>
    </div>
</div>

<script>
    async function refresh_tables() {
        let response = await fetch('{{ url()->current() }}?alt=json');
        let data = await response.json();

        $("#summaryTable tbody").find("tr").remove();
        data.stockMutations.forEach(mutation => {
            $("#summaryTable tbody").append(`
                        <tr>
                            <td>${ mutation?.product?.name || "" } <br>
                                                    <span class="text-primary"><b>${ mutation?.product?.sku || "" } - ${ mutation?.variation?.model_sku || "" }</td>
                            <td>${ mutation.early_stock }</td>
                            <td class="d-flex align-items-center"
                                style="gap: .5rem;font-size: 1rem">
                                <span class="d-block" style="width: 2.5rem;">
                                    ${ mutation.last_stock }
                                </span>
                                ${ mutation.type === "inbound" ? '<div class="fa fa-arrow-up text-success"></div>' : '<div class="fa fa-arrow-down text-danger"></div>' }
                            </td>
                        </tr>
                    `);
        });

        $("#historyTable tbody").find("tr").remove();
        data.stockMutations.forEach(mutation => {
            $("#historyTable tbody").append(`
                        <tr>
                            <td>${ mutation?.product?.name || "" } <br>
                                                    <span class="text-primary"><b>${ mutation?.product?.sku || "" } - ${ mutation?.variation?.model_sku || "" }</td>
                            <td>${ mutation.type === "inbound" ? '<div class="badge badge-success">Inbound</div>' : '<div class="badge badge-danger">Sales</div>' }</td>
                            <td>${ mutation.type === "inbound" ? "+" : "-"} ${ mutation.last_stock - mutation.early_stock }</td>
                            <td> ${ mutation.reference_code }</td>
                        </tr>
                    `);
        });
    }

    // $(document).ready(async function() {
    //     setInterval(async () => {
    //         await refresh_tables();
    //     }, 1000);
    // })
</script>
@endsection