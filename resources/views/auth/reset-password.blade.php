@extends('principal_template.auth_template')
@section('content')
<section class="section">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
    @endif
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div style="text-align:center">
                <img alt="image" src="{{ asset('assets/img/myheath.png') }}" class="header-logo" />
            </div>
            <div class="card card-warning">
            <div class="card-header">
              <h4>Reinitilaisé mot de passe </h4>
            </div>
            <div class="card-body">
              <p class="text-muted">Nouveau mot de passe</p>
              <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="hidden" class="form-control" name="token" value={{ $token }} tabindex="1" required autofocus style="display: none">
                  </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                </div>
                <div class="form-group">
                  <label for="password">Nouveau mot de passe</label>
                  <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                    name="password" tabindex="2" required>
                  <div id="pwindicator" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password-confirm">Confirmer le nouveau mot de passe</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    tabindex="2" required>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-warning btn-lg btn-block" tabindex="4">
                    Reinitialiser le mot de passe
                  </button>
                </div>
              </form>
            </div>
            <div class="card-footer" style="text-align: center">
                <a href="{{ route('connexion') }}"> Avez-vous un compte ? connectez-vous</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
