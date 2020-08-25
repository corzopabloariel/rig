<section class="my-3">
    <div class="container-fluid">
        <div class="p-5 bg-white mb-3">
            <h3 class="text-center">Formulario dinámico de la sección declaraciones</h3>
        </div>
        <div class="d-flex">
            <button onclick="addElement();" class="btn btn-primary btn-lg mr-2">Agregar campo</button>
            <button class="btn btn-success btn-lg">Guardar</button>
        </div>
        <div id="editor"></div>
    </div>
</section>
@push("js")
<script>
function optionElement() {
    console.log("asd")
}
function addElement() {
    const required = document.createElement("label");
    required.classList.add("mb-0", "ml-2", "w-50", "d-flex", "align-items-center");
    required.innerHTML = `<input type="checkbox" name="required[]" value="1" class="mr-2"/> necesario?`;
    const name = document.createElement("input");
    name.type = "text";
    name.name = "name[]";
    name.placeholder = "Nombre";
    name.classList.add("form-control", "ml-2");
    const order = document.createElement("input");
    order.type = "number";
    order.name = "order[]";
    order.min = 0;
    order.placeholder = "Orden";
    order.classList.add("form-control", "w-50", "mr-2");
    const type = document.createElement("select");
    type.classList.add("form-control");
    type.name = "type[]";
    type.required = "true";
    type.setAttribute("onchange", "optionElement()");
    type.innerHTML = `<option value="" hidden>-- Tipo --</option>`
        + `<option value="input:text">Text</option>`
        + `<option value="input:number">Number</option>`
        + `<option value="input:check">Checkbox</option>`
        + `<option value="textarea">Textarea</option>`
        + `<option value="select">Select</option>`
    const target = $("#editor");
    const element = document.createElement("div");
    const row = document.createElement("div");
    const col = document.createElement("div");
    const col_2 = document.createElement("div");
    row.classList.add("row");
    col.classList.add("col-12", "col-md-9", "d-flex");
    col_2.classList.add("col-12", "col-md-3", "d-flex");
    element.classList.add("p-3", "border", "bg-white", "mt-3");
    col.append(order);
    col.append(type);
    col.append(name);
    col.append(required);
    row.append(col);
    row.append(col_2);
    element.append(row);
    target.append(element);
}
</script>
@endpush