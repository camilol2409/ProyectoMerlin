/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 //variable global para hacer referencia a una tabla
var table;

$(function () { ///esto es jQuejry

    cargarIconos(); ///llamamos a la funcion para que se ejecute al cargar la vista


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
function cargarIconos() {

    table = $('#tablaRol').DataTable({//los datos que me envia el controlador los seteo en la tabla html
        "destroy": true,
        "ajax": {
            "retrieve": true,
            "processing": false, //indicador de proceso
            "serverSide": true,
            "searching": false,
            "method": "POST",
            "url": "IconController/listarIconos", //donde llamo a la funcion del controlador para que me liste los proceos
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


//Abre la ventana modal de registro de icono
function nuevoIcono() {
    $("#modalRegistroIcono").modal();
}
/**
*Extrae la informacion de la base de datos a traves del controlador 
*del icono y los plasma en la modal
**/
function verIcono(id_icono) {
    $.post("IconController/consultarIconoId", ///consulta los datos del proceso por ID
            {
                "id_icono": id_icono
            },
            function (data) {
                $("#icono_name_view").val(data.nombre); //setea los Txt con los datos de la BD
                $("#descripcion_view").val(data.descripcion);
                 var html = '';
                
                                 html+='<img src="./iconos/'+data.direccion+'.png">'
                    $("#encargado_view").html(html);
                    $("#encargado_view").show();


                ///carga la modal
                $("#modalVerIcono").modal();
            }, "json");

}
/**
*Funcion que obtiene los datos del icono 
*a actualizar y los pone en la ventana
*modal
**/
function actualizarIcono(id_icono) {
    idI= id_icono;
    $.post("IconController/consultarIconoId", ///consulta los datos del proceso por ID
            {
                "id_icono": id_icono
            },
            function (data) {

                $("#icono_name_edit").val(data.nombre); //setea los Txt con los datos de la BD
                $("#descrip_edit").val(data.descripcion);
                $("#id_edit").val(idI);
                $("#dir_edit").val(data.direccion);
                var html = '';
                
                                 html+='<img src="./iconos/'+data.direccion+'.png">'
                    $("#encargado_edit").html(html);
                    $("#encargado_edit").show();
                ///carga la modal
                $("#modalActualizarIcono").modal();
            }, "json");

}

/*
 * funcion que se comunica con el controlador enviando el identificador del Icono
 * para poder eliminar los datos de la base de datos.
 * retorna un resultado JSON de si el valor fue eliminado.
 */
 /**
 *Realiza la llamada al controlador para eliminar un icono
 *en caso de que se le de aceptar
 **/

function eliminarIcono(id_icono) {

    $.confirm({
        type: 'orange',
        icon: 'glyphicon glyphicon-warning-sign',
        title: 'Advertencia!',
        content: 'Desea eliminar el Icono ?',
        buttons: {
            aceptar: function () {
                $.post("IconController/eliminarIcono",
                        {
                            "id_icono": id_icono
                        },
                        function (data) {
                            cargarIconos();
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
function validarDatos(algo) 
{

    var band = true;
    var vacios = false;
    var caract = false;
    var longi = false;    

    if ($("#icono_name").val() == "") 
    {
        $("#icono_name").focus();
        $(".error").fadeIn();
        band = false;
        vacios = true;
    }
    
    if (!isValid_txt($("#icono_name").val())) 
    {
        $("#icono_name").focus();
        $(".error").fadeIn();
        band = false;
        caract = true;
    }
    if ($("#icono_name").val().length > 20) 
    {
        
        $(".error").fadeIn();
        band = false;
        longi = true;
    }

    if ($("#descrip").val() == "") 
    {

        $("#descrip").focus();
        $(".error").fadeIn();
        band = false;
        vacios = true;
    }
    if (!isValid_txt($("#descrip").val())) 
    {
        $("#descrip").focus();
        $(".error").fadeIn();
        band = false;
        caract = true;
    }
    if ($("#descrip").val().length > 40) 
    {
        
        $(".error").fadeIn();
        band = false;
        longi = true;
    }

    if ($("#imagen").val() == "") 
    {
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
                            content: 'El Nombre o Descripcion no permiten caracteres invalidos',
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
                            content: 'Longitud excede max permitido Nombre 20 y Descripcion 40',
                        });
    }
    return band;
}
function validarDatosAct(algo) 
{

    var band = true;
    var vacios = false;
    var caract = false;
    var longi = false;    

    if ($("#icono_name_edit").val() == "") 
    {
        $("#icono_name_edit").focus();
        $(".error").fadeIn();
        band = false;
        vacios = true;
    }
    
    if (!isValid_txt($("#icono_name_edit").val())) 
    {
        $("#icono_name_edit").focus();
        $(".error").fadeIn();
        band = false;
        caract = true;
    }
    if ($("#icono_name_edit").val().length > 20) 
    {
        
        $(".error").fadeIn();
        band = false;
        longi = true;
    }

    if ($("#descrip_edit").val() == "") 
    {

        $("#descrip_edit").focus();
        $(".error").fadeIn();
        band = false;
        vacios = true;
    }
    if (!isValid_txt($("#descrip_edit").val())) 
    {
        $("#descrip_edit").focus();
        $(".error").fadeIn();
        band = false;
        caract = true;
    }
    if ($("#descrip_edit").val().length > 40) 
    {
        
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
                            content: 'El Nombre o Descripcion no permiten caracteres invalidos',
                        });
    }
    if(vacios)
    {
                $.alert({
                            type: 'red',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'Nombre y Descripcion son obligatorios',
                        });
    }
    if(longi)
    {
                $.alert({
                            type: 'red',
                            icon: 'glyphicon glyphicon-warning',
                            title: 'Advertencia!',
                            content: 'Longitud excede max permitido Nombre 20 y Descripcion 40',
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



