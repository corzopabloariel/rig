<section class="my-3">
    <div class="container-fluid">
        @isset($data["section"])
            @include('layouts.general.breadcrumb', ['section' => $data["section"]])
        @endisset
        @include( 'layouts.general.form', [ 'buttonADD' => 0 , 'form' => 1 , 'close' => 0, 'url' => route('users.update', ['user' => $data['element']->id]) , 'modal' => 0 ] )
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

<script src="{{ asset('js/basic.js') }}"></script>
<script src="{{ asset('js/pyrus.js') }}"></script>
<script src="{{ asset('js/declarations.js') }}"></script>
<script>
    window.formAction = "UPDATE";
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
    /** */
    init(data => {
        const target = document.querySelector("#user_profile").closest(".col-12");
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = target.querySelector("select").name;
        input.value = target.querySelector("select").value;
        target.innerHTML = "";
        target.append(input);

        window.pyrus.forEach(p => {
            switch (p.tipo) {
                case "U":
                    if (p.column) {
                        if (window.data.element[p.column])
                            p.entidad.show(url_simple, window.data.element[p.column]);
                    } else
                        p.entidad.show(url_simple, window.data.element);
                break;
                case "A":
                case "M":
                    if (window.data.element[p.column])
                        window.data.element[p.column].forEach(a => {
                            const func = new Function(`${p.function}Function(${JSON.stringify(a)})`);
                            func.call(null);
                        });
                break;
            }
        })
    }, false, false, null, false, null, null, true);
</script>
@endpush