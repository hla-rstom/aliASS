@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <h6 class="h3 mb-3 text-gray-800 ml-3">Transaction List</h6>
    <div class="row">
        <div class="col-lg-4">
            <!--<div class="form-group col-md-8">-->
            <!--    <label for="">Choose Warehouse</label>-->
            <!--    <select class="form-control" id="filter-dropdown">-->
            <!--        <option value="">-Choose-</option>-->
            <!--        @foreach ($warehouses as $warehouse)-->
            <!--        <option value="{{ $warehouse->id }}"> {{ $warehouse->name }} </option>-->
            <!--        @endforeach-->

            <!--    </select>-->
            <!--</div>-->
        </div>
        <input type="hidden" id="current-tab" value="{{ request()->tab }}">
        <div class="col-lg-8 mt-4 mb-4">
            <div class="row float-right mr-4">
                <form action="{{ route('transactionexport') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-warning mr-2">
                        <i class="fas fa-solid fa-download"></i> Download Report
                    </button>
                </form>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Create Transaction
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('createtransaction') }}">Create Transaction</a>
                        <a class="dropdown-item" href="#">Repack Transit</a>
                        <a class="dropdown-item" href="#">Batch Transaction</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="col-lg-12 ml-4 mb-4">
                    <!-- Navigation Tabs -->
                    <ul class="nav nav-tabs justify-content-between" id="orderTab" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link " id="NotProcessed-tab" data-toggle="tab" href="#NotProcessed" role="tab" aria-controls="NotProcessed" aria-selected="true">Not Processed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="AllTransactions-tab" data-toggle="tab" href="#AllTransactions" role="tab" aria-controls="AllTransactions" aria-selected="false">All
                                Transactions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ReadytoProcess-tab" data-toggle="tab" href="#ReadytoProcess" role="tab" aria-controls="ReadytoProcess" aria-selected="false">Ready to Ship</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="InProcess-tab" data-toggle="tab" href="#InProcess" role="tab" aria-controls="InProcess" aria-selected="false">Processed</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="Shipped-tab" data-toggle="tab" href="#Shipped" role="tab" aria-controls="Shipped" aria-selected="false">Shipped</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">Done</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="RejectAWB-tab" data-toggle="tab" href="#RejectAWB" role="tab" aria-controls="RejectAWB" aria-selected="false">Reject AWB</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="Cancel-tab" data-toggle="tab" href="#Cancel" role="tab" aria-controls="Cancel" aria-selected="false">Cancel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Returns-tab" data-toggle="tab" href="#Returns" role="tab" aria-controls="Returns" aria-selected="false">Returns</a>
                        </li>
                    </ul>
                    @include('partials._filters_transaction')
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    @include('partials.transaction_tab.AllTransactions')
                    @include('partials.transaction_tab.NotProcessed')
                    @include('partials.transaction_tab.ReadytoProcess')
                    @include('partials.transaction_tab.InProcess')
                    @include('partials.transaction_tab.Shipped')
                    @include('partials.transaction_tab.Done')
                    <div class="tab-pane fade" id="RejectAWB" role="tabpanel" aria-labelledby="RejectAWB-tab">
                        <div class="row ml-4">
                            <div class="col-lg-12">

                            </div>
                        </div>
                    </div>
                    @include('partials.transaction_tab.Return')
                    @include('partials.transaction_tab.Cancel')

                </div>
                <!-- Modal Detail Transaction-->
                @foreach ($allTransactions as $transaction)
                <div class="modal fade" id="detail{{ $transaction->id }}" tabindex="-1" aria-labelledby="detail{{ $transaction->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detail{{ $transaction->id }}Label">
                                    Detail Transaction {{ $transaction->invoice_code }} </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                        <form action="{{ route('viewAwbdoc') }}" method="GET" target="_blank">
                                            <input type="hidden" name="ordersn" value="{{ $transaction->invoice_code }}">
                                            <button type="submit" style="background: none; border: none; padding: 0;">
                                                <img src="{{ asset('asset/img/pdf.png') }}" alt="PDF" style="width: 100px; height: auto;">
                                            </button>
                                        </form>
                                    </div>

                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-6"><strong>No Invoice</strong></div>
                                            <div class="col-6">{{ $transaction->invoice_code }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6"><strong>Transaction Date</strong>
                                            </div>
                                            <div class="col-6">{{ $transaction->date }}</div>
                                        </div>
                                        <!-- <div class="row">
                                                                                                                                                                                                                                                                        <div class="col-6"><strong>Performance</strong></div>
                                                                                                                                                                                                                                                                        <div class="col-6">6D, 07:40:21</div>
                                                                                                                                                                                                                                                                    </div> -->
                                        <div class="row">
                                            <div class="col-6"><strong>Status</strong></div>
                                            <div class="col-6">
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
                                                <span class="badge badge-info">Not Processed</span>
                                                @endswitch
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6"></div>
                                            <div class="col-6">
                                                <a href="#" id="viewDetailLink">View Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @include('partials.transaction_tab.statusProgress')
                                <hr>
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <strong>Sender</strong>
                                        <div>{{ $transaction->seller->name }}</div>
                                        <div>{{ $transaction->seller->phone }}</div>
                                    </div>
                                    <div class="col-6">
                                        <strong>Recipient</strong>
                                        <div>{{ $transaction->recipientransaction->name ?? '' }}</div>
                                        <div>{{ $transaction->recipientransaction->phone ?? '' }}</div>
                                        <div>{{ $transaction->recipientransaction->full_address ?? '' }}</div>
                                    </div>
                                </div>
                                <div class="row ml-1">
                                    <strong>Product Shipped</strong>
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">No SKU</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaction->producttransaction as $producttransaction)
                                            <tr>
                                                @if ($producttransaction->product)
                                                <td>{{ $producttransaction->product->name ?? '' }}</td>
                                                <td>{{ $producttransaction->product->sku ?? '' }}</td>
                                                <td>MYR {{ $producttransaction->product->consumer_price ?? '' }}</td>
                                                <td>{{ $producttransaction->qty ?? '' }}</td>
                                                <td>MYR {{ $producttransaction->qty * $producttransaction->product->consumer_price }}</td>
                                                @else
                                                <td colspan="5">No product found !</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                                <td><strong>MYR {{ $transaction->total_amount ?? '' }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="row ml-1">
                                    <strong>Packaging</strong>
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Packaging</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaction->packagingtransaction as $packagingtransaction)
                                            <tr>
                                                <td>{{ $packagingtransaction->packaging->name }} </td>
                                                <td>MYR
                                                    {{ $packagingtransaction->packaging->price }}
                                                </td>
                                                <td>{{ $packagingtransaction->qty }}</td>
                                                <td>MYR {{ $packagingtransaction->packagingTotal }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="container">
                                    <div class="row mb-2">
                                        <div class="col-8 text-right">
                                            <p>Subtotal Packaging*</p>
                                            <p>Cost Transaction*</p>
                                            <p>Cost Shipping Label*</p>
                                            <p>Cost QC*</p>
                                            <p>Cost Logistic</p>
                                        </div>
                                        <div class="col text-right">
                                            <p>MYR {{ $transaction->payment->warehouse_packaging	?? '' }}</p>
                                            <p>MYR {{ $transaction->payment->order_fulhive ?? '' }}</p>
                                            <p>MYR 0</p>
                                            <p>MYR 0</p>
                                            <p>MYR 0</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 text-right">
                                            <h5>Total</h5>
                                        </div>
                                        <div class="col text-right">
                                            <h5> {{$transaction->currency}} {{ $transaction->payment->total_transaction ?? '' }}</h5>
                                        </div>
                                    </div>
                                    <div class="row text-right">
                                        <div class="col">
                                            <p class="text-muted"><small>*Prices above are
                                                    inclusive of applicable VAT</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                                                                                                                                                                                                                                                            <button type="button" class="btn btn-secondary">Close</button>
                                                                                                                                                                                                                                                            <button id="submitModal" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                                                                                                                                                                                                                                                        </div> -->
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#warehouse-dropdown').change(function() {
            var warehouseId = $(this).val();

            if (warehouseId) {
                $.ajax({
                    url: '/getstock',
                    type: 'GET',
                    data: {
                        id: warehouseId
                    },
                    dataType: 'json',
                    success: function(data) {
                        populateSearchResults(data);
                    },
                    error: function() {
                        $('#searchResults').html('<p>Error fetching warehouse data.</p>');
                    }
                });
            } else {
                $('#searchResults').empty();
            }
        });

        // Handle search within the selected warehouse's stock
        $('#searchInput').keyup(function() {
            var query = $(this).val();
            var warehouseId = $('#warehouse-dropdown').val();
            $.ajax({
                url: '/getstock',
                type: 'GET',
                data: {
                    query: query,
                    warehouse_id: warehouseId // assuming your API needs the warehouse ID
                },
                success: function(data) {
                    populateSearchResults(data);
                },
                error: function() {
                    $('#searchResults').html('<p>Error fetching search results.</p>');
                }
            });
        });

        // Function to populate search results
        function populateSearchResults(data) {
            var html = '';
            $.each(data, function(index, item) {
                html += `<tr>
                <td>${item.product.name} <br> ${item.product.sku}</td>
                <td>${item.qty}</td>
                <td>
                    <div class="col-md-6">
                        <input type="hidden" name="product_id[]" value="${item.product.id}">
                        <input type="number" name="qty[]" class="form-control">
                    </div>
                </td>
                <td></td>
                <td></td>
            </tr>`;
            });
            $('#searchResults').html(html);
        }


    });

    async function refresh_tables() {
        let response = await fetch('{{ url()->current() }}?alt=json');
        let data = await response.json();

        function render_transaction(selector, transactions) {
            $(selector).find("tr").remove();
            transactions.forEach(transaction => {
                $(selector).append(`
                        <tr>
                            <td>${ transaction.invoice_code }</td>
                            <td>${ transaction.date }</td>
                            <td></td>
                            <td></td>
                            <td>${ transaction.total }</td>
                            <td>${ transaction.awbtransaction?.no_resi || '' }</td>
                            <td>${ transaction.recipientransaction.name }</td>
                        </tr>
                    `);
            });
        }


        render_transaction("#ReadytoProcess table tbody", data.transactions1)
        render_transaction("#InProcess table tbody", data.transactions2)
        render_transaction("#ReadytoShip table tbody", data.transactions3)
        render_transaction("#Shipped table tbody", data.transactions4)
        render_transaction("#Done table tbody", data.transactions5)
    }
    document.addEventListener('DOMContentLoaded', function() {
        var urlParams = new URLSearchParams(window.location.search);
        var activeTab = urlParams.get('tab');

        if (activeTab) {
            $('.nav-tabs a[href="#' + activeTab + '"]').tab('show');
        } else {
            $('.nav-tabs a:first').tab('show'); // Show the first tab by default if no active tab specified
        }

        // Append tab to pagination links dynamically
        $('.pagination a').each(function() {
            var href = $(this).attr('href');
            if (href) {
                href += (href.indexOf('?') !== -1 ? '&' : '?') + 'tab=' + activeTab;
                $(this).attr('href', href);
            }
        });
    });
    // I addedt this to check the tab name and activate it after this I added tab name to the paginate link to the partial
    $(document).ready(async function() {
        setInterval(async () => {
            await refresh_tables();
        }, 1000);
    })
</script>
@endsection