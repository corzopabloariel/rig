<section class="my-3">
    <div class="container-fluid">
        @isset($data["section"])
            @include('layouts.general.breadcrumb', ['section' => $data["section"]])
        @endisset
        <table class="table table-striped table-hover table-borderless pyrus-table">
            <thead class="thead-dark">
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Operación</th>
                <th>Email</th>
                <th>Estado</th>
            </thead>
            <tbody>
                @foreach($data["statements"] AS $statement)
                <tr>
                    <td>{{ date("d/m/Y H:i:s", strtotime($statement->deleted_at)) }}</td>
                    <td>{{ $statement->user->fullname() . (!empty($statement->user->comitente) ? " (#{$statement->user->comitente})" : "") }}</td>
                    <td>{{ $statement->operation->name }}</td>
                    <td>{{ $statement->data["_extras"]["email"] }}</td>
                    <td>{{ empty($statement->deleted_at) ? "Activo" : "Eliminado" }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>