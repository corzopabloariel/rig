@if ($data["statements"]->isEmpty())
<section class="my-3">
    <div class="container-fluid">
        <div class="p-5 bg-white">
            <div class="p-3 text-right">
                <a href="{{ route('logout') }}"><i class="fas text-danger fa-power-off mr-2"></i>Salir</a>
            </div>
            <a href="{{ route(Auth::user()->redirect()) }}">
                <img src="{{ asset('images/rig-logo.png') }}" class="card__img" alt="RIG" srcset="">
            </a>
            <h1 class="text-center text-welcome mt-4">Bienvenido {{Auth::user()->fullname()}}</h1>
            <div id="statement_text">
                @if ($data["texts"]->isNotEmpty())
                    @foreach($data["texts"] AS $code => $html)
                    {!! textPrint($code) !!}
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="p-5 bg-white">
            <p class="text-right">Campos necesarios<span class="text-danger ml-2">*</span></p>
            <form action="{{ route('client.statements') }}" method="post" id="form">
                @csrf
                <div class="form-group">
                    <label for="operation_id">Operación<span class="text-danger ml-2">*</span></label>
                    <select class="form-control" name="operation_id" label="operation_id">
                        <option value="" selected hidden>-- Operación --</option>
                        @foreach($data["operations"] AS $operation)
                        <option value="{{$operation->id}}">{{$operation->name}}</option>
                        @endforeach
                    </select>
                </div>
                @if ($data["forms"]->isNotEmpty())
                    @foreach($data["forms"] AS $form)
                    {!! $form->printForm(old($form->name)) !!}
                    @endforeach
                @endif
                <div class="form-group">
                    <label for="obs">Observaciones</label>
                    <textarea name="obs" id="obs" rows="3" class="form-control" placeholder="Observaciones"></textarea>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="accept" id="accept">
                    <label class="form-check-label" for="accept">{{ labelElement('LBL.ACCEPT') }}</label>
                </div>

                <button type="submit" class="btn btn-primary">Aceptar</button>
            </form>
        </div>
    </div>
</section>
@push("js")
<script src="https://www.google.com/recaptcha/api.js?render={{$publicKey}}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/client.js') }}"></script>
@endpush
@else
<section class="my-3">
    <div class="container-fluid">
        <div class="p-5 bg-white">
            <div class="p-3 text-right">
                <a href="{{ route('logout') }}"><i class="fas text-danger fa-power-off mr-2"></i>Salir</a>
            </div>
            <a href="{{ route(Auth::user()->redirect()) }}">
                <img src="{{ asset('images/rig-logo.png') }}" class="card__img" alt="RIG" srcset="">
            </a>
            <h1 class="text-center text-welcome mt-4">Bienvenido {{Auth::user()->fullname()}}</h1>

            <table class="table table-hover table-bordered table-striped mt-4">
                <thead class="thead-dark">
                    <th>Fecha</th>
                    <th>Operación</th>
                    <th>Email</th>
                    <th>Observaciones</th>
                </thead>
                <tbody>
                    @foreach($data["statements"] AS $statement)
                    <tr>
                        <td>{{ date("d/m/Y H:i:s", strtotime($statement->created_at))}}</td>
                        <td>{{ $statement->operation->name }}</td>
                        <td>{{ $statement->data["_extras"]["email"] }}</td>
                        <td>{{ $statement->obs ?? "-"}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endif