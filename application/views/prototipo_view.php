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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
    <body>
        <script type="text/javascript">
            var urll='<?php echo base_url();?>iconos/';
            $.estado_desde_db = <?php echo($lienzo_encoded);?>
        </script>

        <div class = "container">
            <div class = "row header">
                <div class = "col-sm-4 offset-sm-4 text-center">
                    <h3>PROTOTIPO - PROCESO:</h4>
                </div>
                <div class = "col-sm-4 text-right">
                    <a href = "#" class = "btn btn-success btn-lg" role = "button" onclick = "addPage()">
                        <span class = "mdi mdi-plus"/>
                        Agregar página
                    </a>
                </div>
            </div>
            <div class = "row">
                <div class = "col-2" id = "page_list">
                    <div class = "col page-element bg-primary" onclick = "changePage(1)">
                        <p>Página 1</p>
                    </div>
                </div>
                <div class = "col-10" id = "contenedor_lienzo">
                    <!--Barra lateral izquierda -->
                    <div class="left-bar text-primary">
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
                                <span class="mdi mdi-eraser" style="font-size: 2.5em;">
                                </span>
                            </a>
                        </div>
                    </div>
                    <div id = "contenido_lienzo">
                    </div>
                    <div class = "right-bar text-primary">
                        <div class="text-center">
                            <a onclick="etiquetas(1)">
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
        </div>
        <div class="footer row" style = "width: 100%;">
            <div class = "col float-right text-right" style = "margin-top: 10px;">
                <a class = "btn btn-danger btn-lg" href = "<?php echo base_url();?>ProcesoController" role = "button" onclick="return confirm('¿Deseas salir? Perderás todo el progreso realizado')">
                    <span class="glyphicon glyphicon-remove"></span> Salir
                </a>
                <a class = "btn btn-primary btn-lg" href = "#" onclick = "guardar('<?php echo base_url(); ?>', <?php echo $id ?>)">
                    <span class="glyphicon glyphicon-ok"></span> Guardar
                </a>
            </div>
        </div>
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
    </body>
</html>
