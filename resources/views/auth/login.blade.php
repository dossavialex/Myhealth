@extends('principal_template.auth_template')
@section('content')
<section class="section">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="container mt-5">

      <div class="row">
        <div class="col-lg-6" style="padding:0%">
                <img src="{{ asset('assets/img/sainement-nutrition.jpg') }}" alt="" srcset="" style="             width: 100%;
            height: 100%;
            object-fit: cover;">
        </div>
        <div class="col-lg-6 " >
            <div style="text-align:center">
                <img alt="image" src="{{ asset('assets/img/myheath.png') }}" class="header-logo" />
            </div>
            <div class="card card-warning">
            <div class="card-header">
              <h4>Connectez-vous</h4>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('post_connexion') }}"  >
                @csrf
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  >
                  @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
                </div>
                <div class="form-group">
                  <div class="d-block">
                    <label for="password" class="control-label ">Mot de passe</label>
                    <div class="float-right">
                      <a href="{{ route('password.request') }}" class="text-small">
                        Mot de passe oublié ?
                      </a>
                    </div>
                  </div>
                  <input id="password" type="password" class="form-control" name="password" >
                  @error('password')
                   <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input @error('password') is-invalid @enderror" tabindex="3" id="remember-me">
                    <label class="custom-control-label" for="remember-me">Se souvenir</label>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-warning btn-lg btn-block" tabindex="4">
                    Connexion
                  </button>
                </div>
              </form>
              <!--div class="text-center mt-4 mb-3">
                <div class="text-job text-muted">Login With Social</div>
              </div>
              <div class="row sm-gutters">
                <div class="col-6">
                  <a class="btn btn-block btn-social btn-facebook">
                    <span class="fab fa-facebook"></span> Facebook
                  </a>
                </div>
                <div class="col-6">
                  <a class="btn btn-block btn-social btn-twitter">
                    <span class="fab fa-twitter"></span> Twitter
                  </a>
                </div>
              </div-->
            </div>
          </div>
          <div class="mt-5 text-muted text-center">
            Avez-vous un compte ? <a href="{{ route('inscription') }}">Inscrivez-vous</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
