  <?php 
   echo $prototipo;

   ?>
<html lang="en">
<head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/levantamientorequisitos/assets/css/style_prototipos.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.7.94/css/materialdesignicons.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="<?php echo base_url();?>assets/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/dataTables.bootstrap.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    <link rel = "stylesheet" type = "text/css" 
      href = "https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    <link rel = "stylesheet" type = "text/css" href = "https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">  <!--Iconos Material.-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="/levantamientorequisitos/assets/js/prototipo.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<script type="text/javascript">
    var urll='<?php echo base_url();?>iconos/';
    var pid='<?php echo ($id);?>';

</script>

<form role="form"  action="<?php echo base_url('Controlador/lienzo')?>" method="post">
<div id="container" style="width: 100%; padding: 1%;">
    <h4>
        <p class="text-center">
            PROTOTIPO - PROCESO: 
        </p>
    </h4>



    <div id="prototipo_container">

        <!--Barra lateral izquierda -->
        <div class="left-bar">
            <div class="text-center">
                <a  onclick="imagenes(1)">
                    <span class="mdi mdi-checkbox-blank-circle-outline" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>
            <div class="text-center">
                <a  onclick="imagenes(2)">
                    <span class="mdi mdi-border-all-variant" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>
            <div class="text-center">
                <a onclick="imagenes(3)">
                    <span class="mdi mdi-triangle-outline" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>
            <div class="text-center">
                <a  onclick="return false">
                    <span class="mdi mdi-image" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>
            <div class="text-center">
                <a  onclick="return false">
                    <span class="mdi mdi-table" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>
            <div class="text-center">
                <a onclick="return false">
                    <span class="mdi mdi-pencil" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>

            <div class="text-center">
                <a onclick="setBorrar()">
                    <span id="borrador"class="mdi mdi-eraser" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>

            
        </div>
        <div id="division1" >
            
        </div>
        <div class="r-bar">
            <div class="text-center">
                <a  onclick="etiquetas(1)">
                    <span class="mdi mdi-check-outline" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>
            <div class="text-center">
                <a href="#" onclick="return false">
                    <span class="mdi mdi-water" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>
            <div class="text-center">
                <a href="#" onclick="return false">
                    <span class="mdi mdi-pencil" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>
            <div class="text-center">
                <a  onclick="etiquetas(4)">
                    <span class="mdi mdi-heart-outline" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>
            <div class="text-center">
                <a  onclick="etiquetas(3)">
                    <span class="mdi mdi-security-lock" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>

            <div class="text-center">
                <a  onclick="etiquetas(2)">
                    <span class="mdi mdi-wrench" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>

            <div class="text-center">
                <a href="#" onclick="return false">
                    <span class="mdi mdi-toolbox-outline" style="font-size: 2.5em;">
                    </span>
                </a>
            </div>
        </div>

    </div>

</div>
<div class="modal-footer">




                  <button type="button" class="btn btn-danger btn-default pull-left" onclick="location.href = '<?php echo base_url();?>ProcesoController'""><span class="glyphicon glyphicon-remove"></span> Salir</button>
                    <!--boton que invoca a una funcion proceso.js la cual crea un nuevo proceso-->
                    <button type="button" class="btn btn-primary btn-default pull-rigth" onclick="guardar()"><span class="glyphicon glyphicon-ok"></span> Guardar</button>

</div>
</form>
</body>
<div class="modal fade" id="modalEtiqueta" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:10px 10px;" id="superiorEtiqueta">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><span class="glyphicon glyphicon-plus"></span> Etiqueta</h4>
                </div>
                <div class="modal-body" style="padding:20px 40px;">
                    <form role="form">
                        <div class="form-group">
                            <label for="usrname"><span class="glyphicon glyphicon-comment"></span> Valor de la Etiqueta</label><span id="require">*</span><span id="error"></span>
                            <input type="text" class="form-control" id="valor_etiqueta"  placeholder="Valor de la Etiqueta">
                        </div>
                        <div class="form-group">
                            <label for="usrname"><span class="glyphicon glyphicon-comment"></span> Encargad@</label><span id="require">*</span><span id="error"></span>
                            <input type="text" class="form-control" id="valor_encargado"  placeholder="Encargad@">

                        </div>                        
                        <div class="form-group">
                          
                            <input type="hidden" class="form-control" id="valor_id" >
                                
                        </div>  

                       
                    </form>
                </div>
                <div class="modal-footer" id="inferiorNuevoProceso">
                    <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal" ><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    <!--boton que invoca a una funcion proceso.js la cual crea un nuevo proceso-->
                    <button type="submit" class="btn btn-primary btn-default pull-rigth" data-dismiss="modal" onclick="registrarEtiqueta();" id="add_proceso"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>

                </div>
            </div>

        </div>
 
</div> 



</html>

<script type="text/javascript">
     function salir()
 {
     //window.location.href = "/levantamientorequisitos/ProcesoController";
    //$.post("ProcesoController/listarProcesos");
    //alert("dfghjk");
 }
</script>
 