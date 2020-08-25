<section class="my-3">
    <div class="container-fluid">
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
    init(data => {
        /*window.pyrus.forEach(p => {
            switch (p.tipo) {
                case "U":
                    if (p.column) {
                        if (window.data.elementos[p.column])
                            p.entidad.show(url_simple, window.data.elementos[p.column]);
                    } else
                        p.entidad.show(url_simple, window.data.elementos);
                break;
                case "A":
                case "M":
                    if (window.data.elementos[p.column])
                        window.data.elementos[p.column].forEach(a => {
                            const func = new Function(`${p.function}Function(${JSON.stringify(a)})`);
                            func.call(null);
                        });
                break;
            }
        })*/
    },
        true,
        true,
        "table",
        true,
        btn = ["e" , "d"]);
</script>
@endpush