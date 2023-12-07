@extends('layouts/master')
@section('title', 'Forgot Password')

@section('content')
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('images/logo_ki2.png') }}" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">

              <div class="card-body">
                <div class="d-block">
                    <label>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</label>
                </div>
                <strong style="color: #74c363">{{ session('status') }}</strong>
                <form method="POST" action="{{ route('password.email') }}">
                  @csrf

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" value="{{ old('email') }}" required autofocus>
                    <div class="invalid-feedback">
                        Email is invalid
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Email Password Reset Link
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