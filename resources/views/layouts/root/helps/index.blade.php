<section class="my-3">
    <div class="container-fluid">
        @include('layouts.general.form', ['buttonADD' => 1, 'form' => 0, 'close' => 1, 'modal' => 1])
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
@push('scripts')
<script>
    window.pyrus = new Pyrus(window.data.entity);
    /** -------------------------------------
     *      INICIO
     ** ------------------------------------- */
    init(data => {},
        true,
        true,
        "table",
        true,
        btn = ["e" , "d"]);
</script>
@endpush