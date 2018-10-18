/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 //variable global para hacer referencia a una tabla
var table;

$(function () { ///esto es jQuejry

    cargarRoles(); ///llamamos a la funcion para que se ejecute al cargar la vista

    $("#descripcion").click(function () {

        if ($("#rol_name").val() == "") {

            $("#proceso_name").focus().before("<span class='error'>Ingrese el nombre del rol</span>");
            $(".error").fadeIn();
        }
    });
    $("#encargado").click(function () {

        if ($("#descripcion").val() == "") {

            $("#prioridad").focus().before("<span class='error'>Ingrese la descripcion del rol</span>");
            $(".error").fadeIn();
        }
    });

});

/**
 * Funcion que se encarga de las busquedas por columnnas en la vista 
*/
$(function () {
    var cont = 1;
    $('#tablaRol tfoot th').each(function () {
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

$(function () {
    $("#rol_name").keypress(function () {
        $(".error").remove();
    });
});

$(function () {
    $("#prioridad").click(function () {
        $(".error").remove();
    });
});

$(function () {
    $("#descripcion").keypress(function () {
        $(".error").remove();
    });
});


/**
 * funcion que carga los roles de proceso  en la  la vista 
 * @returns {Boolean} 
 */ 
function cargarRoles() {

    table = $('#tablaRol').DataTable({//los datos que me envia el controlador los seteo en la tabla html
        "destroy": true,
        "ajax": {
            "retrieve": true,
            "processing": false, //indicador de proceso
            "serverSide": true,
            "searching": false,
            "method": "POST",
            "url": "IconController/listarRoles", //donde llamo a la funcion del controlador para que me liste los proceos
            "data": {
            }
        },
        //seteo los datos que me envia el controlador, el nombre de las columnas son tal cual el nombre que se colocaron en el controlador
        "columns": [
            //{"data": "id"},
            {"data": "nombre"},
            {"data": "descripcion"},
            {"data": "direccion"},
            {"data": "accion"}
        ]
    });
}


//Abre la ventana modal desde la pagina de gestin de subcaracteristicas
function nuevoRol() {
    $("#modalRegistroRol").modal();
}
function prueba() {
            alert("dFGHJ");
}

/*
 * 
 * funcion que envia los datos de un rol al controlador para registarlos en la base datos
 * retorna un JSON con el resultado enviado por el controlador de si los 
 * datos fueron insertados en la base de datos.
 */
function registrarRol() {

    if (validarDatos()) {

$.ajax({
            url: "http://localhost/levantamientorequisitos/IconController/registrarRol",
            type: "POST",
            enctype: 'multipart/form-data',
            dataType: "json",
            data: {

                "nombre": $("#icono_name").val(),
                    "descripcion": $("#descrip").val(),
                    "userfile": $("#imagen").val()
            },
            beforeSend: function () {
                $.alert({
                            type: 'blue',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'Ya existe un Rol con el mismo nombre',
                        });
            },
            success: function (data) {
               
$.alert({
                            type: 'green',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'Ya existe un Rol con el mismo nombre',
                        });
            },
            error: function (response) {
                $.alert({
                            type: 'orange',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'Ya existe un Rol con el mismo nombre',
                        });
            }
        });


       /* $.post("RolController/registrarRol",
                {
                    "nombre": $("#rol_name").val(),
                    "descripcion": $("#descripcion").val(),
                    "userfile": $("#encargado").val()

                },
                function (data) {

                    if (data == "exist") {
                        $.alert({
                            type: 'orange',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'Ya existe un Rol con el mismo nombre',
                        });
                    } else {

                        if (data) {
                            $.alert({
                                type: 'green',
                                icon: 'glyphicon glyphicon-ok',
                                title: 'Exito!',
                                content: 'Rol Registrado',
                            });

                            $("#rol_name").val("");
                            $("#descripcion").val("");
                            $("#encargado").val("");

                            cargarRoles();
                            $('#modalRegistroRol').modal('hide');

                        } else {
                            $.alert({
                                type: 'red',
                                icon: 'glyphicon glyphicon-ok',
                                title: 'Error!',
                                content: 'Rol NO Registrado',
                            });
                            $('#modalRegistroRol').modal('hide');
                        }
                    }

                }, "json");*/


    } else {
        $.alert({
            title: 'Error!',
            content: 'Diligencie todos los campos',
        });
    }

}

function verRol(id_rol) {
    $.post("IconController/consultarRolId", ///consulta los datos del proceso por ID
            {
                "id_rol": id_rol
            },
            function (data) {
                $("#rol_name_view").val(data.nombre); //setea los Txt con los datos de la BD
                $("#descripcion_view").val(data.descripcion);
                 var html = '';
                
                                 html+='<img src="./iconos/'+data.direccion+'.png">'
                    $("#encargado_view").html(html);
                    $("#encargado_view").show();


                ///carga la modal
                $("#modalVerRol").modal();
            }, "json");

}

function actualizarIcono(id_rol) {
    idR = id_rol;
    $.post("IconController/consultarRolId", ///consulta los datos del proceso por ID
            {
                "id_rol": id_rol
            },
            function (data) {

                $("#icono_name_edit").val(data.nombre); //setea los Txt con los datos de la BD
                $("#descrip_edit").val(data.descripcion);
                $("#id_edit").val(idR);
                $("#dir_edit").val(data.direccion);
                var html = '';
                
                                 html+='<img src="./iconos/'+data.direccion+'.png">'
                    $("#encargado_edit").html(html);
                    $("#encargado_edit").show();
                ///carga la modal
                $("#modalActualizarRol").modal();
            }, "json");

}

function ActualizarR() {
    $.post("RolController/actualizarRol",
            {
                "nombre": $("#rol_name_edit").val(),
                "descripcion": $("#descripcion_edit").val(),
                "encargado": $("#encargado_edit").val(),
                "id_rol": idR
            },
            function (data) {
                
                if (data) {
                    $.alert({
                        type: 'green',
                        icon: 'glyphicon glyphicon-ok',
                        title: 'Exito!',
                        content: 'Rol Actualizado',
                    });

                    $("#rol_name").val("");
                    $("#descripcion").val("");
                    $("#encargado").val("");

                    cargarRoles();
                    $('#modalActualizarRol').modal('hide');

                } else {
                    $.alert({
                        type: 'red',
                        icon: 'glyphicon glyphicon-ok',
                        title: 'Error!',
                        content: 'No se actualizo el rol',
                    });
                    $('#modalActualizarRol').modal('hide');
                    cargarRoles();
                }
            }, "json");
}

/*
 * funcion que se comunica con el controlador enviandolo el identificador del rol
 * para poder eliminar los datos de la base de datos.
 * retorna un resultado JSON de si el valor fue eliminado.
 */

function eliminarIcono(id_rol) {

    $.confirm({
        type: 'orange',
        icon: 'glyphicon glyphicon-warning-sign',
        title: 'Advertencia!',
        content: 'Desea eliminar el Icono ?',
        buttons: {
            aceptar: function () {
                $.post("IconController/eliminarRol",
                        {
                            "id_rol": id_rol
                        },
                        function (data) {
                            cargarRoles();
                        }, "json");

            },
            cancelar: function () {

            }
        }
    });
}


/* 
 * funcion que valida que en una cadena no se encuentren caracteres especiales
 * @returns {Boolean} 
 */ 
function isValid_txt(str) {
    return !/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
}


/* 
 * funcion que valida los datos en las ventanas modales, retornando una bandera de tipo boolean 
 * @returns {Boolean} 
 */ 
function validarDatos(algo) {

    var band = true;
    var vacios = false;
    var caract = false;
    var longi = false;    

    if ($("#icono_name").val() == "") {
        $("#icono_name").focus();
        $(".error").fadeIn();
        band = false;
        vacios = true;
    }
    
    if (!isValid_txt($("#icono_name").val())) {
        $("#icono_name").focus();
        $(".error").fadeIn();
        band = false;
        caract = true;
    }
        if ($("#icono_name").val().length > 50) {
        
        $(".error").fadeIn();
        band = false;
        longi = true;
    }

    if ($("#descrip").val() == "") {

        $("#descrip").focus();
        $(".error").fadeIn();
        band = false;
        vacios = true;
    }
        if ($("#descrip").val().length > 250) {
        
        $(".error").fadeIn();
        band = false;
        longi = true;
    }

    if ($("#imagen").val() == "") {
        $("#imagen").focus();
        $(".error").fadeIn();
        band = false;
        vacios = true;
    } 
    if(caract)
    {
                $.alert({
                            type: 'red',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'El nombre no permite caracteres invalidos',
                        });
    }
    if(vacios)
    {
                $.alert({
                            type: 'red',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'Todos los campos son obligatorios',
                        });
    }
    if(longi)
    {
                $.alert({
                            type: 'red',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'Longitud excede max permitido Nombre 50 y Descripcion 250',
                        });
    }
    return band;
}
function validarDatosAct(algo) {

    var band = true;
    var vacios = false;
    var caract = false;
    var longi = false;    

    if ($("#icono_name_edit").val() == "") {
        $("#icono_name_edit").focus();
        $(".error").fadeIn();
        band = false;
        vacios = true;
    }
    
    if (!isValid_txt($("#icono_name_edit").val())) {
        $("#icono_name_edit").focus();
        $(".error").fadeIn();
        band = false;
        caract = true;
    }
        if ($("#icono_name_edit").val().length > 50) {
        
        $(".error").fadeIn();
        band = false;
        longi = true;
    }

    if ($("#descrip_edit").val() == "") {

        $("#descrip_edit").focus();
        $(".error").fadeIn();
        band = false;
        vacios = true;
    }
        if ($("#descrip_edit").val().length > 250) {
        
        $(".error").fadeIn();
        band = false;
        longi = true;
    }
 
    if(caract)
    {
                $.alert({
                            type: 'red',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'El nombre no permite caracteres invalidos',
                        });
    }
    if(vacios)
    {
                $.alert({
                            type: 'red',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'Nombre y descripcion son obligatorios',
                        });
    }
    if(longi)
    {
                $.alert({
                            type: 'red',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'Longitud excede max permitido Nombre 50 y Descripcion 250',
                        });
    }
    return band;
}

/* 
 * funcion que valida que en una cadena de caracteres solo sean de letras
 * @returns {Boolean} 
 */ 
function onlyLetters(l) {
    var valid1 = "/^[a-zA-Z]+$/";
    if ((/^[a-zA-Z]+$/.test(l))) {
        return false;
    } else {
        return true;
    }
}



