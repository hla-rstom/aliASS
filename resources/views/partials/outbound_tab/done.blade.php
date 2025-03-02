<div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
    <div class="row ml-4">
        <div class="col-lg-12">
            <p class="mb-3 text-large text-gray-800 ml-3"><b>Done List</b></p>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Invoice</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Seller</th>
                        <th scope="col">Recipients</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions5 as $transaction )
                    <tr>
                        <!-- <td><i class="fas fa-solid fa-file-import"></i></td> -->
                        <td>{{$transaction->invoice_code}}</td>
                        <td>{{$transaction->currency}} {{$transaction->total_amount ?? ''}}</td>
                        <td>{{$transaction->seller->name}}</td>
                        <td>{{ $transaction->recipientransaction->name ?? '' }}</td>
                        <td data-toggle="modal" data-target="#done{{$transaction->id}}">
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

<!-- Modal -->
@foreach ($transactions5 as $transaction )
<div class="modal fade" id="done{{$transaction->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Done Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('done') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                    @csrf
                    <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
                    <div class="alert alert-success" role="alert">
                        Transaction <b>{{$transaction->invoice_code}}</b> is done. Confirm the entire transaction process is completed and release the payment!
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endforeach