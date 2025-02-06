<!-- Modal -->
<div class="modal fade" id="valida_rfc_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Validar RFC</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="validar_rfc_form" method="GET">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input name="rfc" id="txt_rfc_valida" class="form-control text-uppercase"
                            placeholder="Ingrese un rfc valido." required />
                    </div>
                    <ul id="lista_mensajes"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="cancelarValidacion();" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Validar</button>
                </div>
            </form>
        </div>
    </div>
</div>
