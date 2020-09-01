@extends('layouts.app')

@section('content')
<div class="container-fluid h-100">
    <div class="row justify-content-center align-content-center h-100">
        <div class="col-12 col-sm-9 col-md-6 col-lg-5 col-xl-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    @php
                    $img = asset('images/rig-logo.png');
                    $rig = \App\Rig::first();
                    if ($rig) {
                        if (!empty($rig->images["logo"]))
                            $img = asset($rig["images"]["logo"]["i"]);
                    }
                    $img .= "?t=" . time();
                    @endphp
                    <img src="{{ $img }}" class="card__img" alt="RIG" srcset="">
                </div>
                <div class="card-body">
                    <div class="py-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ labelElement('LBL.EMAIL.ACCESS') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ labelElement('LBL.EMAIL.ACCESS') }}" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ labelElement('LBL.PASS.ACCESS') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ labelElement('LBL.PASS.ACCESS') }}">
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
