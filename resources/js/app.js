import "./bootstrap";
import axios from "axios";
import Inputmask from "inputmask";

$(document).ready(() => {
    //validar que el usuario no pueda forzar la carga de archivos con formatos no permitidos
    const allowedExtensions = /(\.pdf|\.jpg|\.jpeg|\.png)$/i;
    $(".file-input").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        }
    });
    //Crear mascara para el input del rfc
    const input_rfc = $("#txt_rfc_valida");
    const rfc_mask = new Inputmask("aaaa-999999-XXX", {
        mask: "aaaa-999999-*{3}",
        casing: "upper",
        definitions: {
            "*": {
                validator: "[A-Za-z0-9!@#$%^&*()_+={}\\[\\]:;\"'|<>,.?/~`-]",
            },
        },
    });
    rfc_mask.mask(input_rfc);
    //Crear mascara para solo texto
    const maskTexto = new Inputmask("*{1,50}", {
        mask: "*{1,50}", // Permite de 1 a 50 caracteres
        casing: "upper", // Opcional: convierte todo a mayúsculas automáticamente
        placeholder: "", // No muestra guiones o espacios
        definitions: {
            "*": {
                validator: "[A-Za-zÀ-ÿ\\s]", // Solo letras (incluye acentos y espacios)
                cardinality: 1,
            },
        },
    });
    maskTexto.mask($(".text-only-input"));
    // Crear mascara para telefono
    const maskTelefono = new Inputmask("9999999999", {
        mask: "9999999999", // Exactamente 10 dígitos
        placeholder: "", // No muestra guiones o espacios
        definitions: {
            9: {
                // Definición para cada posición
                validator: "[0-9]", // Solo permite números
                cardinality: 1,
            },
        },
    });
    maskTelefono.mask($(".telefono-input"));
    //Crear mascara para input alfanumérico sin caracteres especiales
    const maskAlfanumerico = new Inputmask("*{1,128}", {
        mask: "*{1,128}", // Permite de 1 a 128
        definitions: {
            "*": {
                validator: "[A-Za-zÀ-ÿ0-9\\s]", // Solo permite letras y números (Espacios y Acentos)
                cardinality: 1,
            },
        },
        placeholder: "", // No muestra ningún carácter como placeholder
        casing: "upper", // Opcional: convierte todo a mayúsculas automáticamente
    });
    maskAlfanumerico.mask($(".alphanumeric-input"));
    //Crear mascara NSS
    const nss_input = $("#nss_input");
    const maskNss = new Inputmask("99-99-99-9999-9", {
        mask: "99-99-99-9999-9",
        definitions: {
            9: { validator: "[0-9]" },
        },
        placeholder: "_",
        //clearIncomplete: true,
    });
    maskNss.mask(nss_input);
    //Crear mascara codigo postal
    const cp_input = $("#cp_input");
    const maskCp = new Inputmask("99999", {
        mask: "99999",
        definitions: {
            9: { validator: "[0-9]" },
        },
        placeholder: "",
        //clearIncomplete: true,
    });
    maskCp.mask(cp_input);
    //prevenir formulario para hacer validaciones
    $("#validar_rfc_form").submit((e) => {
        e.preventDefault();
        $("#lista_mensajes").html("");
        let rfcIsValido = false;
        const rfc = $("#txt_rfc_valida").val();
        const estructura = validarEstructuraRFC(rfc);
        //validar si la estructura del rfc es valida
        //messageNotification("Validando estructura.");
        $("#lista_mensajes").append(
            "<li class='text-info'>Validando estructura.</li>"
        );
        if (estructura.isValid) {
            //successNotification("Estructura válida.");
            $("#lista_mensajes").append(
                "<li class='text-success'>Estructura válida.</li>"
            );
            rfcIsValido = true;
        } else {
            rfcIsValido = false;
        }
        //validar si el rfc existe ante el sat
        if (rfcIsValido) {
            //messageNotification("Validando en SAT.");
            $("#lista_mensajes").append(
                "<li class='text-info'>Validando en SAT.</li>"
            );
            const r_validar_rfc_sat = $("#r_validar_rfc_sat").val();
            axios
                .get(r_validar_rfc_sat + "?rfc=" + rfc)
                .then((response) => {
                    //console.log(response.data);
                    if (response.data.rfc[0].esValido) {
                        // successNotification("RFC válido en SAT.");
                        $("#lista_mensajes").append(
                            "<li class='text-success'>RFC válido en SAT.</li>"
                        );
                        // messageNotification("Buscando en SICCOSS.");
                        $("#lista_mensajes").append(
                            "<li class='text-info'>Buscando en el sistema.</li>"
                        );
                        const r_validar_rfc_sistema = $(
                            "#r_validar_rfc_sistema"
                        ).val();
                        axios
                            .get(r_validar_rfc_sistema + "?rfc=" + rfc)
                            .then((response) => {
                                $("#lista_mensajes").append(
                                    "<li class='text-info'>" +
                                        response.data.mensaje +
                                        "</li>"
                                );
                                const data = response.data;
                                console.log(data);
                                if (
                                    data.data != null &&
                                    data.data.estatus == "Precontrato"
                                ) {
                                    alertify
                                        .confirm(
                                            "Seguimiento de Empleado", // Título de la ventana
                                            "El RFC " +
                                                rfc +
                                                " es válido y se encuentra en proceso de precontrato", // Mensaje del confirm
                                            function () {
                                                //Iniciar alta de empleado
                                                const r_seguimiento_empleado =
                                                    $(
                                                        "#r_seguimiento_empleado"
                                                    ).val();
                                                window.location =
                                                    r_seguimiento_empleado +
                                                    "/" +
                                                    encodeURIComponent(
                                                        btoa(rfc)
                                                    );
                                            },
                                            function () {
                                                // Función en caso de cancelar
                                                cancelarValidacion();
                                            }
                                        )
                                        .set("labels", {
                                            ok: "Ir a seguimiento",
                                            cancel: "Cancelar",
                                        }) // Cambia texto de los botones
                                        .set("closable", false);
                                    return 0;
                                }
                                //El RFC es apto para alta de empleado
                                if (
                                    !data.existe &&
                                    !data.sys_prom &&
                                    !data.sicoss &&
                                    data.inactivo == null &&
                                    data.lista_negra == null
                                ) {
                                    successNotification(data.mensaje);
                                    //Confirmar iniciar Alta
                                    alertify
                                        .confirm(
                                            "Nuevo ingreso", // Título de la ventana
                                            "El RFC " +
                                                rfc +
                                                " es válido y no se encuentra registrado en el sistema", // Mensaje del confirm
                                            function () {
                                                //Iniciar alta de empleado
                                                const r_alta_empleado =
                                                    $("#r_alta_empleado").val();
                                                window.location =
                                                    r_alta_empleado +
                                                    "/" +
                                                    encodeURIComponent(
                                                        btoa(rfc)
                                                    );
                                            },
                                            function () {
                                                // Función en caso de cancelar
                                                cancelarValidacion();
                                            }
                                        )
                                        .set("labels", {
                                            ok: "Iniciar Alta",
                                            cancel: "Cancelar",
                                        }) // Cambia texto de los botones
                                        .set("closable", false);
                                }
                                //El RFC no se puede registrar ya se encuentra en estado Activo [Sicoss]
                                if (
                                    data.existe &&
                                    !data.sys_prom &&
                                    data.sicoss &&
                                    !data.inactivo &&
                                    !data.lista_negra
                                ) {
                                    alertify.alert(
                                        "Mensaje",
                                        data.mensaje,
                                        function () {
                                            cancelarValidacion();
                                        }
                                    );
                                }
                                //En esta parte el rfc es apto para reingreso desde [Sisoss]
                                if (
                                    data.existe &&
                                    !data.sys_prom &&
                                    data.sicoss &&
                                    data.inactivo &&
                                    !data.lista_negra
                                ) {
                                    successNotification(data.mensaje);
                                    //Confirmar iniciar Reingreso [Sicoss]
                                    alertify
                                        .confirm(
                                            "Reingreso", // Título de la ventana
                                            data.mensaje, // Mensaje del confirm
                                            function () {
                                                //Iniciar reingreso de empleado desde Sicoss->SysProm
                                                const r_reingreso_sicoss_empleado =
                                                    $(
                                                        "#r_reingreso_sicoss_empleado"
                                                    ).val();
                                                window.location =
                                                    r_reingreso_sicoss_empleado +
                                                    "/" +
                                                    encodeURIComponent(
                                                        btoa(rfc)
                                                    );
                                            },
                                            function () {
                                                // Función en caso de cancelar
                                                cancelarValidacion();
                                            }
                                        )
                                        .set("labels", {
                                            ok: "Iniciar Reingreso",
                                            cancel: "Cancelar",
                                        }) // Cambia texto de los botones
                                        .set("closable", false);
                                }
                                //El RFC se encuentra en lista negra [Sicoss]
                                if (
                                    data.existe &&
                                    !data.sys_prom &&
                                    data.sicoss &&
                                    data.inactivo &&
                                    data.lista_negra
                                ) {
                                    alertify.alert(
                                        "Mensaje",
                                        data.mensaje,
                                        function () {
                                            cancelarValidacion();
                                        }
                                    );
                                }
                                //El RFC se encuentra en estado Activo [SysProm]
                                if (
                                    data.existe &&
                                    data.sys_prom &&
                                    data.sicoss &&
                                    !data.inactivo &&
                                    !data.lista_negra
                                ) {
                                    alertify.alert(
                                        "Mensaje",
                                        data.mensaje,
                                        function () {
                                            cancelarValidacion();
                                        }
                                    );
                                }
                                //El RFC es apto para reingreso [SysProm]
                                if (
                                    data.existe &&
                                    data.sys_prom &&
                                    data.sicoss &&
                                    data.inactivo &&
                                    !data.lista_negra
                                ) {
                                    successNotification(data.mensaje);
                                    //Confirmar iniciar Reingreso [SysProm]
                                    alertify
                                        .confirm(
                                            "Reingreso", // Título de la ventana
                                            data.mensaje, // Mensaje del confirm
                                            function () {
                                                //Iniciar reingreso de empleado desde Sicoss->SysProm
                                                const r_reingreso_sysprom_empleado =
                                                    $(
                                                        "#r_reingreso_sysprom_empleado"
                                                    ).val();
                                                window.location =
                                                    r_reingreso_sysprom_empleado +
                                                    "/" +
                                                    encodeURIComponent(
                                                        btoa(rfc)
                                                    );
                                            },
                                            function () {
                                                // Función en caso de cancelar
                                                cancelarValidacion();
                                            }
                                        )
                                        .set("labels", {
                                            ok: "Iniciar Reingreso",
                                            cancel: "Cancelar",
                                        }) // Cambia texto de los botones
                                        .set("closable", false);
                                }
                                //El RFC se encuentra en lista negra [SysProm]
                                if (
                                    data.existe &&
                                    data.sys_prom &&
                                    data.sicoss &&
                                    data.inactivo &&
                                    data.lista_negra
                                ) {
                                    alertify.alert(
                                        "Mensaje",
                                        data.mensaje,
                                        function () {
                                            cancelarValidacion();
                                        }
                                    );
                                }
                            })
                            .catch((error) => {
                                console.error(error);
                            });
                    } else {
                        errorNotification("No se encontró el RFC en el SAT.");
                        $("#lista_mensajes").append(
                            "<li class='text-danger'>No se encontró el RFC en el SAT.</li>"
                        );
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        } else {
            errorNotification("La estructura del RFC es inválida.");
            $("#lista_mensajes").append(
                "<li class='text-danger'>La estructura del RFC es inválida.</li>"
            );
        }
    });
    $("#form_alta_empleado").submit(function (e) {
        e.preventDefault();
        //validar estado y municipio
        const estado = $("#txt_estado_sepomex").val();
        const municipio = $("#txt_delegacion_numicipio_sepomex").val();
        if (estado.length <= 0 || municipio.length <= 0) {
            errorNotification("Ingrese un código postal válido");
            return false;
        }
        //validar NNS
        const r_validar_nss_alta = $("#r_validar_nss_alta").val();
        const nss = $("#nss_input").val();
        axios
            .get(r_validar_nss_alta + "/" + nss)
            .then((response) => {
                console.log(response.data);
                if (response.data.existe) {
                    errorNotification(response.data.mensaje);
                } else {
                    this.submit();
                }
            })
            .catch((error) => {
                console.error(error);
            });
    });

    $(".select2").select2({
        theme: "bootstrap-5",
    });
    $(".select2").css("border", "1px solid #ddd");
    $(".select2").css("width", "100%");
    $(".select2").css("height", "37px");
    //eventos de carga de documentos
    $("#file_doc_solicitud_empleo").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        } else {
            alertify
                .confirm(
                    "Actualizar Solicitud de Empleo",
                    file.name,
                    function () {
                        $("#form_documento_doc_solicitud_empleo").submit();
                    },
                    function () {}
                )
                .set("labels", {
                    ok: "Actualizar",
                    cancel: "Cancelar",
                }) // Cambia texto de los botones
                .set("closable", false);
        }
    });
    $("#file_doc_fotografia").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        } else {
            alertify
                .confirm(
                    "Actualizar Fotografía",
                    file.name,
                    function () {
                        $("#form_documento_doc_fotografia").submit();
                    },
                    function () {}
                )
                .set("labels", {
                    ok: "Actualizar",
                    cancel: "Cancelar",
                }) // Cambia texto de los botones
                .set("closable", false);
        }
    });
    $("#file_doc_ine").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        } else {
            alertify
                .confirm(
                    "Actualizar INE",
                    file.name,
                    function () {
                        $("#form_documento_doc_ine").submit();
                    },
                    function () {}
                )
                .set("labels", {
                    ok: "Actualizar",
                    cancel: "Cancelar",
                }) // Cambia texto de los botones
                .set("closable", false);
        }
    });
    $("#file_doc_acta_nacimiento").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        } else {
            alertify
                .confirm(
                    "Actualizar Acta de Nacimiento",
                    file.name,
                    function () {
                        $("#form_documento_doc_acta_nacimiento").submit();
                    },
                    function () {}
                )
                .set("labels", {
                    ok: "Actualizar",
                    cancel: "Cancelar",
                }) // Cambia texto de los botones
                .set("closable", false);
        }
    });
    $("#file_doc_nss").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        } else {
            alertify
                .confirm(
                    "Actualizar Número de Seguro Social",
                    file.name,
                    function () {
                        $("#form_documento_doc_nss").submit();
                    },
                    function () {}
                )
                .set("labels", {
                    ok: "Actualizar",
                    cancel: "Cancelar",
                }) // Cambia texto de los botones
                .set("closable", false);
        }
    });
    $("#file_doc_comprobante_domicilio").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        } else {
            alertify
                .confirm(
                    "Actualizar Comprobante de Domicilio",
                    file.name,
                    function () {
                        $("#form_documento_doc_comprobante_domicilio").submit();
                    },
                    function () {}
                )
                .set("labels", {
                    ok: "Actualizar",
                    cancel: "Cancelar",
                }) // Cambia texto de los botones
                .set("closable", false);
        }
    });
    $("#file_doc_comprobante_estudios").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        } else {
            alertify
                .confirm(
                    "Actualizar Comprobante de Estudios",
                    file.name,
                    function () {
                        $("#form_documento_doc_comprobante_estudios").submit();
                    },
                    function () {}
                )
                .set("labels", {
                    ok: "Actualizar",
                    cancel: "Cancelar",
                }) // Cambia texto de los botones
                .set("closable", false);
        }
    });
    $("#file_doc_curp").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        } else {
            alertify
                .confirm(
                    "Actualizar CURP",
                    file.name,
                    function () {
                        $("#form_documento_doc_curp").submit();
                    },
                    function () {}
                )
                .set("labels", {
                    ok: "Actualizar",
                    cancel: "Cancelar",
                }) // Cambia texto de los botones
                .set("closable", false);
        }
    });
    $("#file_doc_csf").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        } else {
            alertify
                .confirm(
                    "Actualizar Constancia de Situación Fiscal",
                    file.name,
                    function () {
                        $("#form_documento_doc_csf").submit();
                    },
                    function () {}
                )
                .set("labels", {
                    ok: "Actualizar",
                    cancel: "Cancelar",
                }) // Cambia texto de los botones
                .set("closable", false);
        }
    });
    $("#file_doc_soporte_bancario").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        } else {
            alertify
                .confirm(
                    "Actualizar Soporte Bancario",
                    file.name,
                    function () {
                        $("#form_documento_doc_soporte_bancario").submit();
                    },
                    function () {}
                )
                .set("labels", {
                    ok: "Actualizar",
                    cancel: "Cancelar",
                }) // Cambia texto de los botones
                .set("closable", false);
        }
    });
    $("#file_doc_contrato").on("change", function (event) {
        const file = event.target.files[0]; // Archivo seleccionado
        if (file && !allowedExtensions.test(file.name)) {
            warningNotification("Formato de archivo no permitido."); // Muestra el mensaje de error
            $(this).val(""); // Limpia el input
        } else {
            alertify
                .confirm(
                    "Actualizar Contrato",
                    file.name,
                    function () {
                        $("#form_documento_doc_contrato").submit();
                    },
                    function () {}
                )
                .set("labels", {
                    ok: "Actualizar",
                    cancel: "Cancelar",
                }) // Cambia texto de los botones
                .set("closable", false);
        }
    });
});
window.messageNotification = (text) => alertify.message(text);
window.successNotification = (text) => alertify.success(text);
window.warningNotification = (text) => alertify.warning(text);
window.errorNotification = (text) => alertify.error(text);

window.procesoAltaReingreso = () => {
    $("#valida_rfc_modal").modal("show");
};

window.cancelarValidacion = () => {
    $("#txt_rfc_valida").val("");
    $("#lista_mensajes").html("");
    $("#valida_rfc_modal").modal("hide");
};

window.validarEstructuraRFC = (rfc) => {
    var data = validateRfc(rfc);
    return data;
};

window.getSepomex = (cp) => {
    if (cp.length == 5) {
        const r_get_sepomex = $("#r_get_sepomex").val();
        axios
            .get(r_get_sepomex + "/" + cp)
            .then((response) => {
                if (response.data.error) {
                    warningNotification("El código postal no existe");
                } else {
                    $("#txt_estado_sepomex").val(response.data.estado);
                    $("#txt_delegacion_numicipio_sepomex").val(
                        response.data.municipio
                    );
                    let html_colonias = "";
                    $.each(response.data.colonias, function (index, item) {
                        html_colonias +=
                            '<option value="' +
                            item +
                            '">' +
                            item +
                            "</option>";
                    });
                    $("#cbo_colonia_sepomex").html(html_colonias);
                }
            })
            .catch((error) => {
                console.error(error);
            });
    } else {
        $("#txt_estado_sepomex").val("");
        $("#txt_delegacion_numicipio_sepomex").val("");
        $("#cbo_colonia_sepomex").html("");
    }
};

window.getPlanes = (IDCC) => {
    if (IDCC.length > 0) {
        const r_get_planes = $("#r_get_planes").val();
        axios
            .get(r_get_planes + "/" + IDCC)
            .then((response) => {
                let html = "<option value>--Seleccione una opción--</option>";
                $.each(response.data, function (index, item) {
                    html +=
                        "<option value='" +
                        item.IDCUENTA +
                        "'>" +
                        item.NCUENTA +
                        "</option>";
                });
                $("#cbo_pp").html(html);
            })
            .catch((error) => {
                console.error(error);
            });
    } else {
        $("#cbo_pp").html("<option value>--Seleccione una opción--</option>");
    }
};

window.validaNumeroCuenta = (banco) => {
    $("#txt_numero_cuenta").val("");
    if (banco.length > 0) {
        if (banco == "BANCOMER") {
            const txt_numero_cuenta = $("#txt_numero_cuenta");
            const maskNumCuenta = new Inputmask("9999999999", {
                mask: "9999999999",
                definitions: {
                    9: { validator: "[0-9]" },
                },
                placeholder: "_",
            });
            maskNumCuenta.mask(txt_numero_cuenta);
        } else {
            const txt_numero_cuenta = $("#txt_numero_cuenta");
            const maskNumCuenta = new Inputmask("99999999999", {
                mask: "99999999999",
                definitions: {
                    9: { validator: "[0-9]" },
                },
                placeholder: "_",
            });
            maskNumCuenta.mask(txt_numero_cuenta);
        }
    }
};

window.seleccionarArchivo = (archivo) => {
    $("#file_" + archivo).click();
};

window.createSeguimiento = (proceso_id) => {
    $("#txt_proceso_id").val(proceso_id);
    const r_get_seguimientos = $("#r_get_seguimientos").val();
    axios
        .get(r_get_seguimientos + "/" + proceso_id)
        .then((response) => {
            console.log(response.data);
            let html = "";
            let contador = 0;
            $.each(response.data, function ($index, item) {
                contador++;
                html += `
                    <div style="padding:10px;background-color:#1abc9c;border-radius:5px;">
                        <span class="font-weight-bold">${item.autor.name}</span>
                        <br>
                        ${item.contenido}
                        <br>
                        <span class="font-weight-bold float-right" style="font-size:12px;">${item.created_at} Hrs.</span>
                        <br>
                    </div><br>
                `;
            });
            $("#contenedor_seguimientos").html(html);
            $("#contenedor_seguimientos").animate(
                {
                    scrollTop: $("#contenedor_seguimientos")[0].scrollHeight,
                },
                1000
            );
            if (contador <= 0) {
                $("#contenedor_seguimientos").html(
                    "<br><br><br><br><center class='font-weight-bold'>Aún no hay seguimientos</center>"
                );
            }
        })
        .catch((error) => {
            console.error(error);
        });
    $("#create_seguimiento_modal").modal("show");
};

window.aprobarDocumentacion = (proceso_id) => {
    alertify
        .confirm(
            "Aprobar documentación", // Título de la ventana
            "Seguardará el estado actual de la documentación del empleado", // Mensaje del confirm
            function () {
                //Aprobar documentación de un proceso
                const r_aprobar_documentacion = $(
                    "#r_aprobar_documentacion"
                ).val();
                axios
                    .post(r_aprobar_documentacion, { proceso_id: proceso_id })
                    .then((response) => {
                        if (response.data.estatus == "OK") {
                            successNotification(response.data.mensaje);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Error en la petición:",
                            error.response ? error.response.data : error.message
                        );
                    });
            },
            function () {}
        )
        .set("labels", {
            ok: "Aprobar",
            cancel: "Cancelar",
        }) // Cambia texto de los botones
        .set("closable", false);
};

window.aprobarDocumento = (proceso_id, documento) => {
    alertify
        .confirm(
            "Aprobar documento", // Título de la ventana
            "¿Se actualizará el estado del documento?", // Mensaje del confirm
            function () {
                //Aprobar documento especifico de un proceso
                const r_aprobar_documento = $("#r_aprobar_documento").val();
                axios
                    .post(r_aprobar_documento, {
                        proceso_id: proceso_id,
                        documento: documento,
                    })
                    .then((response) => {
                        console.log(response.data);
                        if (response.data.estatus == "OK") {
                            successNotification(response.data.mensaje);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Error en la petición:",
                            error.response ? error.response.data : error.message
                        );
                    });
            },
            function () {}
        )
        .set("labels", {
            ok: "Aprobar",
            cancel: "Cancelar",
        }) // Cambia texto de los botones
        .set("closable", false);
};

window.rechazarDocumento = (proceso_id, documento) => {
    alertify
        .confirm(
            "Rechazar documento", // Título de la ventana
            "¿Se actualizará el estado del documento?", // Mensaje del confirm
            function () {
                //Aprobar documento especifico de un proceso
                const r_rechazar_documento = $("#r_rechazar_documento").val();
                axios
                    .post(r_rechazar_documento, {
                        proceso_id: proceso_id,
                        documento: documento,
                    })
                    .then((response) => {
                        console.log(response.data);
                        if (response.data.estatus == "OK") {
                            successNotification(response.data.mensaje);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Error en la petición:",
                            error.response ? error.response.data : error.message
                        );
                    });
            },
            function () {}
        )
        .set("labels", {
            ok: "Rechazar",
            cancel: "Cancelar",
        }) // Cambia texto de los botones
        .set("closable", false);
};

window.aprobarProceso = (proceso_id) => {
    alertify
        .confirm(
            "Aprobar proceso", // Título de la ventana
            "Se notificará es estatus del proceso a sus respectivos", // Mensaje del confirm
            function () {
                //Aprobar documentación de un proceso
                const r_aprobar_proceso = $("#r_aprobar_proceso").val();
                axios
                    .post(r_aprobar_proceso, { proceso_id: proceso_id })
                    .then((response) => {
                        if (response.data.estatus == "OK") {
                            successNotification(response.data.mensaje);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Error en la petición:",
                            error.response ? error.response.data : error.message
                        );
                    });
            },
            function () {}
        )
        .set("labels", {
            ok: "Aprobar",
            cancel: "Cancelar",
        }) // Cambia texto de los botones
        .set("closable", false);
};

window.rechazarProceso = (proceso_id) => {
    alertify
        .confirm(
            "Rechazar proceso", // Título de la ventana
            "Se notificará es estatus del proceso a sus respectivos", // Mensaje del confirm
            function () {
                //Aprobar documentación de un proceso
                const r_rechazar_proceso = $("#r_rechazar_proceso").val();
                axios
                    .post(r_rechazar_proceso, { proceso_id: proceso_id })
                    .then((response) => {
                        if (response.data.estatus == "OK") {
                            successNotification(response.data.mensaje);
                            setTimeout(function () {
                                window.location = "/";
                            }, 1000);
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Error en la petición:",
                            error.response ? error.response.data : error.message
                        );
                    });
            },
            function () {}
        )
        .set("labels", {
            ok: "Rechazar",
            cancel: "Cancelar",
        }) // Cambia texto de los botones
        .set("closable", false);
};

window.obtenerIdPuesto = (value) => {
    if (value.length > 0) $("#txt_id_puesto").val(value.split("-")[0]);
    else $("#txt_id_puesto").val("");
};

window.calculaSueldos = () => {
    const tipo_sueldo = $("#cbo_calcula_sueldos").val();
    const r_ajax_configuraciones = $("#r_ajax_configuraciones").val();
    switch (tipo_sueldo) {
        case "Resto del país":
            axios
                .get(r_ajax_configuraciones)
                .then((response) => {
                    const satarioMinimo =
                        response.data.salario_minimo_resto_pais;
                    $("#txt_sueldo_diario").val(satarioMinimo);

                    if ($("#cbo_premio_puntualidad").val() == "SI")
                        $("#txt_premio_puntualidad_cant").val(
                            (satarioMinimo * 10) / 100
                        );
                    else $("#txt_premio_puntualidad_cant").val("0.0");
                    if ($("#cbo_premio_asistencia").val() == "SI")
                        $("#txt_premio_asistencia_cant").val(
                            (satarioMinimo * 10) / 100
                        );
                    else $("#txt_premio_asistencia_cant").val("0.0");
                    if ($("#cbo_despensa").val() == "SI")
                        $("#txt_despensa_cant").val((satarioMinimo * 40) / 100);
                    else $("#txt_despensa_cant").val("0.0");
                })
                .catch((error) => {
                    console.error(
                        "Error en la petición:",
                        error.response ? error.response.data : error.message
                    );
                });
            break;
        case "Frontera":
            axios
                .get(r_ajax_configuraciones)
                .then((response) => {
                    const satarioMinimo = response.data.salario_minimo_frontera;
                    $("#txt_sueldo_diario").val(satarioMinimo);

                    if ($("#cbo_premio_puntualidad").val() == "SI")
                        $("#txt_premio_puntualidad_cant").val(
                            (satarioMinimo * 10) / 100
                        );
                    else $("#txt_premio_puntualidad_cant").val("0.0");
                    if ($("#cbo_premio_asistencia").val() == "SI")
                        $("#txt_premio_asistencia_cant").val(
                            (satarioMinimo * 10) / 100
                        );
                    else $("#txt_premio_asistencia_cant").val("0.0");
                    if ($("#cbo_despensa").val() == "SI")
                        $("#txt_despensa_cant").val((satarioMinimo * 40) / 100);
                    else $("#txt_despensa_cant").val("0.0");
                })
                .catch((error) => {
                    console.error(
                        "Error en la petición:",
                        error.response ? error.response.data : error.message
                    );
                });
            break;
        default:
            $("#txt_sueldo_diario").val("0.0");
            $("#txt_premio_puntualidad_cant").val("0.0");
            $("#txt_premio_asistencia_cant").val("0.0");
            $("#txt_despensa_cant").val("0.0");
    }
};

window.reembolsoGasolina = () => {
    const r_ajax_configuraciones = $("#r_ajax_configuraciones").val();
    axios
        .get(r_ajax_configuraciones)
        .then((response) => {
            if ($("#cbo_reembolso_gasolina").val() == "SI")
                $("#txt_reembolso_gasolina_cant").val(
                    response.data.reembolso_gasolina
                );
            else $("#txt_reembolso_gasolina_cant").val("0.0");
        })
        .catch((error) => {
            console.error(
                "Error en la petición:",
                error.response ? error.response.data : error.message
            );
        });
};

window.actualizarMovimiento = (movimiento_id) => {
    alertify
        .confirm(
            "Actualizar estatus", // Título de la ventana
            "Se marcará el movimiendo como procesado", // Mensaje del confirm
            function () {
                //Aprobar documentación de un proceso
                const r_actualizar_movimiento = $(
                    "#r_actualizar_movimiento"
                ).val();
                axios
                    .post(r_actualizar_movimiento, {
                        movimiento_id: movimiento_id,
                    })
                    .then((response) => {
                        if (response.data.estatus == "OK") {
                            successNotification(response.data.mensaje);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Error en la petición:",
                            error.response ? error.response.data : error.message
                        );
                    });
            },
            function () {}
        )
        .set("labels", {
            ok: "Cambiar estatus",
            cancel: "Cancelar",
        }) // Cambia texto de los botones
        .set("closable", false);
};

window.generarBaja = (proceso_id) => {
    alertify
        .confirm(
            "Baja", // Título de la ventana
            "Se generará un movimiento de baja para el último proceso", // Mensaje del confirm
            function () {
                //Aprobar documentación de un proceso
                const r_generar_baja = $("#r_generar_baja").val();
                axios
                    .post(r_generar_baja, {
                        proceso_id: proceso_id,
                    })
                    .then((response) => {
                        if (response.data.estatus == "OK") {
                            successNotification(response.data.mensaje);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Error en la petición:",
                            error.response ? error.response.data : error.message
                        );
                    });
            },
            function () {}
        )
        .set("labels", {
            ok: "Generar",
            cancel: "Cancelar",
        }) // Cambia texto de los botones
        .set("closable", false);
};

window.enviarListaNegra = (empleado_id) => {
    alertify
        .prompt(
            "Lista negra", // Título de la ventana
            "Se enviará al empleado a la lista negra, por favo ingresé el motivo a continuación...",
            "", // Mensaje del confirm
            function (e, motivo) {
                if (motivo.length > 0) {
                    const r_enviar_lista_negra = $(
                        "#r_enviar_lista_negra"
                    ).val();
                    axios
                        .post(r_enviar_lista_negra, {
                            empleado_id: empleado_id,
                            motivo: motivo,
                        })
                        .then((response) => {
                            console.log(response.data);
                            if (response.data.estatus == "OK") {
                                successNotification(response.data.mensaje);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1000);
                            }
                        })
                        .catch((error) => {
                            console.error(
                                "Error en la petición:",
                                error.response
                                    ? error.response.data
                                    : error.message
                            );
                        });
                } else {
                    errorNotification("Por favor ingrese un motivo.");
                    return 0;
                }
            },
            function () {}
        )
        .set("labels", {
            ok: "Enviar",
            cancel: "Cancelar",
        }) // Cambia texto de los botones
        .set("closable", false);
};

window.quitarListaNegra = (empleado_id) => {
    alertify
        .confirm(
            "Lista negra", // Título de la ventana
            "Se removerá al empleado de la lista negra", // Mensaje del confirm
            function () {
                //Aprobar documentación de un proceso
                const r_quitar_lista_negra = $("#r_quitar_lista_negra").val();
                axios
                    .post(r_quitar_lista_negra, {
                        empleado_id: empleado_id,
                    })
                    .then((response) => {
                        if (response.data.estatus == "OK") {
                            successNotification(response.data.mensaje);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Error en la petición:",
                            error.response ? error.response.data : error.message
                        );
                    });
            },
            function () {}
        )
        .set("labels", {
            ok: "Quitar",
            cancel: "Cancelar",
        }) // Cambia texto de los botones
        .set("closable", false);
};

window.eliminarEmpleado = (empleado_id) => {
    alertify
        .confirm(
            "Eliminar", // Título de la ventana
            "Atención: Está a punto de eliminar toda la información relacionada a este empleado.", // Mensaje del confirm
            function () {
                //Aprobar documentación de un proceso
                const r_eliminar_empleado = $("#r_eliminar_empleado").val();
                axios
                    .post(r_eliminar_empleado, {
                        _method: "DELETE",
                        empleado_id: empleado_id,
                    })
                    .then((response) => {
                        console.log(response.data);
                        if (response.data.estatus == "OK") {
                            successNotification(response.data.mensaje);
                            setTimeout(function () {
                                const r_empleados_sysprom = $(
                                    "#r_empleados_sysprom"
                                ).val();
                                window.location = r_empleados_sysprom;
                            }, 1000);
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Error en la petición:",
                            error.response ? error.response.data : error.message
                        );
                    });
            },
            function () {}
        )
        .set("labels", {
            ok: "Si, Eliminar",
            cancel: "Cancelar",
        }) // Cambia texto de los botones
        .set("closable", false);
};

window.validarImportacion = (rfc) => {
    const r_validar_importacion = $("#r_validar_importacion").val();
    axios
        .get(r_validar_importacion + "?rfc=" + rfc)
        .then((response) => {
            console.log(response.data);
            if (response.data.estatus == "OK") {
                successNotification(response.data.mensaje);
                setTimeout(function () {
                    const r_importar_empleado = $("#r_importar_empleado").val();
                    window.location =
                        r_importar_empleado +
                        "/" +
                        encodeURIComponent(btoa(rfc));
                }, 1000);
            } else {
                errorNotification(response.data.mensaje);
            }
        })
        .catch((error) => {
            console.error(
                "Error en la petición:",
                error.response ? error.response.data : error.message
            );
        });
};

window.eliminarUsuario = (usuario_id) => {
    alertify
        .confirm(
            "Eliminar", // Título de la ventana
            "Atención: Está a punto de eliminar toda la información relacionada a este usuario.", // Mensaje del confirm
            function () {
                $("#form_eliminar_usuario_" + usuario_id).submit();
            },
            function () {}
        )
        .set("labels", {
            ok: "Si, Eliminar",
            cancel: "Cancelar",
        }) // Cambia texto de los botones
        .set("closable", false);
};

window.asisgnarRol = (idusuario, rol_default) => {
    $("#txt_idusuario").val(idusuario);
    if (rol_default.length > 0) {
        $("#cbo_roles").val(rol_default);
    }
    $("#modal_editar_rol").modal("show");
};

window.cambiarFrontera = (frontera, municipio) => {
    console.log(frontera + " " + municipio);
    const r_cambiar_frontera = $("#r_cambiar_frontera").val();
    axios
        .post(r_cambiar_frontera, {
            _method: "PUT",
            frontera: frontera,
            municipio: municipio,
        })
        .then((response) => {
            console.log(response.data);
            if (response.data.estatus == "OK") {
                successNotification(response.data.mensaje);
            }
        })
        .catch((error) => {
            console.error(
                "Error en la petición:",
                error.response ? error.response.data : error.message
            );
        });
};

window.cargarSueldo = (municipio) => {
    const r_cargar_sueldo = $("#r_cargar_sueldo").val();
    axios
        .get(r_cargar_sueldo + "/" + municipio)
        .then((response) => {
            console.log(response.data);
            if (response.data.frontera == "NO") {
                $("#cbo_calcula_sueldos").val("Resto del país");
            } else {
                $("#cbo_calcula_sueldos").val("Frontera");
            }
            setTimeout(calculaSueldos, 500);
        })
        .catch((error) => {
            console.error(error);
        });
};
