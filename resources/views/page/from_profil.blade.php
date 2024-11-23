@extends('principal_template.principal_template')

@section('title')
    Profil
@endsection

@section('content')
    <!-- Main Content -->
      <section class="section">
        <div class="section-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif
          <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-4">
              <div class="card author-box">
                <div class="card-body">
                  <div class="author-box-center">
                    <img alt="image" src="{{ url('storage/' . auth()->user()->image_profile) }}" class="rounded-circle author-box-picture">
                    <div class="clearfix"></div>
                    <div class="author-box-name">
                      <a href="#" style="color:orange">{{ auth()->user()->last_name }} {{ auth()->user()->first_name }}</a>
                    </div>
                    <div class="author-box-job">Web Developer</div>
                  </div>
                  <div class="text-center">
                    <form action="{{ route('modif_photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Modifiez votre photo de profil</label>
                            <input type="file" class="form-control" name='attachment'>
                        </div>
                        <input type="submit" class="btn btn-warning" value="Modifier">
                    </form>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h4>Personal Details</h4>
                </div>
                <div class="card-body">
                  <div class="py-4">
                    <p class="clearfix">
                      <span class="float-left">
                        Nom prénoms
                      </span>
                      <span class="float-right text-muted">
                        {{ auth()->user()->last_name }} {{ auth()->user()->first_name }}
                      </span>
                    </p>
                    <p class="clearfix">
                      <span class="float-left">
                        Phone
                      </span>
                      <span class="float-right text-muted">
                        {{ auth()->user()->tel }}
                      </span>
                    </p>
                    <p class="clearfix">
                      <span class="float-left">
                        Email
                      </span>
                      <span class="float-right text-muted">
                        {{ auth()->user()->email }}
                      </span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
              <div class="card">
                <div class="padding-20">
                  <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                        aria-selected="true" style="color: orange">profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                        aria-selected="false" style="color: orange">Mot de passe</a>
                    </li>
                  </ul>
                  <div class="tab-content tab-bordered" id="myTab3Content">
                    <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                        <form method="post" class="needs-validation"  action="{{ route('post_modif_profil',['id'=> auth()->user()->id]) }}">
                           @csrf
                            <div class="card-header">
                              <h4>Modifier Profile</h4>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="form-group col-md-6 col-12">
                                  <label>Nom</label>
                                  <input type="text" class="form-control" value="{{ auth()->user()->last_name }}" name="last_name">
                                  <div class="invalid-feedback">
                                    Please fill in the first name
                                  </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                  <label>Prénom</label>
                                  <input type="text" class="form-control" value="{{ auth()->user()->first_name }}" name="first_name">
                                  <div class="invalid-feedback">
                                    Please fill in the last name
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-7 col-12">
                                  <label>Email</label>
                                  <input type="email" class="form-control" value="{{ auth()->user()->email }}" name="email">
                                  <div class="invalid-feedback">
                                    Please fill in the email
                                  </div>
                                </div>
                                <div class="form-group col-md-5 col-12">
                                  <label>Telephone</label>
                                  <input type="tel" class="form-control" value="{{ auth()->user()->tel }}" name="telephone">
                                </div>
                              </div>
                              <div class="row">
                              </div>
                            </div>
                            <div class="card-footer text-right">
                              <button class="btn btn-warning">Modifier</button>
                            </div>
                          </form>
                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                      <form method="post" class="needs-validation" action={{ route('post_modif_profil_password',['id'=>auth()->user()->id]) }}>
                        @csrf
                        <div class="card-header">
                          <h4>Modifier mot de passe</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="form-group col-md-6 col-12">
                              <label>Ancien mot de passe</label>
                              <input type="password" class="form-control"  name="old_password">
                              <div class="invalid-feedback">
                                Please fill in the first name
                              </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                              <label>Nouveau mot de passe</label>
                              <input type="password" class="form-control" name="password">
                              <div class="invalid-feedback">
                                Please fill in the last name
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-7 col-12">
                              <label>Confirmer mot de passe</label>
                              <input type="password" class="form-control" name="password_confirmation">
                              <div class="invalid-feedback">
                                Please fill in the email
                              </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                          <button class="btn btn-warning">Modifier</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="settingSidebar">
        <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
        </a>
        <div class="settingSidebar-body ps-container ps-theme-default">
          <div class=" fade show active">
            <div class="setting-panel-header">Setting Panel
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Select Layout</h6>
              <div class="selectgroup layout-color w-50">
                <label class="selectgroup-item">
                  <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                  <span class="selectgroup-button">Light</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                  <span class="selectgroup-button">Dark</span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Sidebar Color</h6>
              <div class="selectgroup selectgroup-pills sidebar-color">
                <label class="selectgroup-item">
                  <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                  <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                    data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                  <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                    data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Color Theme</h6>
              <div class="theme-setting-options">
                <ul class="choose-theme list-unstyled mb-0">
                  <li title="white" class="active">
                    <div class="white"></div>
                  </li>
                  <li title="cyan">
                    <div class="cyan"></div>
                  </li>
                  <li title="black">
                    <div class="black"></div>
                  </li>
                  <li title="purple">
                    <div class="purple"></div>
                  </li>
                  <li title="orange">
                    <div class="orange"></div>
                  </li>
                  <li title="green">
                    <div class="green"></div>
                  </li>
                  <li title="red">
                    <div class="red"></div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <div class="theme-setting-options">
                <label class="m-b-0">
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                    id="mini_sidebar_setting">
                  <span class="custom-switch-indicator"></span>
                  <span class="control-label p-l-10">Mini Sidebar</span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <div class="theme-setting-options">
                <label class="m-b-0">
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                    id="sticky_header_setting">
                  <span class="custom-switch-indicator"></span>
                  <span class="control-label p-l-10">Sticky Header</span>
                </label>
              </div>
            </div>
            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
              <a href="#" class="btn btn-icon icon-left btn-warning btn-restore-theme">
                <i class="fas fa-undo"></i> Restore Default
              </a>
            </div>
          </div>
        </div>
      </div>
@endsection

