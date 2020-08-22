@extends('layouts.app')

@section('content')
<div class="container-fluid body__container">
    <div class="row justify-content-center align-content-center body__container">
        <div class="col-12 col-sm-9 col-md-6 col-lg-5 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <img src="{{ asset('images/rig-logo.png') }}" class="w-100" alt="" srcset="">
                </div>
                <div class="card-body">
                    <div class="py-5">
                        <h3>Texto a cambiar</h3>
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" aria-label="Email" placeholder="Email">
                                <small id="emailHelp" class="form-text text-muted">Email registrado en el sistema (a cambiar).</small>
                            </div>
                            <button class="btn btn-block btn-dark text-center" type="submit">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection