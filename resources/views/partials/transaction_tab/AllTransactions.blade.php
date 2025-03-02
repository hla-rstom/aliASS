<div class="tab-pane fade" id="AllTransactions" role="tabpanel" aria-labelledby="AllTransactions-tab">
    <div class="row ml-4">
        <div class="col-lg-12">
            <table class="table">
                <thead class="thead-light" id="dataTable" width="100%" cellspacing="0">
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
                    @foreach ($allTransactions as $transaction)
                    <tr>
                        <td data-toggle="modal" data-target="#detail{{ $transaction->id }}">
                            <b class="text-primary">{{ $transaction->invoice_code }}</b>
                        </td>
                        <td> {{ $transaction->date }} </td>
                        <td>{{ $transaction->marketplacestore->shop_name ?? '' }}</td>
                        <td>{{ $transaction->marketplacestore->driver ?? '' }}</td>
                        <td>{{$transaction->currency}} {{ $transaction->payment->total_transaction ?? ''}}</td>
                        <td>{{ $transaction->logisticransaction->shipping_carrier ?? '' }}</td>
                        <td>{{ $transaction->logisticransaction->tracking_no ?? '' }}</td>
                        <td>{{ $transaction->status_order ?? ''}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-4">

                {!! $allTransactions->appends(['tab' => 'AllTransactions'])->links() !!}
            </div>
        </div>
    </div>
</div>