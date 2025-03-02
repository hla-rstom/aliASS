<div class="tab-pane fade show" id="picking" role="tabpanel" aria-labelledby="picking-tab">
    <div class="col-lg-12">
        <p class="mb-3 text-large text-gray-800 ml-3"><b>Picking List</b></p>
        <div class="row justify-content-end">
            <div class="form-group col-md-3">
                <label for="" class="mb-4" style="margin: 9;"></label><br>
                <button id="printPicklist" class="btn btn-primary mr-2">
                    <i class="fas fa-solid fa-print"></i> Print AWB
                </button>

                <!-- Hidden form for submitting selected data -->
                <form action="{{ route('printpicklist')}}" method="POST" id="picklistForm" style="display: none;" target="_blank">
                    @csrf
                    <input type="hidden" name="selectedTransactions" id="selectedTransactionsInput2">
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
                @foreach ($transactions1 as $transaction )
                <tr>
                    <td class="text-center"><input type="checkbox" name="checked_items[]" class="transactionCheckbox2 large-checkbox" style="transform: scale(1.5);" value="{{ $transaction->id }}"></td>
                    <td>{{$transaction->invoice_code}}</td>
                    <td>{{$transaction->currency}} {{$transaction->total_amount ?? ''}}</td>
                    <td>{{$transaction->date}}</td>
                    <td>{{ $transaction->logisticransaction->shipping_carrier ?? '' }}</td>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#printPicklist').click(function(e) {
            e.preventDefault();

            var selectedIds = $('.transactionCheckbox2:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length === 0) {
                alert('Please select at least one transaction to print.');
                return;
            }

            var selectedTransactions = selectedIds.join(',');
            $('#selectedTransactionsInput2').val(selectedTransactions);

            // Set the form to open in a new tab
            $('#picklistForm').attr('target', '_blank');
            $('#picklistForm').submit();
        });
    });
</script>