<section class="my-3">
    <div class="container-fluid">
        <div class="p-5 bg-white">
            <a href="{{ route(Auth::user()->redirect()) }}">
                <img src="{{ asset('images/rig-logo.png') }}" class="card__img" alt="RIG" srcset="">
            </a>
            <h1 class="text-center text-welcome mt-4">Bienvenido {{Auth::user()->fullname()}}</h1>
            @if ($data["texts"]->isNotEmpty())
                @foreach($data["texts"] AS $code => $html)
                {!! $html !!}
                @endforeach
            @endif
        </div>
    </div>
</section>