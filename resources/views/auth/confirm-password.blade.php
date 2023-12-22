@extends('layouts/master')
@section('title', 'Confirm Password')

@section('content')
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('homepage/images/logo_ki2.png') }}" alt="logo" width="100" >
            </div>

            <div class="card card-primary">

              <div class="card-body">
                <div class="d-block">
                    <label>This is a secure area of the application. Please confirm your password before continuing.</label>
                </div>
                <form method="POST" action="{{ route('password.confirm') }}">
                  @csrf

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required autocomplete="current-password">
                    <div class="invalid-feedback">
                        Please fill in your password
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Confirm
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