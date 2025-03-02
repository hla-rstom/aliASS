<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fulhive</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('asset/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="{{ asset('asset/css/sb-admin-2.min.css') }}" rel="stylesheet">

        <link href="dist/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fav Icon -->
        <link rel="icon" href="assets/images/logo_icon.png" />   
    <script>
    tailwind.config = {
      theme: {
        container : {
        center: true,
        },
        extend: {
        fontFamily: {
            custom: ['YAFdJjTk5UU-0', 'sans-serif'], // Specify the font and fallback
        },
        
        },
    },
    }
  </script>
  <style type="text/tailwindcss">
    @layer utilities {
      .content-auto {
        content-visibility: auto;
      }
    }
  </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                @if($type == 'retail' || $type == 'seller')
                <div class="row">
                    <!-- Carousel -->
                    <div class="col-md-7">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active mt-4">
                                    <img src="{{ asset('asset/img/login-page-vector.svg') }}" class="d-block w-100" alt="..." style="padding-bottom: 150px;">
                                    <div class="carousel-caption d-none d-md-block" style="padding-top: 20px; position: absolute; bottom: 0;">
                                        <h3 class="h4 text-gray-900 mb-4"><strong>Most Flexible</strong> <br> Services that can be tailored to every need from e-commerce sellers to corporate businesses</h3>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('asset/img/vector-element-01.svg') }}" class="d-block w-100" alt="..." style="padding-bottom: 100px;">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h1 class="h4 text-gray-900 mb-4"><strong>Best Service Quality Flexible</strong> <br> The combination of advanced technology & professional workers is ready to produce the best quality service</h1>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('asset/img/vector-element-02.svg') }}" class="d-block w-100" alt="..." style="padding-bottom: 100px;">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h1 class="h4 text-gray-900 mb-4"><strong>Increase Sales</strong> <br> Focus more on developing product quality & marketing because it is hassle free from operational matters</h1>
                                    </div>
                                </div>
                                <!-- More carousel items here -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="p-5">
                            @include('partials._alert')
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form method="POST" action="{{ route('registertype') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <input id="type" type="hidden" name="type" value="{{$type}}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input id="phone" type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" name="phone" placeholder="Phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id="company_name" type="text" class="form-control form-control-user @error('company_name') is-invalid @enderror" name="company_name" placeholder="Company Name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>


                                    @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea id="street_address" type="text" class="form-control form-control-user @error('street_address') is-invalid @enderror" name="street_address" placeholder="Address" value="{{ old('street_address') }}" required autocomplete="street_address" autofocus></textarea>

                                    @error('street_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                @if($type == 'retail')
                                <p>Retail Info</p>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="state">State</label>
                                        <select id="state" class="form-control form-control-user @error('region') is-invalid @enderror" name="region" required>
                                            <option value="" disabled selected>Select a State</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->value }}" {{ old('region') == $state->value ? 'selected' : '' }}>
                                                    {{ $state->value }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('region')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="state">Property Type</label>
                                        <select id="property_type" class="form-control form-control-user @error('property_type') is-invalid @enderror" name="property_type" required>
                                            <option value="">Property Type</option>
                                            <option value="own_property" {{ old('property_type') == 'Own Property' ? 'selected' : '' }}>Own Property</option>
                                            <option value="leased_property" {{ old('property_type') == 'Leased Property' ? 'selected' : '' }}>Leased Property</option>
                                        </select>

                                        @error('property_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label for="retail_type">Retail Type</label>
                                        <select id="retail_type" class="form-control form-control-user @error('retail_type') is-invalid @enderror" name="retail_type" required>
                                            <option value="" disabled selected>Select a type</option>
                                            @foreach($retail_types as $retail_type)
                                                <option value="{{ $retail_type->value }}" {{ old('retail_type') == $retail_type->value ? 'selected' : '' }}>
                                                    {{ $retail_type->value }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('retail_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                                <button type="submit" class="btn btn-warning btn-user btn-block">
                                    {{ __('Register') }}
                                </button>
                                <!-- <div class="text-center mt-4">
                                    @if (Route::has('password.request'))
                                    <a class="small" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div> -->
                            </form>
                            <div class="text-center mt-4">
                                <a class="small text-warning" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="grid h-screen place-content-center bg-white px-4">
                    <h1 class="uppercase tracking-widest text-gray-500">404 | Not Found</h1>
                </div>
                @endif
            </div>
        </div>

    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('asset/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('asset/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('asset/vendor/chart.js/Chart.min.js') }}"></script>


</body>

</html>
