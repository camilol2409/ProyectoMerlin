/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//creamos una variable global de la tabla procesos para ser utilizada en cualquier momento
var table;

//varibale global del idnetificador del proceso para ser utilizada en diferentes funciones
var idproc;

///funcion al iniciar la vista ejecuta X codigo, como si fuera un constructor
$(function () { ///esto es del framework jquery

    cargarIconos(); ///llamamos a la funcion para que se muestre los datos del proceso en la tabla al cargar la vista
    listarRoles(); //listamos los datos de los roles al cargar la vista
    
    //evento al hacer click en la prioridad del proceso
    $("#prioridad").click(function () {

        if ($("#proceso_name").val() == "") {

            $("#proceso_name").focus().before("<span class='error'>Ingrese el nombre del proceso</span>");
            $(".error").fadeIn();
        }
    });
    
    //evento al hacer click en la descripcion del proceso
    $("#descrip").click(function () {

        if ($("#prioridad").val() == "0") {

            $("#prioridad").focus().before("<span class='error'>Seleccione la prioridad del proceso</span>");
            $(".error").fadeIn();
        }
    });

    //evento al hacer click en el rol del proceso
    $("#rol").click(function () {

        if ($("#descrip").val() == "") {

            $("#descrip").focus().before("<span class='error'>Ingrese la descripción del proceso</span>");
            $(".error").fadeIn();
        }
    });

});

/*
 * realiza la busqueda de los datos de los procesos en a tabla
 */
$(function () {
    var ult;
    var cont = 1;

    $('#tablaProcesos tfoot th').each(function () {
        var title = $(this).text();
        ult = this;
        $(this).html('<input type="text" placeholder="Buscar" class="form-control txt_find" id="txt' + cont + '"/>');
        cont++;
    });
    $(ult).html('<p id="txt_acc"></p>');

    table.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change', function () {
            that
                    .search(this.value)
                    .draw();
        });
    });

});

//eventos al presionar una tecla en cada campo del formulario
$(function () {
    $("#proceso_name").keypress(function () {
        $(".error").remove();
    });
});

$(function () {
    $("#prioridad").click(function () {
        $(".error").remove();
    });
});

$(function () {
    $("#descrip").keypress(function () {
        $(".error").remove();
    });
});

$(function () {
    $("#rol").click(function () {
        $(".error").remove();
    });
});
//fin eventos


/*
 * funcion que invoca al controlador, el cual devuelve un JSON con los datos de los procesos.
 * posteriormente recorremos el JSON y mostramos los datos en una tabla
 *
 */
function cargarProcesos() {

    table = $('#tablaProcesos').DataTable({//los datos que me envia el controlador se llenan el la tabla
        "order": [[0, "asc"]], //los ordenamos de mayor a menor por el numero de la secuencia
        "destroy": true,
        "ajax": {
            "retrieve": true,
            "processing": false, //indicador de proceso
            "serverSide": true,
            "searching": false,
            "method": "POST",
            "url": "ProcesoController/listarProcesos", //llamamos a la funcion del controlador para que me liste los proceos
            "data": {
            }
        },
        //llenamos los datos de los proceos que envia el controlador, 
        //el nombre de las columnas son tal cual el nombre que se colocaron en el controlador
        "columns": [
            {"data": "imagen"},
            {"data": "nombre"},
            {"data": "desc"},
            {"data": "prioridad"},
            {"data": "role"},
            {"data": "accion"}
        ]
    });
}

/**
 * funcion que nos permite abiri una modal para diligenciar el formulario de registrar un proceso
 */
function nuevoIcono() {
    $("#modalRegistroIconos").modal();
}

/**
 * function que nos redirecciona a secuenciar procesos
 */
function secuencia(){
    location.href ="ProcesoController/secuencia";
}

/*
 * function que realiza una peticion al controlador, a la cual le enviamos como parametros por medio de AJAX 
 * los valores de registrar un nuevo proceso
 */
 function prueba() {
     $.alert({
                            type: 'orange',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'Ya existe un Proceso con el mismo nombre y la misma descripción',
                        });
 }
function registrarIcono() {

    if (validarDatos())
    {
        $.post("IconoController/registrarIcono", //direccion url donde se encutra el controlador y el nombre de la funcion a la que deseamos llamar
                {   
                    //valores enviador por POST al controlador
                    //mismo que estan en la vista
                    //.val obtiene el valor de la variable y se la manda al controlador
                    "nombre": $("#icono_name").val(),
                    "descripcion": $("#descrip").val(),
                    "direccion": $("#imagen").val()
                },
                function (data) {
                    //el resultado que nos envia el controlador codificado en JSON
                    

                        if (data) {
                            $.alert({
                                type: 'green',
                                icon: 'glyphicon glyphicon-ok',
                                title: 'Exito!',
                                content: 'Icono Agregado',
                            });

                            $("#icono_name").val("");
                            $("#descrip").val("");
                            $("#imagen").val("");        
                            cargarProcesos();
                            $('#modalRegistroIconos').modal('hide');

                        } else {
                            $.alert({
                                type: 'red',
                                icon: 'glyphicon glyphicon-remove',
                                title: 'Error!',
                                content: 'Icono NO Agregado',
                            });
                            $('#modalRegistroIconos').modal('hide');
                        }
                    

                }, "json"); //parseamos el resultado que nos envia el controlador
    }
     else {

        $.alert({
            type: 'red',
            icon: 'glyphicon glyphicon-remove',
            title: 'Error!',
            content: 'Diligencie todos los campos obligatorios',
        });
    }
}

/*
 * function la cual recibe como parametro de entrada el identificador del proceso, y que hace una peticion al controlador
 * del proceso, al cual le enviamos como parametros por AJAX que seran actualizados en la base de datos, y 
 * finalmente nos enviara como resultados los datos atualizados
 */
function actualizarProceso(id_proceso) {


    idP = id_proceso;
    $.post("ProcesoController/consultarProcesoId", ///consulta los datos del proceso por ID en el controlador
            {
                "id_pro": id_proceso
            },
            function (data) {
                //seteamos los Txt con los datos que nos envia el controlador desde la base de datos
                $("#proceso_name_edit").val(data.nombre);
                $("#prioridad_edit").val(data.prioridad);
                $("#secuencia_edit").val(data.orden_secuencia);
                $("#descrip_edit").val(data.descripcion);
                $("#rol_edit").val(data.id_role);
                //cargamos la modal para visualizar los datos
                $("#modalActualizarProcesos").modal();
            }, "json"); //recibimos los datos por medio de JSON
}

/*
 * function que hace una peticion al controlador para actualizar los datos del proceso,
 * al cual le enviamos los datos a actualia como parametros por medio de AJAX que seran actualizados en la base de datos, y 
 * finalmente nos enviara un resultado si atcualizo los datos o no.
 */
function actualizar() {

    if (validarDatos_edit()) {
        $.post("ProcesoController/actualizarProceso", //llamamos a la funcion del controlador
                {
                    //enviamos los datos al controlador por medio de POST
                    "nombre": $("#proceso_name_edit").val(),
                    "prioridad": $("#prioridad_edit").val(),
                    //"secuencia": $("#secuencia_edit").val(),
                    "descripcion": $("#descrip_edit").val(),
                    "role": $("#rol_edit").val(),
                    "id_pro": idP
                },
                function (data) {
                    //recibimos el resultado del controlador y lo procesamos para mostrar los mensajes a la vista
                    if (data) {
                        $.alert({
                            type: 'green',
                            icon: 'glyphicon glyphicon-ok',
                            title: 'Exito!',
                            content: 'Proceso Actualizado',
                        });

                        $("#proceso_name").val("");
                        $("#descrip").val("");
                        $("#prioridad").val("0");
                        $("#rol").val("0");
                        //si se actualizaron los datos, refescamos la tabla con los nuevos datos
                        cargarProcesos();
                        $('#modalActualizarProcesos').modal('hide');

                    } else {
                        $.alert({
                            type: 'red',
                            icon: 'glyphicon glyphicon-remove',
                            title: 'Error!',
                            content: 'No se actualizo el proceso',
                        });
                        $('#modalActualizarProcesos').modal('hide');
                        cargarProcesos();
                    }
                }, "json");
    } else {

        $.alert({
            type: 'red',
            icon: 'glyphicon glyphicon-remove',
            title: 'Error!',
            content: 'Diligencie todos los campos obligatorios',
        });
    }
}
/*
 * funcion que recibe como parametro el identificador del proceso y que mediante AJAX hace una peticion al controlador
 * enviandole como parametro el identificador y retornando como resultado un JSON con los datos del proceso.
 */
function verProceso(id_proceso) {
    $.post("ProcesoController/consultarProcesoId", ///consulta los datos del proceso al controldor
            {   
                //parametro enviado por POST
                "id_pro": id_proceso
            },
            function (data) {
                //el JSON enviado por el controlador como respuesta
                var prioridad = "";
                if (data.prioridad == 1) {
                    prioridad = "Alta";
                }
                if (data.prioridad == 2) {
                    prioridad = "Media";
                }
                if (data.prioridad == 3) {
                    prioridad = "Baja";
                }

                    
                $("#proceso_name_view").val(data.nombre); //setea los Txt con los datos de la BD
  
                $("#rol_view").val(data.rol);
                //$("#prioridad_view").val(prioridad);
                //prioridad
                var html = '';
                    html+='<p>'+prioridad+'</p>'
                    $("#prioridad_view").html(html);
                    $("#prioridad_view").show();
                    //
                //$("#secuencia_view").val(data.orden_secuencia);
                //secuencica
                                var html = '';
                    html+='<p>'+data.orden_secuencia+'</p>'
                    $("#secuencia_view").html(html);
                    $("#secuencia_view").show();
                $("#descrip_view").val(data.descripcion);

                //$("#rol_view").val(data.rol);
                //rol
                var html = '';
                 html+='<p>'+data.rol+'</p>'
                    $("#rol_view").html(html);
                    $("#rol_view").show();
                $("#proceso_title_view").val(data.nombre);
                
                //cargo los nuevos datos actualizados a la vista
                cargarInterfaz_proceso(id_proceso);
                cargarPoliticas(id_proceso);
                cargarRespuestasTopreguntas(id_proceso);
                ///carga la modal
                $("#modalVerProceso").modal();
            }, "json");

}

/*
 * funcion que envia una peticion al controlador por medio de AJAX y que envia como parametro
 * el identificador del proceso y retornando como resultado un JSON.
 */
function eliminar(id_proceso) {    
    
    //mensaje de confirmacion,obtenido del framwork jquey
    $.confirm({
        type: 'orange',
        icon: 'glyphicon glyphicon-warning-sign',
        title: 'Advertencia!',
        content: 'Desea eliminar el Proceso ?',
        buttons: {
            aceptar: function () {                
                $.post("ProcesoController/eliminarProceso", //url donde se encuentra la funcion a la cual hacemos la peticion
                        {
                            //parametro que se envia por medio de POST
                            "id_pro": id_proceso                            
                        },
                        function (data) {                            
                            //el resultado que envia el controlador            
                            //cargamos los procesos con los nuevos datos
                            cargarProcesos();
                        }, "json");

            },            
            cancelar: function () {

            }
        }
    });
}
/*
 * funcion que sirve para valodar los caracteres especiales de una cadena
 */
function isValid_txt(str) {
    return !/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
}

/*
 * funcion que valida los datos del formulario, retornando una bandera de tipo boolean
 * @returns {Boolean}
 */
function validarDatos() {
    var band = true;
    if ($("#icono_name").val() == "") {
        $("#icono_name").focus().before("<span class='error'>Ingrese el nombre del icono</span>");
        $(".error").fadeIn();
        band = false;
    }

    if ($("#icono_name").val().length > 50) {
        $("#icono_name").focus().before("<span class='error'>Excede el numero de caracteres permitidos</span>");
        $(".error").fadeIn();
        band = false;
    }

    //validacion del camino de la imagen
        if ($("#imagen").val() == "") {
        $("#imagen").focus().before("<span class='error'>Seleccione la direccion del icono</span>");
        $(".error").fadeIn();
        band = false;
    }


    if (!isValid_txt($("#icono_name").val())) {
        $("#proceso_name").focus().before("<span class='error'>Caracteres no válidos</span>");
        $(".error").fadeIn();
        band = false;
    }


    if ($("#descrip").val() == "") {

        $("#descrip").focus().before("<span class='error'>Ingrese la descripción del icono</span>");
        $(".error").fadeIn();
        band = false;
    }

    if ($("#descrip").val().length > 250) {

        $("#descrip").focus().before("<span class='error'>Excede el numero de caracteres permitidos</span>");
        $(".error").fadeIn();
        band = false;
    }


    return band;
}
/*
 * funcion que validad los datos al editarlos en el formulario, retornando una bandera de tipo boolean
 * @returns {Boolean}
 */
function validarDatos_edit() {
    var band = true;
    if ($("#proceso_name_edit").val() == "") {
        $("#proceso_name_edit").focus().before("<span class='error'>Ingrese el nombre del proceso</span>");
        $(".error").fadeIn();
        band = false;
    }

    if ($("#proceso_name_edit").val().length > 50) {
        $("#proceso_name_edit").focus().before("<span class='error'>Excede el numero de caracteres permitidos</span>");
        $(".error").fadeIn();
        band = false;
    }

    if (!isValid_txt($("#proceso_name_edit").val())) {
        $("#proceso_name_edit").focus().before("<span class='error'>Caracteres no válidos</span>");
        $(".error").fadeIn();
        band = false;
    }

    if ($("#prioridad_edit").val() == "0") {

        $("#prioridad_edit").focus().before("<span class='error'>Seleccione la prioridad del proceso</span>");
        $(".error").fadeIn();
        band = false;
    }

    if ($("#descrip_edit").val() == "") {

        $("#descrip_edit").focus().before("<span class='error'>Ingrese la descripción del proceso</span>");
        $(".error").fadeIn();
        band = false;
    }

    if ($("#descrip_edit").val().length > 250) {

        $("#descrip_edit").focus().before("<span class='error'>Excede el numero de caracteres permitidos</span>");
        $(".error").fadeIn();
        band = false;
    }

    if ($("#rol_edit").val() == "0") {

        $("#rol_edit").focus().before("<span class='error'>Seleccione el rol del proceso</span>");
        $(".error").fadeIn();
        band = false;
    }

    return band;
}
/*
 * function que verifica una cadena de texto no tenga caracteres especiales
 */
function onlyLetters(l) {
    var valid1 = "/^[a-zA-Z]+$/";
    if ((/^[a-zA-Z]+$/.test
        (l))) {
        return false;
    } else {
        return true;
    }
}
/*
 * funcion que lista los roles de todos los procesos, para ser mostrados en la vista procesos 
 * 
 */