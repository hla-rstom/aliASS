<div class="tab-pane fade" id="Returns" role="tabpanel" aria-labelledby="Returns-tab">
    <div class="row ml-4">
        <div class="col-lg-12">
            <p class="mb-3 text-large text-gray-800 ml-3"><b>Return List</b></p>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Invoice</th>
                        <th scope="col">Seller</th>
                        <th scope="col">Recipients</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions7 as $transaction )
                    <tr>
                        <!-- <td><i class="fas fa-solid fa-file-import"></i></td> -->
                        <td>{{$transaction->invoice_code}}</td>
                        <td>{{$transaction->seller->name ?? ''}}</td>
                        <td>{{ $transaction->recipientransaction->name ?? '' }}</td>
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
