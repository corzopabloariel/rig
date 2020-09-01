<section class="my-3">
    <div class="container-fluid">
        @isset($data["section"])
            @include('layouts.general.breadcrumb', ['section' => $data["section"]])
        @endisset
        <table class="table table-striped table-hover table-borderless pyrus-table">
            <thead class="thead-dark">
                <th>Fecha</th>
                <th>Entidad</th>
                <th>ID</th>
                <th>Usuario</th>
                <th>Tipo</th>
            </thead>
            <tbody>
                @php
                $type = [
                    "C" => "Create",
                    "U" => "Update",
                    "D" => "Delete",
                    "N" => "Notification",
                    "L" => "Login"
                ];
                @endphp
                @foreach($data["logs"] AS $log)
                <tr>
                    <td>{{ date("d/m/Y H:i:s", strtotime($log->created_at)) }}</td>
                    <td>{{ $log->entity == "email" ? "Envio de Email" : $log->entity }}</td>
                    <td>{{ $log->entity_id }}</td>
                    <td>{{ empty($log->user_id) ? "-" : $log->user->fullname() }}</td>
                    <td>{{ $type[$log->type] ?? "-" }}</td>
                </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="">{{$data["logs"]->links()}}</td>
                    </tr>
                </tfoot>
            </tbody>
        </table>
    </div>
</section>