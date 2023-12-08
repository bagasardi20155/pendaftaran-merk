@extends('layouts/master')
@section('title', 'Verify Email')

@section('content')
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            <div class="card card-primary">

              <div class="card-body">
                <div class="d-block">
                    <label>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</label>
                </div>
                @if (session('status') == 'verification-link-sent')
                    <strong style="color: #74c363">A new verification link has been sent to the email address you provided during registration.</strong>
                @endif
                <form method="POST" action="{{ route('verification.send') }}">
                  @csrf
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Resend Verification Email
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