@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <h6 class="h3 mb-3 text-gray-800 ml-3">Packaging</h6>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- card tim saya -->
            <div class="col-lg-12">
                <div class="mb-4 mt-4">
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-solid fa-plus"></i> Add Packaging</button>
                </div>
                <!-- Modal add-->
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Add Packaging</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('packaging.store') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="small mb-1" for="name">Name <span class="text-danger">*</span></label>
                                        <input class="form-control form-control-solid @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="" value="{{ old('name') }}" />
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label class="small mb-1" for="name">Photo <span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" name="photo" id="photo" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="photo">Choose file</label>
                                        </div>
                                        @error('photo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div> -->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="price">Price <span class="text-danger">*</span></label>
                                        <input class="form-control form-control-solid @error('price') is-invalid @enderror" id="price" name="price" type="text" placeholder="" value="{{ old('price') }}" />
                                        @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                     <div class="mb-3">
                                        <label class="small mb-1" for="symbol">Symbol<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-solid @error('symbol') is-invalid @enderror" id="symbol" name="symbol">
                                            <option value="/pcs" {{ old('symbol') == '/pcs' ? 'selected' : '' }}>/pcs</option>
                                            <option value="/m" {{ old('symbol') == '/m' ? 'selected' : '' }}>/m</option>
                                        </select>
                                        @error('symbol')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal add -->
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packagings as $packaging)
                        <tr>
                            <th scope="row">{{ $loop->iteration  }}</th>
                            <td>{{ $packaging->name }}</td>
                            
                            <td>MYR {{ $packaging->price }} {{ $packaging->symbol }}</td>
                            <td>
                                <div class="row">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#updateModal{{$packaging->id}}"><i class="fas fa-solid fa-user-edit"></i></button>


                                    <div class="modal fade" id="updateModal{{$packaging->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel">Update Packaging</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('packaging.update', $packaging->id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3">
                                                            <label class="small mb-1" for="name">Name <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-solid @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="" value="{{ old('name', $packaging->name) }}" />
                                                            @error('name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                                <label class="small mb-1" for="price">Price<span class="text-danger">*</span></label>
                                                                <input class="form-control form-control-solid @error('price') is-invalid @enderror" id="price" name="price" type="text" placeholder="" value="{{ old('price', $packaging->price) }}" />
                                                                @error('price')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="symbol">Symbol<span class="text-danger">*</span></label>
                                                                <select class="form-control form-control-solid @error('symbol') is-invalid @enderror" id="symbol" name="symbol">
                                                                    <option value="/pcs" {{ old('symbol', $packaging->symbol) == '/pcs' ? 'selected' : '' }}>/pcs</option>
                                                                    <option value="/m" {{ old('symbol', $packaging->symbol) == '/m' ? 'selected' : '' }}>/m</option>
                                                                </select>
                                                                @error('symbol')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{ route('packaging.destroy', $packaging->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm ml-2" onclick="return confirm('Are you sure you want to delete this record?')">
                                            <i class="fas fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-4">

                    {!! $packagings->links() !!}
                </div>
            </div>
        </div>
        <!-- end card tim saya -->
    </div>
</div>
</div>
</div>
</div>

@endsection