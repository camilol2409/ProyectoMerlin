<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<nav class="navbar navbar-light  bg-info">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">MerliNN</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url(); ?>ProcesoController">Procesos</a></li>
            <!--<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url(); ?>ProcesoController">Procesos<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#"></a></li>
                </ul>
            </li>-->
            <li><a href="<?php echo base_url(); ?>RolController">Roles</a></li>
            <li><a href="<?php echo base_url(); ?>NormativaController">Normativas</a></li>
            <li><a href="<?php echo base_url(); ?>InterfazController">Interfaces</a></li>
            <li><a href="<?php echo base_url(); ?>CaracteristicaController">RNF</a></li>

            <!-- Modificacion de llamado a funcion de-->
                        <!-- 
                            <li><a href="ReporteController/generarPDF" onclick="showSuccessReport()">Generar Reporte PDF</a></li>   
                         -->
                         <li><a href="#" onclick="showSuccessReport()">Generar Reporte PDF</a></li>  


        </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right: 0px;">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $username; ?></a></li>
            <li><a href="#" onclick="cerrarSesion()"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
        </ul>
    </div>
</nav>


</div>


<script>
    
    function showSuccessReport() {
       
//Muestra alertas de de un llamado de funcion ajax en caso exito el pdf es genrado y da la posibilidad de cambiarlo de ubicacion, en caso de fallo del genrado muestra un mensaje de alerta de pdf no generado
        $.ajax({
            url: "http://localhost/levantamientorequisitos/ReporteController/generarPDF",
            type: "POST",
            dataType: "json",
            data: {
            },
            beforeSend: function () {
                
            },
            success: function (data) {
            

$.confirm({
                            title: 'PDF Generado',
                            content: 'En la Raiz del proyecto. <br> ¿ Desea Guardarlo en una Ubicacion distinta ?',
                            icon: 'glyphicon glyphicon-ok',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            opacity: 0.5,
                            buttons: {
                                'confirm': {
                                    text: 'Guardar',
                                    btnClass: 'btn-blue',
                                    action: function () {
                                        location.href = "ReporteController/guardarPDF"; 
                                    }
                                },
                                cancelar: function () {
                                    $.alert('No se cambio la ubicacion');
                                },
                            }
                        });






            },
            error: function (Error) {
                             
                    
                  $.alert({
                        type: 'red',
                        icon: 'glyphicon glyphicon-warning',
                        title: 'Error!',
                        content: 'Pdf no generado',
                    });

                
            }
        });


    }

    function cerrarSesion() {
        $.ajax({
            url: "<?php echo base_url();?>Login/cerrar",
            type: "POST",
            dataType: "json",
            data: {
            },
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (data) {
                $("#loader").hide();
                window.location.href = "<?php echo base_url();?>";
            },
            error: function (response) {
                $("#loader").hide();
            }
        });
    }

    function reporteCont() {    

       $.post("ReporteController/generarPDF");
        $.alert({
                        type: 'green',
                        icon: 'glyphicon glyphicon-warning',
                        title: 'Exito!',
                        content: 'Reporte PDF Creado exitosamente',
                    });

            /*function (data) {
                if (data === "exito") {
                    $.alert({
                        type: 'orange',
                        icon: 'glyphicon glyphicon-warning',
                        title: 'Advertencia!',
                        content: 'Reporte PDF Creado exitosamente',
                    });
                } else {
                        $.alert({
                            type: 'red',
                            icon: 'glyphicon glyphicon-ok',
                            title: 'Error!',
                            content: 'No se pudo realizar el Registro...',
                        });
                    }
    },"json");*/
}
</script>

