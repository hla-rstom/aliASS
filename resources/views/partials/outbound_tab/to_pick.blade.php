<div class="tab-pane fade show active" id="topick" role="tabpanel" aria-labelledby="topick-tab">
    <div class="col-lg-12">
        <p class="mb-3 text-large text-gray-800"><b>To Pick</b></p>
        
        <div class="row justify-content-between">
    <div class="col-md-3">
        <form method="GET" action="{{ route('outbound') }}"> 
            <label for="fromDate" class="mb-2">From:</label>
            <div class="input-group mb-3">
                <input type="date" class="form-control" id="fromDate" name="fromDate">
            </div>
    </div>
    <div class="col-md-3">
            <label for="toDate" class="mb-2">To:</label>
            <div class="input-group mb-3">
                <input type="date" class="form-control" id="toDate" name="toDate">
            </div>
    </div>
    <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary mb-3 ">Filter</button>
        </form>
    </div>
    <div class="col-md-3">
        <label class="mb-4" style="opacity: 0;"></label> <!-- Dummy label for alignment -->
        <div class="input-group mb-3">
            <button id="printtoPick" class="btn btn-primary mr-2">
                <i class="fas fa-solid fa-truck"></i> Ship
            </button>
        </div>

        <!-- Hidden form for shipping selected data -->
        <form action="{{ route('printtoPick')}}" method="POST" id="topickForm" style="display: none;">
            @csrf
            <input type="hidden" name="selectedTransactions" id="selectedTransactionsInput">
        </form>
    </div>
</div>

        <table class="table" id="transactionTable">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Logistic</th>
                    <th scope="col">Seller</th>
                    <th scope="col">Recipients</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactionsTopick as $transaction )
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="checked_items[]" class="transactionCheckbox large-checkbox" style="transform: scale(1.5);" value="{{ $transaction->id }}" @if ($transaction->status == 10) disabled @endif>
                    </td>
                    <td>{{$transaction->invoice_code}}</td>
                    <td>{{$transaction->currency}} {{$transaction->total_amount ?? ''}}</td>
                    <td>{{$transaction->date}}</td>
                    <td>{{ $transaction->logisticransaction->shipping_carrier ?? '' }}</td>
                    <td>{{$transaction->seller->name ?? ''}}</td>
                    <td>{{ $transaction->recipientransaction->name ?? '' }}</td>
                    <td>
                        @switch($transaction->status)
                        @case(0)
                        <span class="badge badge-secondary">Ready to Ship</span>
                        @break
                        @case(10)
                        <span class="badge badge-secondary">Waiting for AWB</span>
                        @break
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
<script>
    $('#printtoPick').click(function(e) {
        e.preventDefault();

        var selectedIds = $('.transactionCheckbox:checked').map(function() {
            return $(this).val();
            console.log(selectedIds);
        }).get();
        if (selectedIds.length === 0) {
            alert('Please select at least one transaction to print.');
            return;
        }

        var selectedTransactions = selectedIds.join(',');
        $('#selectedTransactionsInput').val(selectedTransactions);
        $('#topickForm').submit();
    });
</script>