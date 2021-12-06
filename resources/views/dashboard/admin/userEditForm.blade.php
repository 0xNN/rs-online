@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-6 col-md-5 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Edit') }} {{ $user->name }}</div>
                    <div class="card-body">
                        <br>
                        <form method="POST" action="{{ url('users/'.$user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      Name
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ $user->name }}" required autofocus>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Username</span>
                                </div>
                                <input class="form-control" type="text" placeholder="{{ __('Username') }}" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">Password</span>
                              </div>
                              <input class="form-control" type="password" placeholder="{{ __('Password') }}" name="password">
                            </div>
                            <button class="btn btn-block btn-success" type="submit">{{ __('Simpan') }}</button>
                            <a href="{{ route('users.index') }}" class="btn btn-block btn-primary">{{ __('Kembali') }}</a> 
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('javascript')

@endsection