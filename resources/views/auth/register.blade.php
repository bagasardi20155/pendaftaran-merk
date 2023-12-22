@extends('layouts/master')
@section('title', 'Register')

@section('content')
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('homepage/images/logo_ki2.png') }}" alt="logo" width="100" >
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" name="name" tabindex="1" value="{{ old('name') }}" required autofocus autocomplete="name">
                    <div class="invalid-feedback">
                        Name is invalid
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" value="{{ old('email') }}" required autofocus autocomplete="username">
                    <div class="invalid-feedback">
                        Email is invalid
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required autocomplete="new-password">
                    <div class="invalid-feedback">
                        Please fill in your password
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password_confirmation" class="control-label">Confirm Password</label>
                    </div>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" tabindex="2" required autocomplete="new-password">
                    <div class="invalid-feedback">
                        Password confirmation did not match
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Already Registered? <a href="{{ route('login') }}">Login</a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection