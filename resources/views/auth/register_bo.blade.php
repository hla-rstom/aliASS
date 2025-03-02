@extends('theme.app')

@section('content')
      <!-- Start hero #1-->
      <section class="hero bg-gradient" id="hero">
        <div class="bg-section"><img src="assets_/images/background/bg-gradient.svg" alt="background"/></div>
        <div class="container">
          <div class="hero-cotainer">
            <div class="row">
              <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="card shadow-lg border-0 mt-5 mb-5">
                  <div class="card-body p-5">
                    <h2 class="heading-title text-center mb-4">Brand Owner Registration</h2>

                    <!-- Success Alert -->
                    @if(session('success'))
                        <div class="alert alert-success text-center mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form novalidate action="{{ route('brand-owner-register') }}" method="post">
                        @csrf
                      <!-- Name -->
                      <div class="form-group mb-4">
                        <label class="form-label">Name</label>
                        <input
                          type="text"
                          class="form-control @error('name') is-invalid @enderror"
                          placeholder="Full name"
                          name="name"
                          required
                        />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Email -->
                      <div class="form-group mb-4">
                        <label class="form-label">Email</label>
                        <input
                          type="email"
                          class="form-control @error('email') is-invalid @enderror"
                          placeholder="Email"
                          name="email"
                          required
                        />
                        @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Hidden Role Field -->
                      <input type="hidden" name="role" value="store-owner" />

                      <!-- Password -->
                      <div class="form-group mb-4">
                        <label class="form-label">Password</label>
                        <input
                          type="password"
                          class="form-control @error('password') is-invalid @enderror"
                          placeholder="Password"
                          name="password"
                          required
                        />
                        @error('password')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Confirm Password -->
                      <div class="form-group mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input
                          type="password"
                          class="form-control @error('password_confirmation') is-invalid @enderror"
                          placeholder="Confirm password"
                          name="password_confirmation"
                          required
                        />
                        @error('password_confirmation')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Submit Button -->
                      <button
                        type="submit"
                        class="btn btn--primary btn--block text-white"
                      >
                        Register
                      </button>
                    </form>

                    <div class="text-center mt-4">
                        <p>Already have an account?
                            <a href="/admin/login" class="btn--link">
                                Login
                            </a>
                        </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection

@section('script')
    <script src="assets_/js/vendor/jquery-3.4.1.min.js"></script>
    <script src="assets_/js/vendor.js"></script>
    <script src="assets_/js/functions.js"></script>
@endsection
