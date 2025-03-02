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
    <style>
    .bg-shopee{
  background-color: #FF5722;
  color: white;
}


        .create-account-link {
            color: #FF5722;
            font-size: 14px;
            display: block;
            margin-top: 10px;
        }

        .create-account-link:hover {
            color: #E64A19;
            text-decoration: underline;
        }

</style>
</head>

<body class="bg-shopee">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-12 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- Carousel -->
                            
                            <div class="col-md-7">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{ asset('asset/img/Page1.svg') }}" class="d-block w-100" alt="..." style="padding-bottom: 100px;">
                                            <div class="carousel-caption d-none d-md-block" >
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
                                <a class="container pb-5 navbar-brand text-center" href="/">
                                    <img width="100px" src="assets/images/logo.jpg" alt="">
                                </a>
                            </div>
                            <div class="col-md-5">
                                <div class="p-5">
                                    <!-- alert -->
                                    @include('partials._alert')
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email" class="text-dark">{{ __('Email Address') }}</label>
                                            <input id="email" placeholder="Enter Email..." type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="text-dark">{{ __('Password') }}</label>
                                            <input id="password"  placeholder="Enter Password..." type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->

                                        <button type="submit" class="btn bg-shopee btn-user btn-block">
                                            {{ __('Login') }}
                                        </button>
                                        <!-- <div class="text-center mt-2">
                                            @if (Route::has('password.request'))
                                            <a class="small" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                            @endif

                                        </div> -->
                                    </form>

                                    <div class="text-center mt-2">
                                        <a class="small create-account-link" href="{{ url('register/seller') }}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

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
    <script>
        $('.carousel').carousel({
            interval: 3000 //changes the speed - 2000 milliseconds
        })
    </script>

</body>

</html>