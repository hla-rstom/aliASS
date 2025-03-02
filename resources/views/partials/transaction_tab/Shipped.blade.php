<div class="tab-pane fade" id="Shipped" role="tabpanel" aria-labelledby="Shipped-tab">
    <div class="row ml-4">
        <div class="col-lg-12">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No Transaction</th>
                        <th scope="col">Date</th>
                        <th scope="col">Store Name</th>
                        <th scope="col">Marketplace</th>
                        <th scope="col">Total Invoice</th>
                        <th scope="col">Logistic</th>
                        <th scope="col">No AWB</th>
                        <th scope="col">Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions['4'] as $transaction)
                    <tr>
                        <td data-toggle="modal" data-target="#detail{{ $transaction->id }}">
                            <b class="text-primary">{{ $transaction->invoice_code }}</b>
                        </td>
                        <td> {{ $transaction->date }} </td>
                        <td>{{ $transaction->marketplacestore->shop_name ?? '' }}</td>
                        <td>{{ $transaction->marketplacestore->driver ?? '' }}</td>
                        <td> {{$transaction->currency}} {{ $transaction->payment->total_transaction ?? '' }}</td>
                        <td>{{ $transaction->logisticransaction->shipping_carrier ?? '' }}</td>
                        <td>{{ $transaction->awbtransaction->no_resi ?? '' }}</td>
                        <td>{{ $transaction->status_order ?? ''}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-4">

                {!! $transactions['4']->appends(['tab' => 'Shipped'])->links() !!}

            </div>
        </div>
    </div>
</div>

@foreach($transactions['4'] as $transaction)
<div class=" modal fade" id="shipping{{$transaction->id}}" tabindex="-1" aria-labelledby="shipping{{$transaction->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shipping{{$transaction->id}}Label">Transaction Code: {{$transaction->invoice_code}}</h5>

            </div>
            <div class="modal-body">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="">Seller</label>
                                <p>{{$transaction->seller?->name}}</p>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="">Recipient</label>
                                <p>{{$transaction->recipientransaction->name ?? ''}}</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">AWB Info</label>
                                <p></p>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="">Logistic</label>
                                <p>{{ $transaction->logisticransaction->shipping_carrier ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Packaging</th>
                            <th scope="col">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->packagingtransaction as $packagingtransaction )
                        <tr>

                            <td>{{$packagingtransaction->packaging->name}}</td>
                            <td>{{$packagingtransaction->qty}}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                <table class="table table-borderless">
                    <thead>
                        <tr>

                            <th scope="col">Product Name</th>
                            <th scope="col">SKU</th>
                            <th scope="col">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->producttransaction as $producttransaction )
                        <tr>

                            <td>{{$producttransaction->product->name ?? ''}}</td>
                            <td>{{$producttransaction->product->sku ?? ''}}</td>
                            <td>{{$producttransaction->qty}}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="{{ route('orderconfirm', $transaction->id) }}" type="button" class="btn btn-primary btn-block">Confirm to Warehouse</a>
            </div>
        </div>
    </div>
</div>
@endforeach