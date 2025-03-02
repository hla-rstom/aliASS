<div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
    <div class="row ml-4">
        <div class="col-lg-12">
            <p class="mb-3 text-large text-gray-800"><b>Shipping List</b></p>
            <!-- <div class="row justify-content-end">
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#uploadModal"> <i class="fas fa-solid fa-plus"></i> Batch AWB </button>
                    <button type="button" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#addModal"> Manifest </button>
                </div>
            </div> -->
           
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
                    @foreach ($transactions3 as $transaction )
                    <tr>
                        <!-- <td><i class="fas fa-solid fa-file-import"></i></td> -->
                        <td>{{$transaction->invoice_code}}</td>
                        <td> {{$transaction->currency}} {{$transaction->total_amount ?? ''}}</td>
                        <td>{{$transaction->seller?->name}}</td>
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
    <!-- Modal Shipping -->
    @foreach ($transactions3 as $transaction )
    <div class=" modal fade" id="shipping{{$transaction->id}}" tabindex="-1" aria-labelledby="shipping{{$transaction->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shipping{{$transaction->id}}Label">{{$transaction->invoice_code}}</h5>
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
                                    <p>{{ $transaction->logisticransaction->tracking_no ?? '' }}</p>
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

                <div class="align-center col-12">
                    <button type="button" class="btn btn-primary mt-4 mb-4 btn-block" data-toggle="modal" data-target="#shippingConfirmationModal" data-dismiss="modal"> Confirm </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Shipping Confirmation Modal -->
    <div class="modal fade" id="shippingConfirmationModal" tabindex="-1" aria-labelledby="shippingConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shippingConfirmationModalLabel">Shipping Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">
                        Confirm to the seller that the order is immediately completed and approve for order information <br>
                        <b>Note:</b> if the seller does not confirm the order within 48 hours, the order will be automatically completed !
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('shippingconfirm', $transaction->id) }}" type="button" class="btn btn-primary btn-block">Confirm to Seller</a>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    <!-- Modal manifest -->
    <div class=" modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Manifest</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('manifeststore') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                        @csrf
                        <div class="form-group">
                            <label for="manifest_code" class="col-form-label">Manifest Code</label>
                            <input type="text" class="form-control" name="manifest_code">
                        </div>
                        <div class="form-group">
                            <label for="logistics">Select Logistic</label>
                            <select id="logistics" name="logistic" class="form-control">
                                @foreach ($logistics as $logistic)
                                <option value="{{ $logistic->name }}">{{ $logistic->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="picker" class="col-form-label">Picker</label>
                            <input type="text" class="form-control" name="picker">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Upload Batch AWB -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="uploadModalLabel">Product Information</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mt-4 mb-4">
                        <h4 class="text-primary mb-2 mx-auto">Upload Batch AWB File</h4>
                    </div>
                    <!-- Tab links -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="download-tab" data-toggle="tab" href="#download">Download Template</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="upload-tab" data-toggle="tab" href="#upload">Upload File Template</a>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="download">
                            <!-- Content for Download Template tab -->
                            <form action="{{ route('exportAwb') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                @csrf

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">Download Template</button>
                                </div>
                                <p>Please download the excel file template here to add AWB Change Batches. Easy way to Import AWB Change Batches.</p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <!-- <button type="button" class="btn btn-primary" id="next">Selanjutnya</button> -->
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="upload">
                            <!-- Content for Upload File Template tab -->
                            <form action="{{ route('importAwb') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                @csrf

                                <div class="input-group mb-3 mt-4">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputFile" name="file" aria-describedby="inputFileAddon">
                                        <label class="custom-file-label" for="inputFile">Choose file</label>
                                    </div>
                                </div>
                                <p>Please select your Excel file (.xlsx) here. The system can only process the first 500 rows.</p>
                                <!-- Add any other form fields needed for uploading -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
</div>