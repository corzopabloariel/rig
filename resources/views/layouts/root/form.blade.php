<section class="my-3">
    <div class="container-fluid">
        <div class="p-5 bg-white mb-3">
            <h3 class="text-center">Formulario dinámico de la sección declaraciones</h3>
        </div>
        <form action="" method="post">
            @csrf
            <div class="d-flex">
                <button type="button" onclick="addElement();" class="btn btn-primary btn-lg mr-2">Agregar campo</button>
                <button type="submit" class="btn btn-dark btn-lg">Guardar elementos</button>
            </div>
            <div id="editor"></div>
        </form>
    </div>
</section>
@push("js")
<script>
const elementDB = @json($data["forms"]);
function optionElement() {
    console.log("Sin uso");
}
function removeElement() {
    let target = this;
    Swal.fire({
        title: "Atención!",
        text: "Eliminar elemento del formulario?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',

        confirmButtonText: '<i class="fas fa-check"></i> Confirmar',
        confirmButtonAriaLabel: 'Confirmar',
        cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
        cancelButtonAriaLabel: 'Cancelar'
    }).then(result => {
        if (result.value) {
            target.closest(".element").remove();
        }
    });
}
function addElement(data = null) {
    const remove = document.createElement("button");
    const required = document.createElement("label");
    const name = document.createElement("input");
    const order = document.createElement("input");
    const type = document.createElement("select");
    const target = document.querySelector("#editor");
    const element = document.createElement("div");
    const row = document.createElement("div");
    const col = document.createElement("div");

    remove.classList.add("btn", "btn-danger");
    remove.type = "button";
    remove.addEventListener("click", removeElement);
    remove.innerHTML = '<i class="fas fa-trash-alt"></i>';
    required.classList.add("mb-0", "ml-2", "w-50", "d-flex", "align-items-center");
    required.innerHTML = `<input type="checkbox" name="required[]" value="1" class="mr-2 required"/> necesario?`;
    name.type = "text";
    name.name = "name[]";
    name.required = "true";
    name.placeholder = "Nombre del campo / Etiqueta";
    name.classList.add("form-control", "ml-2", "name");
    order.type = "number";
    order.name = "order[]";
    order.min = 0;
    order.placeholder = "Orden";
    order.classList.add("form-control", "w-50", "mr-2", "order");
    type.classList.add("form-control", "type");
    type.name = "type[]";
    type.required = "true";
    type.innerHTML = `<option value="" hidden>-- Tipo --</option>`
        + `<option value="input:text">Text</option>`
        + `<option value="input:email">Email</option>`
        + `<option value="input:phone">Phone</option>`
        + `<option value="input:number">Number</option>`
        + `<option value="input:check">Checkbox</option>`
        + `<option value="textarea">Textarea</option>`;
    type.addEventListener("change", optionElement);
    row.classList.add("row");
    col.classList.add("col-12", "d-flex");
    element.classList.add("p-3", "border", "bg-white", "mt-3", "element");
    col.append(order);
    col.append(type);
    col.append(name);
    col.append(required);
    col.append(remove);
    row.append(col);
    element.append(row);
    target.append(element);
    if (data) {
        element.querySelector(".name").value = data.name;
        element.querySelector(".order").value = data.order;
        element.querySelector(`.type [value="${data.type}"]`).selected = true;
        element.querySelector(".required").checked = data.required ? true : false;
    }
}
function init() {
    elementDB.forEach(e => addElement(e));
}
init();
</script>
@endpush