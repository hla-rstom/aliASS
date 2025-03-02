<style>
    .rounded-image {
        border-radius: 50%;
        /* Membuat sudut gambar menjadi lingkaran sempurna */
        width: 200px;
        /* Atur lebar gambar */
        height: 200px;
        /* Atur tinggi gambar - harus sama dengan lebar untuk lingkaran sempurna */
    }
</style>

@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <h6 class="h3 mb-3 text-gray-800 ml-3">Account</h6>
    <div class="col-lg-12">

        <div class="card shadow mb-4">
            <!-- Nav link -->
            <ul class="nav nav-pills mt-3 ml-4">
                <li class="nav-item">
                    <a class="nav-link" href="#" id="akunLink">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="timLink">My Team</a>
                </li>
            </ul>
            <!-- card -->
            <div class="card-body">
                <div class="row" id="akunCard" style="display: none;">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                @if(isset($user->photo))

                                <img id="profilePhoto" src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-image" alt="Profile Photo">
                                @endif
                                <form action="{{ route('uploadphotoaccount') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="photoInput" class="btn btn-outline-primary mb-4 mt-4">Choose Photo</label>
                                    <input type="file" id="photoInput" name="photo" style="display: none;" onchange="previewImage()">
                                    <button type="submit" class="btn btn-primary mb-4 mt-4">Add Photo</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-header py-3 mb-4">
                                    <h6 class="m-0 font-weight-bold text-gray-700">Information</h6>
                                </div>
                                <!-- <div class="col-md-8"> -->
                                <form class="ml-3">
                                    <div class="row">
                                        <div class="col-lg-5 mr-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" value="{{ $user->name}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 mr-4">
                                            <div class="form-group">
                                                <label>Access</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 mr-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" value="{{ $user->email}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 mr-4">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" value="{{ $user->phone}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 mr-4">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" value="{{ $user->password}}">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <p class="h3 mb-3 text-gray-800 ml-3">Banks Information</p>
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- card -->
                            <div class="col-lg-12">
                                <div class="mb-4 mt-4">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-solid fa-plus"></i> Add Bank</button>
                                </div>
                                <!-- Modal add-->
                                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addModalLabel">Add Bank</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('banks.store') }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="small mb-1" for="bank_name">Bank Name</label>
                                                        <input class="form-control form-control-solid @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" type="text" placeholder="" value="{{ old('bank_name') }}" />
                                                        @error('bank_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="small mb-1" for="account_name">Account Name</label>
                                                        <input class="form-control form-control-solid @error('account_name') is-invalid @enderror" id="account_name" name="account_name" type="text" placeholder="" value="{{ old('account_name') }}" />
                                                        @error('account_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="small mb-1" for="account">Account</label>
                                                        <input class="form-control form-control-solid @error('account') is-invalid @enderror" id="account" name="account" type="text" placeholder="" value="{{ old('account') }}" />
                                                        @error('account')
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
                                            <th scope="col">Bank Name</th>
                                            <th scope="col">Account Name</th>
                                            <th scope="col">Account</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banks as $bank)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration  }}</th>
                                            <td>{{ $bank->bank_name }}</td>
                                            <td>{{ $bank->account_name }}</td>
                                            <td>{{ $bank->account }}</td>

                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#updateModal{{$bank->id}}"><i class="fas fa-solid fa-user-edit"></i></button>


                                                    <div class="modal fade" id="updateModal{{$bank->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="updateModalLabel">Update Category</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('banks.update', $bank->id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="mb-3">
                                                                            <label class="small mb-1" for="bank_name">Bank Name</label>
                                                                            <input class="form-control form-control-solid @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" type="text" placeholder="" value="{{ old('bank_name', $bank->bank_name) }}" />
                                                                            @error('bank_name')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="small mb-1" for="account_name">Account Name</label>
                                                                            <input class="form-control form-control-solid @error('account_name') is-invalid @enderror" id="account_name" name="account_name" type="text" placeholder="" value="{{ old('account_name', $bank->account_name) }}" />
                                                                            @error('account_name')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="small mb-1" for="account">Account</label>
                                                                            <input class="form-control form-control-solid @error('account') is-invalid @enderror" id="account" name="account" type="text" placeholder="" value="{{ old('account', $bank->account) }}" />
                                                                            @error('account')
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

                                                    <form action="{{ route('banks.destroy', $bank->id) }}" method="POST">
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

                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>
            <!-- end card -->

            <!-- card -->
            <div class="row ml-4" id="timCard" style="display: none;">
                <div class="col-lg-11">
                    <div class="mb-4">
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
                                <th scope="col">Phone</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Access</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>@foreach ($user->roles as $role)
                                    {{ $role->name }}
                                    @endforeach
                                </td>
                                <td>
                                    <div class="row">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#updateModal{{ $user->id }}"><i class="fas fa-solid fa-user-edit"></i></button>

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
                </div>
            </div>
            <!-- end card -->


        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    document.getElementById('photoInput').onchange = function() {
        // Misalnya, update teks pada label ketika file dipilih
        document.querySelector('label[for="photoInput"]').textContent = this.files[0].name;
    };

    $(document).ready(function() {
        $("#akunLink").addClass("active");
        $("#akunCard").show();

        $("#akunLink").click(function() {
            $("#akunLink").addClass("active");
            $("#timLink").removeClass("active");
            $("#akunCard").show();
            $("#timCard").hide();
        });


        $("#timLink").click(function() {
            $("#timLink").addClass("active");
            $("#akunLink").removeClass("active");
            $("#timCard").show();
            $("#akunCard").hide();
        });


    });
</script>
@endsection