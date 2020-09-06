@extends('layouts.app')

@section('content')
<div class="wrapper flex-column">
    @if (!Auth::user()->hasRole("user"))
        <header class="app-header navbar bg-white position-fixed shadow-sm w-100 px-0">
            <div class="d-flex align-items-center w-100">
                <nav class="navbar justify-content-between w-100 navbar-expand-lg navbar-light p-0">
                    <div class="navbar__header">
                        <a href="{{ route(Auth::user()->redirect()) }}">
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
                        </a>
                    </div>
                    <div class="collapse navbar-collapse bg-white" id="navbarNavDropdown">
                        <ul class="navbar-nav px-3">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex pr-5" href="#" id="navbarDropdownMenuUsuario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{Auth::user()->nombre}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUsuario">
                                    <a class="dropdown-item" href="{{ route('user.datos') }}"><i class="fas fa-database mr-2"></i>Mis Datos</a>
                                    @if (Auth::user()->hasRole("root"))
                                    <a class="dropdown-item" href="{{ route('images.index') }}"><i class="far fa-images mr-2"></i>Imágenes sueltas</a>
                                    <a class="dropdown-item" href="{{ route('parameters.index') }}"><i class="fas fa-wrench mr-2"></i>Parámetros del sistema</a>
                                    <a class="dropdown-item" href="{{ route('datos') }}"><i class="fas fa-briefcase mr-2"></i>Datos de RIG</a>
                                    <a class="dropdown-item" href="{{ route('logs') }}"><i class="fas fa-clipboard-list mr-2"></i>Logs</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas text-danger fa-power-off mr-2"></i>Salir</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
        </header>
        <div class="app-body">
            <!-- Sidebar -->
            <nav id="sidebar">@include("layouts." . Auth::user()->redirect() . ".menu")</nav>
            <!-- Page Content -->
            <div id="content">@include("layouts." . Auth::user()->redirect() . "." . $data["view"])</div>
        </div>
    @else
        <div id="content">@include("layouts." . Auth::user()->redirect() . "." . $data["view"])</div>
    @endif
</div>
@endsection
