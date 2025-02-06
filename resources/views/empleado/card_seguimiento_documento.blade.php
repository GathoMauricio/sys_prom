<div class="col-md-3">
    <div class="card">
        <div class="card-header text-center">
            <b>{{ $nombre_documento }}</b>
            @if (Route::currentRouteName() != 'reingreso_sysprom_empleado' && Route::currentRouteName() != 'empleado')
                <br>
                {{ $model->procesos[0]->{'estatus_' . $var_documento} }}
            @endif
        </div>
        <div class="card-body">
            @if ($model->$var_documento)
                @if (explode('.', $model->$var_documento)[1] == 'pdf')
                    <embed src="{{ asset('storage/documentos/' . $model->id . '/' . $model->$var_documento) }}"
                        width="100%" height="180" type="application/pdf">
                @else
                    <img src="{{ asset('storage/documentos/' . $model->id . '/' . $model->$var_documento) }}"
                        alt="{{ asset('storage/documentos/' . $model->id . '/' . $model->$var_documento) }}"
                        width="100%" height="180">
                @endif
            @else
                <center>
                    <br><br><br>
                    @if ($editar_documento)
                        Favor de cargar un documento en formato .pdf, .jpg, .jpeg o .png
                    @else
                        <br>
                        No disponible
                    @endif
                    <br><br><br><br>
                </center>

            @endif
        </div>
        <div class="card-footer text-center">
            <table style="width:100%">
                <tr>
                    <td>
                        @if ($model->$var_documento)
                            <a href="{{ asset('storage/documentos/' . $model->id . '/' . $model->$var_documento) }}"
                                target="_blank" title="Ver documento" class="text-success"><span
                                    class="icon icon-eye"></span></a>
                        @else
                            <a href="javascript:void(0)" title="No se ha cargado ningún documento"
                                class="text-secondary"><span class="icon icon-eye"></span></a>
                        @endif

                    </td>
                    @if ($editar_documento)
                        @if (
                            $model->procesos[0]->{'estatus_' . $var_documento} != 'Aprobado' ||
                                Route::currentRouteName() == 'reingreso_sysprom_empleado')
                            @can('Cargar documento')
                                <td>
                                    <a href="javascript:void(0)" onclick="seleccionarArchivo('{{ $var_documento }}');"
                                        class="text-info-emphasis" title="Actualizar documento"><span
                                            class="icon icon-upload"></span></a>
                                    <form action="{{ route('actualizar_documento') }}"
                                        id="form_documento_{{ $var_documento }}" method="POST"
                                        enctype="multipart/form-data" style="display:none;">
                                        @csrf
                                        <input type="text" name="empleado_id" value="{{ $model->id }}" />
                                        <input type="file" name="{{ $var_documento }}" id="file_{{ $var_documento }}"
                                            accept=".pdf, .jpg, .jpeg, .png" />
                                    </form>
                                </td>
                            @endcan
                        @endif
                        @if (
                            ($model->$var_documento && $model->procesos[0]->{'estatus_' . $var_documento} == 'Pendiente') ||
                                Route::currentRouteName() == 'reingreso_sysprom_empleado')
                            @can('Aprobar documento')
                                <td>
                                    @if ($model->$var_documento)
                                        <a href="javascript:void(0)"
                                            onclick="aprobarDocumento({{ $model->procesos[0]->id }},'{{ $var_documento }}')"
                                            title="Aprobar documento" class="text-success"><span
                                                class="icon icon-checkmark"></span></a>
                                    @else
                                        <a href="javascript:void(0)" title="Aprobar documento" class="text-secondary"><span
                                                class="icon icon-checkmark"></span></a>
                                    @endif
                                </td>
                            @endcan
                            @can('Rechazar documento')
                                <td>
                                    @if ($model->$var_documento)
                                        <a href="javascript:void(0)"
                                            onclick="rechazarDocumento({{ $model->procesos[0]->id }},'{{ $var_documento }}')"
                                            title="Rechazar documento" class="text-danger"><span
                                                class="icon icon-cross"></span></a>
                                    @else
                                        <a href="javascript:void(0)" title="Rechazar documento" class="text-secondary"><span
                                                class="icon icon-cross"></span></a>
                                    @endif
                                </td>
                            @endcan
                        @endif
                    @endif
                </tr>
            </table>
        </div>
    </div>
</div>
