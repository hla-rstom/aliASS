@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="col-md-4 ml-2">
            <h3 class=" text-gray-800">Manifest List</h3>
        </div>
        <div class="text-right mr-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Manifest</button>
        </div>
    </div>

    <!-- Modal -->
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
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="tab-content col-md-12">
                    <table id="example" class="table table-borderless table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Manifest Code</th>
                                <th>Logistic</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Picker</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($manifests as $manifest)
                            <tr>
                                <td><a href="#detailModal{{ $manifest->id }}" data-toggle="modal" data-target="#detailModal{{ $manifest->id }}">{{ $manifest->manifest_code}}</a></td>
                                <td>{{ $manifest->logistic}}</td>
                                <td>{{ $manifest->date}}</td>
                                <td>{{ $manifest->status}}</td>
                                <td>{{ $manifest->picker}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($manifests as $manifest)
                    <!-- Modal -->
                    <div class="modal fade" id="detailModal{{ $manifest->id }}" tabindex="-1" aria-labelledby="detailModal{{ $manifest->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModal{{ $manifest->id }}">Add Manifest</h5>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary">Save Manifest</button>
                                        <button type="button" class="btn btn-outline-primary">Save & Print Manifest</button>
                                    </div>
                                </div>

                                <div class="modal-body" style="overflow-x: auto;">
                                    <div class="alert alert-primary" role="alert">
                                        Don't forget to confirm the name of the courier who picked up the package to complete this manifest process !
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="" class="mb-4" style="margin: 9;"></label><br>
                                                    <select id="logistics" name="logistic" class="form-control">
                                                        @foreach ($logistics as $logistic)
                                                        <option value="{{ $logistic->name }}">{{ $logistic->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label></label><br>
                                                <button type="button" class="btn btn-primary">Show</button>
                                            </div>
                                            <div class="col-md-4 mr-auto">
                                                <div class="form-group">
                                                    <label for="manifest_code" class="col-form-label">put the cursor in the column below to scan the invoice. every 200 scanned, the system will save the manifest data automatically.</label>
                                                    <input type="text" class="form-control" name="manifest_code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-borderless">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Invoice</th>
                                                <th>Receiver</th>
                                                <th>Receiver Phone</th>
                                                <th>Receiver Address</th>
                                                <th>Logistic</th>
                                                <th>Booking Code</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
