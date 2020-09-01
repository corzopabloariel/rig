@push('modal')
<div class="modal fade bd-example-modal-sm" id="passModal" role="dialog" aria-labelledby="modalPassLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="modalPassLabel">Cambiar contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPass" onsubmit="event.preventDefault(); changePass(this);" action="" method="post">
                @csrf
                <div class="modal-body">
                    <div id="dato-cliente" class="mb-4"></div>
                    <label for="pass">Contraseña nueva</label>
                    <div class="input-group">
                        <input required type="text" id="pass" placeholder="Contraseña nueva" name="pass" class="form-control rounded-0 border-top-0 border-left-0 border-primary"/>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary rounded-0" type="button" onclick="mostrar(this);">Ocultar</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary">CAMBIAR</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush
<section class="my-3">
    <div class="container-fluid">
        @isset($data["section"])
            @include('layouts.general.breadcrumb', ['section' => $data["section"]])
        @endisset
        @if (!isset($data["notForm"]))
            @include('layouts.general.form', ['buttonADD' => 1, 'form' => 0, 'close' => 1, 'modal' => 1])
        @endif
        @include('layouts.general.table', [
            "paginate" => $data["elements"],
            "form" => [
                "url" => $data["url_search"] ?? "/",
                "placeholder" => "Buscar en " . ($data["placeholder"] ?? "No definido"),
                "search" => isset($data["search"]) ? $data["search"] : null
            ]
        ])
    </div>
</section>
@push('js')
<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/alertify.js') }}"></script>
<script src="{{ asset('js/shortcut.js') }}"></script>

<script src="{{ asset('js/pyrus.js') }}"></script>
<script src="{{ asset('js/basic.js') }}"></script>
<script src="{{ asset('js/declarations.js') }}"></script>
<script>
    window.pyrus = [];
    window.pyrus.push({entidad: new Pyrus(entity), tipo: "U"});
    window.pyrus.push({entidad: new Pyrus("user_email"), tipo: "M", column: "emails", function: "emails"});

    mostrar = function( t ) {
        if( $( t ).closest( '.input-group' ).find( 'input' ).attr( 'type' ) == "text" ) {
            $( t ).text( "Ocultar" );
            $( t ).closest( '.input-group' ).find( 'input' ).attr( 'type' , 'password' );
        } else {
            $( t ).text( "Mostrar" );
            $( t ).closest( '.input-group' ).find( 'input' ).attr( 'type' , 'text' );
        }
    };

    passwordFunction = (...arg) => {
        let index = $(arg[0]).closest("tr").index();
        let row = window.data.elements.data[index];
        document.querySelector("#formPass").action = `${url_simple}root/user/change-password/${arg[1]}`;
        document.querySelector("#dato-cliente").innerHTML = `${row.name} ${row.lastname}` + (row.comitente !== null ? ` #${row.comitente}` : '');
        $("#passModal").modal("show");
    };

    changePass = t => {
        if (document.querySelector("#pass").value === "") {
            Toast.fire({
                icon: 'warning',
                title: 'Complete una contraseña'
            });
            return false;
        }
        Toast.fire({
            icon: 'warning',
            title: 'Espere'
        });
        let idForm = t.id;
        let url = t.action;
        let method = t.method;
        let formElement = document.getElementById(idForm);
        let formData = new FormData(formElement);

        axios({
            method: method,
            url: url,
            data: formData,
            responseType: 'json',
            config: { headers: {'Content-Type': 'multipart/form-data' }}
        })
        .then(function(res) {
            if(parseInt(res.data.error) == 1) {
                Toast.fire({
                    icon: 'error',
                    title: res.data.msg ? res.data.msg : 'Ocurrió un error'
                });
            } else {
                document.querySelector("#pass").value = "";
                Toast.fire({
                    icon: 'success',
                    title: res.data.msg
                });
                $( "#passModal" ).modal( "hide" );
            }
        })
        .catch(function(err) {
            Toast.fire({
                icon: 'error',
                title: 'Error'
            });
        })
        .then(function() {});
    };

    emailsFunction = (value = null) => {
        console.log(value)
        if (value) {
            if (typeof value === "string")
                value = JSON.parse(value);
        }
        const element = window.pyrus.find(x => {
            if (x.entidad.entidad === "user_email")
                return x;
        });
        let target = document.querySelector(`#wrapper-emails`);
        let html = "";
        if (window[element.column] === undefined)
            window[element.column] = 0;
        window[element.column] ++;
        html += '<div class="col-12 col-md-6 mt-3 pyrus--element">';
            html += '<div class="pyrus--element__target">';
                html += `<i onclick="remove_( this , 'pyrus--element' )" class="fas fa-times pyrus--element__close"></i>`;
                html += element.entidad.formulario(window[element.column], element.column);
            html += '</div>';
        html += '</div>';
        target.insertAdjacentHTML('beforeend', html);
        element.entidad.show(url_simple, value, window[element.column], element.column, 1);
    };
    /** -------------------------------------
     *      INICIO
     ** ------------------------------------- */
    init(data => {},
        true,
        true,
        "table",
        true,
        btn = entity == "user" ? ["e" , "d"] : [],
        [
            {icon: '<i class="fas fa-key"></i>', class: 'btn-dark', title: 'Blanquear constraseña', function : 'password'},
        ]);
</script>
@endpush