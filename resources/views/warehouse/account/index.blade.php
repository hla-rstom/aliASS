@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <h6 class="h3 mb-3 text-gray-800 ml-3">Profile</h6>
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="form-group">
                        <label>Warehouse Name</label>
                        <p class="mb-2"><strong> {{$warehousedata->name}} </strong></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p class="mb-2"><strong> {{$warehousedata->user->email ?? ''}} </strong></p>
                    </div>
                    <div class="form-group">
                        <label>Access Level</label>
                        <p class="mb-2"><strong>Owner</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <p>content</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row ml-4">
        <div class="col-lg-12">
            <div class="mb-4 text-right">
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-solid fa-user-plus"></i> Add Team</button>
            </div>
            <!-- Modal add-->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add Team</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('addteams') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                @csrf
                                <div class="row">
                                    <div class="form-group mr-3">
                                        <label for="exampleFormControlInput1">Name*</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Emai*</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput1" name="email">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mr-3">
                                        <label for="exampleFormControlInput1">Phone*</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Access Type*</label>
                                        <select class="form-control form-control" name="role_id">
                                            <option value="admin">Admin</option>
                                            <option value="viewer">Viewer</option>
                                            <option value="finance">Finance</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mr-3">
                                        <label for="exampleFormControlInput1">Password*</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label>Gender*</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="opsi1" value="male">
                                            <label class="form-check-label" for="male">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="opsi2" value="female">
                                            <label class="form-check-label" for="female">
                                                Female
                                            </label>
                                        </div>
                                    </div>
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
                        <th scope="col">Access Level</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $user )
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                            {{ $role->name }}
                            @endforeach
                        </td>
                        <td>
                            <div class="row">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#updateModal{{ $user->id }}"><i class="fas fa-solid fa-user-edit"></i></button>

                                <!-- Modal update-->
                                <div class="modal fade" id="updateModal{{ $user->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateModalLabel">Update Team</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('updateteams', $user->id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="form-group mr-3">
                                                            <label for="exampleFormControlInput1">Name*</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{ $user->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Emai*</label>
                                                            <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="{{ $user->email }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group mr-3">
                                                            <label for="exampleFormControlInput1">Phone*</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="phone" value="{{ $user->phone }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Access Type*</label>
                                                            <select class="form-control form-control" name="role_id" id="exampleFormControlInput1">
                                                                <option value="admin" @if($user->roles->contains('name', 'admin')) selected @endif>Admin</option>
                                                                <option value="viewer" @if($user->roles->contains('name', 'viewer')) selected @endif>Viewer</option>
                                                                <option value="finance" @if($user->roles->contains('name', 'finance')) selected @endif>Finance</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group mr-3">
                                                            <label for="exampleFormControlInput1">Password*</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="password" value="{{ $user->password }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Gender*</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gender" id="opsi1" value="male" @if($user->gender == 'male') checked @endif>
                                                                <label class="form-check-label" for="opsi1">
                                                                    Male
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gender" id="opsi2" value="female" @if($user->gender == 'female') checked @endif>
                                                                <label class="form-check-label" for="opsi2">
                                                                    Female
                                                                </label>
                                                            </div>
                                                        </div>

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
                                <!-- End Modal update -->

                                <form action="{{ route('deleteteams', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger ml-2" onclick="return confirm('Are you sure you want to delete this record?')">
                                        <i class="fas fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection