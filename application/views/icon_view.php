<?php $this->load->view('head/headers'); ?>
<?php $this->load->view('head/nav'); ?>

<meta charset="utf-8">
<!--hoja de estilos para los roles.-->
<link rel="stylesheet" href="assets/css/style_roles.css">
<!--archivo .js donde hace los llamados al controlador y las validaciones-->
<script src="assets/js/icon.js"></script>

<div id="rol">
        <table class="table ">
            <td>
            <form action="CaracteristicaController">
                <button type="submit"  class="form-control btn btn-info" id="btnPreguntas"><span class="glyphicon glyphicon-question-sign"></span> Características y preguntas</button>
            </form>
                </td>
                <td>
                    <form action="IconController">
                <button type="submit"  class="form-control btn-primary" id="btnIconos"><span class="glyphicon glyphicon-picture"></span> Iconos</button>
            </form>
                </td>
                <td>
                    <form action="RolController">
                <button type="submit"  class="form-control btn btn-info" id="btnRoles"><span class="glyphicon glyphicon-user"></span> Roles</button>
            </form>
            </td>
        </table>  
    <?php if ($this->session->userdata('tipo')!=3) { 
        echo '<h2>GESTIÓN DE ICONOS</h2>';
        echo '<button type="button" class="btn btn-primary" id="btnAdd" onclick="nuevoIcono();"><span class="glyphicon glyphicon-plus"></span> Nuevo Icono</button>';
        } 
        else{ 
            echo '<h2>ICONOS</h2>';
        }
    ?>
    <!-- tabla donde se muestran todos los registros que se traen de la base de datos por medio del controlador-->
    <table id="tablaRol" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>                
                <th>Icono</th>
                <th>Acción</th>

            </tr>
        </thead>
        <tfoot>
            <tr>              
                <th>Nombre</th>
                <th>Descripción</th>                
                <th>Icono</th>
                <th>Acción</th>
            </tr>
        </tfoot>
        <tbody>

        </tbody>
    </table>


    <!-- Ventana Modal para registrar la informacion de una Rol-->

       
         <!-- <form role="form" method="post" enctype="multipart/form-data"> -->
    <div class="modal fade" id="modalRegistroIcono" role="dialog">
            <form role="form"  action="<?php echo base_url('IconController/registrarIcono')?>" method="post" onsubmit="return validarDatos(this)" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="icono_name" id="icono_name" placeholder="Nombre del icono">
                            </div>
                            <div class="form-group">
                            <label for="descripcion"><span class="glyphicon glyphicon-flag"></span> Descripción del Icono</label><span id="require">*</span><span id="error"></span>
                            <textarea placeholder="Descripción" name="descrip" class="form-control " id ="descrip" ></textarea> 
                            </div>
                            <div class="form-group">
                            <label for="imagen"><span class="glyphicon glyphicon-picture"></span> Imagen PNG</label><span id="require">*</span><span id="error"></span>                     
                            <input type="file" name="userfile" size="20" id="imagen" />
                            </div>    
                        </div>                         
                        <div class="modal-footer" id="inferiorNuevoIcono">
                            <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                            <button type="submit" value="upload" class="btn btn-primary btn-default pull-rigth" id="add_icono"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>
                        </div>
              
                    </div>

                </div>
            </form>   
    </div>
    
    
    
    <!-- Ventana Modal para mostar datos de relacionados de un rol-->
    <div class="modal fade" id="modalVerIcono" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><span class="glyphicon glyphicon-plus"></span> Infomación del Icono</h4>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                    <form role="form">
                        <div class="form-group">
                            <label for="usrname"><span class="glyphicon glyphicon-comment"></span> Nombre del Icono</label>
                            <input type="text" class="form-control" id="icono_name_view" placeholder="Nombre del Icono" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="descripcion"><span class="glyphicon glyphicon-flag"></span> Descripcion</label>
                            <input type="text" class="form-control" id="descripcion_view" placeholder="Descripcion" readonly="readonly">
                        </div>

                        <div class="form-group">
                            <label for="encargado"><span class="glyphicon glyphicon-picture"></span> Icono</label>
                            <div id="encargado_view"></div>
                        </div>

<!--button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-ok"></span> Registrar</button-->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                   <!-- <button type="submit" class="btn btn-primary btn-default pull-rigth" onclick="ActualizarP();" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Actualizar</button>-->

                </div>
            </div>

        </div>
    </div> 
    
    <!-- Ventana Modal para actualizar la informacion de un rol-->
    <div class="modal fade" id="modalActualizarIcono" role="dialog">
            <form role="form"  action="<?php echo base_url('IconController/actualizarIcono')?>" method="post" onsubmit="return validarDatosAct(this)" enctype="multipart/form-data">
                <div class="modal-dialog">
        
            <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:10px 10px;" id="superiorActIcono">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4><span class="glyphicon glyphicon-plus"></span> Registro de Iconos</h4>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                    
                        <div class="form-group">
                            <label for="usrname"><span class="glyphicon glyphicon-comment"></span> Nombre del Icono</label>
                            <input type="text" class="form-control" name="icono_name_edit" id="icono_name_edit" placeholder="Nombre del Icono">
                        </div>
                        <div class="form-group">
                            <label for="descripcion"><span class="glyphicon glyphicon-flag"></span> Descripcion del Icono</label>
                            <textarea placeholder="Descripción" name="descrip_edit" class="form-control " id ="descrip_edit" ></textarea> 


                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id_edit" id="id_edit" placeholder="000">
                            <input type="hidden" class="form-control" name="dir_edit" id="dir_edit" placeholder="000">                            
                        </div>

                        <div class="form-group">
                            <label for="encargado"><span class="glyphicon glyphicon-picture"></span> Icono</label>
                            <div id="encargado_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="imagen"><span class="glyphicon glyphicon-picture"></span> Imagen PNG</label><span id="require">*</span><span id="error"></span>                     
                           
                           <input type="file" name="userfile" size="20" id="imagen" />
                        </div>   
                        </div>                         
                        <div class="modal-footer" id="inferiorNuevoIcono">
                            <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                            <button type="submit" value="upload" class="btn btn-primary btn-default pull-rigth" id="act_icono"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>
                        </div>
              
                    </div>

                </div>
            </form>   
    </div>
    
</div>

