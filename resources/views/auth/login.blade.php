@extends('layouts.app')

@section('content')
@if($errors->any())
    <div class="position-fixed w-100 text-center" style="z-index:9999; top: 0;">
        <div class="alert alert-danger alert-dismissible fade show d-inline-block mb-0">
            {!! $errors->first('mssg') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
<div class="container-fluid body__container">
    <div class="row justify-content-center align-content-center body__container">
        <div class="col-12 col-sm-9 col-md-6 col-lg-5 col-xl-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <img src="{{ asset('images/rig-logo.png') }}" class="card__img" alt="RIG" srcset="">
                </div>
                <div class="card-body">
                    <div class="py-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Contraseña') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button class="btn btn-block btn-dark text-center" type="submit">{{ __('Acceder') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
