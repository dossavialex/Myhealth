@extends('principal_template.auth_template')
@section('content')
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div style="text-align:center">
                <img alt="image" src="{{ asset('assets/img/myheath.png') }}" class="header-logo" />
            </div>
            <div class="card card-warning">

              <div class="card-header">
                <h4>Mot de passe oublié</h4>
              </div>
              <div class="card-body">
                <p class="text-muted">Voulez-vous reinitialiser votre mot de passe ? </p>
                <form method="POST">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-lg btn-block" tabindex="4">
                      Forgot Password
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
