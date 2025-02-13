<!-- Modal -->
<div class="modal fade" id="modal_editar_rol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Rol</h5>
                <button type="button" onclick="$('#modal_editar_rol').modal('hide');" class="close"
                    data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('asignar_rol') }}" method= "POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="idusuario" id="txt_idusuario">
                <div class="modal-body">
                    <select class="form-select" name="role" id="cbo_roles" required>
                        <option value>--Seleccione una opción--</option>
                        @foreach ($roles as $key => $rol)
                            <option ="{{ $rol->name }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="$('#modal_editar_rol').modal('hide');" class="btn btn-secondary"
                        data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
