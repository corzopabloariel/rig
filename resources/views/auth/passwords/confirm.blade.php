@extends('layouts.app')

@section('content')
<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-12 d-flex justify-content-center align-items-center h-100">
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
                        {!! textPrint("TXT.PASS") !!}
                        <form method="POST" action="{{ URL::to('password') }}">
                            @csrf
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" aria-label="{{ labelElement('LBL.PASS.LOGIN') }}" placeholder="{{ labelElement('LBL.PASS.LOGIN') }}">
                                {!! helpTag("INP.PASS.LOGIN") !!}
                            </div>
                            <button class="btn btn-block btn-dark text-center" type="submit">Establecer contraseña y acceder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
