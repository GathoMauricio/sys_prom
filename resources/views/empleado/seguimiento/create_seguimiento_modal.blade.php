<!-- Modal -->
<div class="modal fade" id="create_seguimiento_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Seguimientos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store_seguimiento') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div id="contenedor_seguimientos"
                        style="width: 100%; height:50vh;background-color:#aed6f1;padding:10px;overflow:hidden;overflow-y:scroll;">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="proceso_id" id="txt_proceso_id" />
                    <input type="text" name="contenido" placeholder="Escriba aquí..." class="form-control"
                        required />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
