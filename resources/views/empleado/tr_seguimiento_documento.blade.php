<tr>
    <td width="60%" class="font-weight-bold">
        {{ $nombre_documento }}
    </td>
    <td width="10%">
        @if ($model->$var_documento)
            <a href="{{ asset('storage/documentos/' . $model->id . '/' . $model->$var_documento) }}" target="_blank"
                title="Ver documento" class="text-success"><span class="icon icon-eye"></span></a>
        @else
            <a href="javascript:void(0)" title="No se ha cargado ningún documento" class="text-secondary"><span
                    class="icon icon-eye"></span></a>
        @endif

    </td>
    @if ($editar_documento)
        <td width="10%">
            <a href="javascript:void(0)" onclick="seleccionarArchivo('{{ $var_documento }}');"
                class="text-info-emphasis" title="Actualizar documento"><span class="icon icon-upload"></span></a>
            <form action="{{ route('actualizar_documento') }}" id="form_documento_{{ $var_documento }}" method="POST"
                enctype="multipart/form-data" style="display:none;">
                @csrf
                <input type="text" name="empleado_id" value="{{ $model->id }}" />
                <input type="file" name="{{ $var_documento }}" id="file_{{ $var_documento }}"
                    accept=".pdf, .jpg, .jpeg, .png" />
            </form>
        </td>
    @endif
    {{--  Si el documento está pendiente aplica opciones   --}}
    <td width="10%">
        @if ($model->$var_documento)
            <a href="javascript:void(0)" title="Aprobar documento" class="text-success"><span
                    class="icon icon-checkmark"></span></a>
        @else
            <a href="javascript:void(0)" title="Aprobar documento" class="text-secondary"><span
                    class="icon icon-checkmark"></span></a>
        @endif
    </td>
    <td width="10%">
        @if ($model->$var_documento)
            <a href="javascript:void(0)" title="Rechazar documento" class="text-danger"><span
                    class="icon icon-cross"></span></a>
        @else
            <a href="javascript:void(0)" title="Rechazar documento" class="text-secondary"><span
                    class="icon icon-cross"></span></a>
        @endif
    </td>
</tr>
