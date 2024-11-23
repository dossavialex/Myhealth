@extends('principal_template.auth_template')


@section('content')
<section class="section">
    <div class="container mt-5">
      <div class="row">
        <div style="text-align:center">
            <<img alt="image" src="{{ asset('assets/img/myheath.png') }}" class="header-logo" />
        </div>
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
          <div class="card card-warning">
            <div class="card-header">
              <h4>Inscrivez-vous</h4>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('post_inscription') }}">
                @csrf
                <div class="row">
                  <div class="form-group col-6">
                    <label for="frist_name">Nom</label>
                    <input id="frist_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" autofocus>
                 @error('first_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
                </div>
                  <div class="form-group col-6">
                    <label for="last_name">Prenom</label>
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name">
                    @error('last_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
                </div>
                </div>

                <div class="form-group">
                    <label for="email">Telephone</label>
                    <input  name="tel" type="tel" value="" class="form-control @error('tel') is-invalid @enderror" />
                    @error('tel')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
                    <div class="invalid-feedback">
                    </div>
                  </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                  @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
               @enderror
                  <div class="invalid-feedback">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label for="password" class="d-block">Mot de passe</label>
                    <input id="password" type="password" class="form-control pwstrength @error('password') is-invalid @enderror" data-indicator="pwindicator"
                      name="password">
                      @error('password')
                      <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                      <div id="pwindicator" class="pwindicator">
                      <div class="bar"></div>
                      <div class="label"></div>
                    </div>
                  </div>
                  <div class="form-group col-6">
                    <label for="password2" class="d-block">Confirmation mot de passe</label>
                    <input id="password2" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                    @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                    <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-warning btn-lg btn-block">
                    Inscription
                  </button>
                </div>
              </form>
            </div>
            <div class="mb-4 text-muted text-center">
              AVez-vous dejà un compte ? <a href="{{ route('connexion') }}">connexion</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('scripts_register')
<script src="{{asset('assets/build/js/intlTelInputWithUtils.js')}}"></script>
<script>
  const input = document.querySelector("#phone");
  const iti = window.intlTelInput(input, {
    // allowDropdown: false,
    // autoPlaceholder: "off",
    // containerClass: "test",
    // countryOrder: ["jp", "kr"],
    // countrySearch: false,
    // customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
    //   return "e.g. " + selectedCountryPlaceholder;
    // },
    // dropdownContainer: document.querySelector('#custom-container'),
    // excludeCountries: ["us"],
    // fixDropdownWidth: false,
    // formatAsYouType: false,
    // formatOnDisplay: false,
    // geoIpLookup: function(callback) {
    //   fetch("https://ipapi.co/json")
    //     .then(function(res) { return res.json(); })
    //     .then(function(data) { callback(data.country_code); })
    //     .catch(function() { callback(); });
    // },
    // hiddenInput: () => "phone_full",
    // i18n: { 'de': 'Deutschland' },
    initialCountry: "us",
    // nationalMode: false,
    // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    // placeholderNumberType: "MOBILE",
    // showFlags: false,
    // separateDialCode: true,
    // strictMode: true,
    // useFullscreenPopup: true,
    // utilsScript: "/build/js/utils.js", // leading slash (and http-server) required for this to work in chrome
    // validationNumberType: null,
  });
  window.iti = iti; // useful for testing
</script>

@endsection
