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
                        <div class="py-5">
                            {!! textPrint("TXT.LOGIN") !!}
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" aria-label="{{ labelElement('LBL.EMAIL.LOGIN') }}" placeholder="{{ labelElement('LBL.EMAIL.LOGIN') }}">
                                    {!! helpTag("INP.EMAIL.LOGIN") !!}
                                </div>
                                <button class="btn btn-block btn-dark text-center" type="submit">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection