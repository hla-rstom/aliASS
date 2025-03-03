<style>
    .container {
        background-color: #f0f4f7;
        padding: 20px;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .btn-warning {
        background-color: #f0ad4e;
        border: none;

    }

    .btn-warning:hover {
        background-color: #ec971f;

    }
</style>
@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')
    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-4">
            <div class="row ml-2">
                <a href="{{ url()->previous() }}"><i class="fas fa-solid fa-chevron-left"></i> Wallet</a> &nbsp;
                <div class="small-text"> </div>
                <div class="ml-auto mr-4">
                    <button id="withdraw" class="btn btn-primary btn-sm"> Withdraw</button>
                    <button id="addmoney" class="btn btn-outline-primary btn-sm"><i class="fas fa-solid fa-plus"></i> Add Money</button>
                </div>
            </div>
            <div class="card mt-4 mb-4">
                <div class="card-body">
                    <form action="{{ route('addmoney') }}" method="POST" enctype="multipart/form-data" class="ml-3" style="display:none;" id="addMoneyForm">
                        @csrf
                        <div class="row">
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" name="balance" id="balance-input" placeholder="Amount">
                            </div>
                            <div class="form-group mr-2">
                                <select id="banks" name="bank_id" class="form-control">
                                    <option>Choose Bank Account</option>
                                    @foreach ($bankAdmin as $bank)
                                    <option value="{{ $bank->id }}" id="bank">{{ $bank->bank_name }}- {{ $bank->account_name }} - {{ $bank->account }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <button type="submit" class="btn btn-primary">Add Money</button>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('withdraw') }}" method="POST" enctype="multipart/form-data" class="ml-3" style="display:none;" id="withdrawForm">
                        @csrf
                        <div class="row">
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" name="balance" id="withdraw-input" placeholder="Amount">
                            </div>
                            <div class="form-group mr-2">
                                <select id="bankswithdraw" name="bank_id" class="form-control">
                                    <option>Choose Bank Account</option>
                                    @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}" id="bank">{{ $bank->bank_name }}- {{ $bank->account_name }} - {{ $bank->account }}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mr-2">
                                <button type="submit" class="btn btn-primary">Withdraw Money</button>
                            </div>
                        </div>
                    </form>

                    @foreach ($banks as $bank)
                    <!-- Modal -->
                    <div class="modal fade" id="bankModal{{$bank->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Please make a transfer now !</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card alert-primary">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="mb-4 text-lg-end"><b>Please add your Fulhive account email as refernece while doing the online bank transfer</b></p>
                                                    <p>Bank Name : {{$bank->bank_name ?? ''}}</p>
                                                    <p>Account Name : {{$bank->account_name ?? ''}}</p>
                                                    <p>Account : {{$bank->account ?? ''}}</p>
                                                    <br>
                                                    <p>Total transferred amount</p>
                                                    <p id="total-amount">RM 0</p>
                                                    <br>
                                                    <p>We'll update your account within 1x24 hours.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="bankModalwithdraw{{$bank->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Please make a transfer now !</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card alert-primary">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="mb-4 text-lg-end"><b>Please input your destination account, make sure the data is correct.</b></p>
                                                    <p id="account-name-input">Account Name </p>
                                                    <p id="account-input">Account </p>
                                                    <br>
                                                    <p>Total transferred amount</p>
                                                    <p id="total-withdraw">RM 0</p>
                                                    <br>
                                                    <p>We'll update your account within 1x24 hours.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <h6><strong>Wallet History</strong></h6>
                    <table id="example" class="table table-borderless mt-4" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Date</th>
                                <th>Balance</th>
                                <th>Description</th>
                                <th>Status</th>
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
                                    {{ $wallet->balance }}
                                </td>

                                <td>
                                    @if ($wallet->type === 'Top Up')
                                    Top Up Wallet to : {{ $wallet->description_param }}
                                    @endif
                                    @if ($wallet->type === 'Withdraw')
                                    Withdraw Wallet to : {{ $wallet->description_param }}
                                    @endif
                                </td>
                                <td>
                                    @if ($wallet->status === 'Pending')
                                    <span class="badge badge-warning">Pending</span>
                                    @elseif ($wallet->status === 'Approved')
                                    <span class="badge badge-success">Approved</span>
                                    @else
                                    <span class="badge badge-secondary">{{ $wallet->status }}</span>
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


                    <div class="modal fade" id="confirmTransfer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center" id="exampleModalLabel">Confirm Transfer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="card alert-primary">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p>Bank Name : {{$wallet->bank->bank_name ?? ''}}</p>
                                                    <p>Account Name : {{$wallet->bank->account_name ?? ''}}</p>
                                                    <p>Account : {{$wallet->bank->account ?? ''}}</p>
                                                    <br>
                                                    <p>Total transferred amount</p>
                                                    <p>RM {{$wallet->balance ?? ''}}</p>
                                                    <br>
                                                    <form action="{{ route('confirm_addmoney') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Notes</label>
                                                            <input type="hidden" name="wallet_id" value="{{$wallet->id ?? ''}}">
                                                            <textarea class="form-control" id="message-text" cols="40" name="notes">{{ old('notes') }}</textarea>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Already Transferred</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#banks').on('change', function() {
            var bankId = $(this).val();
            console.log(bankId);
            $('#bankModal' + bankId).modal('show');
        });

        $('#bankswithdraw').on('change', function() {
            var bankId = $(this).val();
            console.log(bankId);
            $('#bankModalwithdraw' + bankId).modal('show');
        });

        $('#addmoney').click(function() {
            $('#addMoneyForm').toggle();
        });

        $('#withdraw').click(function() {
            $('#withdrawForm').toggle();
        });

        $('#balance-input').on('keyup', function() {
            var balance = $(this).val();
            $('#total-amount').text('RM ' + balance);
        });

        $('#withdraw-input').on('keyup', function() {
            var balance = $(this).val();
            $('#total-withdraw').text('RM ' + balance);
        });
        $('#account-name-input').on('keyup', function() {
            var account_name = $(this).val();
            $('#account-name-input').text('Account Name ' + account_name);
        });
        $('#account-input').on('keyup', function() {
            var account = $(this).val();
            $('#account-input').text('Account ' + account);
        });
    });
</script>
@endsection