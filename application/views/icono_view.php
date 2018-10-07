<?php $this->load->view('head/headers'); ?>
<?php $this->load->view('head/nav'); ?>

<meta charset="utf-8">

<!--hoja de estilos para los procesos.-->
<link rel="stylesheet" href="assets/css/style_procesos.css">
<!--archivo .js donde hace los llamados al controlador y las validaciones-->


<script src="assets/js/iconos.js"></script>



<div id="procesos" style="width: 100%; padding: 1%;">

    <!--codigo php que dependiendo del rol del usuario, muestra los botones de agregar proceso y secuenciarlos-->
    <?php
    if ($this->session->userdata('tipo') != 3) {
        echo ' <h2 style="margin-bottom: 20px;">GESTIÓN DE ICONOS</h2>';
        echo ' <div id="btns_accion style="margin-bottom: 50px;">
                    <button type="button" class="btn btn-primary" id="btnAddIcono" onclick="nuevoIcono();"><span class="glyphicon glyphicon-plus"></span> Nuevo Icono</button>
                </div>';
    } else {
        echo '<h2 style="margin-bottom: 20px;">PROCESOS</h2>';
    }
    ?>

    <!--tabla donde se muestra la informacion de los procesos, la cual permite buscarlos y filtrarlos por cada columna-->
    <div style="overflow-x: auto;">
        <table id="tablaIconos" class="table table-striped table-bordered">
            <thead>
                <!--titulo de la tabla-->

<!-- <thead>
             
                <tr>  
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Icono</th>

                    <th>Acción</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                     <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Icono</th>

                    <th>Acción</th>
                </tr>
            </tfoot> -->

                <tr>  
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Icono</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Secuencia</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Icono</th>
                    <th>Accion</th>
                </tr>
            </tfoot>
            <!--cuerpo de la tabla-->
            <tbody>

            </tbody>
        </table>
    </div>

    <!-- Modal en la que registramos los datos de los procesos-->
     <form role="form"  action="<?php echo base_url('IconoController/registrarIcono')?>" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="modalRegistroIconos" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:10px 10px;" id="superiorNuevoIcono">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><span class="glyphicon glyphicon-plus"></span> Registro de Iconos</h4>
                </div>
                <div class="modal-body" style="padding:20px 40px;">
                                           
                                 

                        <div class="form-group">
                            <label for="usrname"><span class="glyphicon glyphicon-comment"></span> Nombre del Icono
                            </label><span id="require">*</span><span id="error"></span>
                            <input type="text" class="form-control" id="icono_name" placeholder="Nombre del icono">
                        </div>
                        <div class="form-group">
                            <label for="descripcion"><span class="glyphicon glyphicon-flag"></span> Descripción del Icono</label><span id="require">*</span><span id="error"></span>
                            <textarea placeholder="Descripción"  require="true" class="form-control " id ="descrip" ></textarea> 
                        </div>
                        <div class="form-group">
                            <label for="imagen"><span class="   glyphicon glyphicon-picture"></span> Imagen PNG</label><span id="require">*</span><span id="error"></span>                     
                           
                            <?php echo form_upload(['name'=>'userfile','class'=>'btn-primary','id'=>'imagen']);?>
                          
                        </div>
                    
                       

                </div>
                  
   
            

                  

                    <div class="modal-footer" id="inferiorNuevoIcono">
                    <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    <!--boton que invoca a una funcion proceso.js la cual crea un nuevo proceso-->
                    <button type="submit" value="upload" class="btn btn-primary btn-default pull-rigth" id="add_icono"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>

                </div>


                    
                </div>
            </div>
  </form>
        </div>
 

</div>  

<script>
    
    /*
     * funcion a la cual nos permite ir a la vista de ver los requisitos no funcionales, pasando como parametro 
     * en la url el identificador del proceso
     */
    function ir_rnf(id_proceso) {
        window.location.href = "<?php echo base_url(); ?>DefinirRNFController/load_rnf_proceso/" + id_proceso;
    }
</script>
