@extends('layouts/master')
@section('title', 'Reset Password')

@section('content')
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('homepage/images/logo_ki2.png') }}" alt="logo" width="100" >
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Reset Password</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('password.store') }}">
                  @csrf
                  
                  <!-- Password Reset Token -->
                  <input type="hidden" name="token" value="{{ $request->route('token') }}">

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" value="{{ old('email', $request->email) }}" required autocomplete="username">
                    <div class="invalid-feedback">
                        Email is invalid
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required autofocus autocomplete="new-password">
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
                      Reset Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection