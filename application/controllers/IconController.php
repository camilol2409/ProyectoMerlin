

<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
         * La  clase RolController extiende de la clase CI_Controller, propia del
         * framework Codeignither
         * Es una clase que hace uso de los metodos de la clase Rol_model.
         * @package   levantamientorequisitos/application/controllers/RolController.         
         * @version   1.0  Fecha 13-06-2018                 
    */ 

class IconController extends CI_Controller {
     /**
         * Es una función que crea el constructor de la clase. En esta se pueden cargar 
         * librerias,helper,modelos.                
    */ 
    function __construct() {
        parent::__construct();
        //$this->load->model('Rol_model'); //Para conectarse con el modelo de procesos
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Icon_model');
    }


    /**
         /** 
         * Este metodo se carga de manera predeterminada cuando llamamos al controlador a traves de la URL       
         * funcion que carga la vista
    */ 
    function index() {//funcion que carga la vista
        
        if($this->session->userdata('login')){
            //Datos que se mantienen al iniciar la seseion
            $login["username"]=$this->session->userdata('username');
            $login["tipo"]=$this->session->userdata('tipo');
            $login["nombre"]=$this->session->userdata('nombre');
            $login["apellido"]=$this->session->userdata('apellido');
            $login["email"]=$this->session->userdata('email');
            $login["login"]=$this->session->userdata('login');
            
            $this->load->view('icon_view', $login);

        }else{
            $this->load->view('login');
        }
    }


    /**
         * registrarRol
         * 
         * Registra los datos de un rol de procesolos datos se obtienen mediante metodo POST
         * desde la vista roles_view.php  y utiliza la clase Rol_model
         * metodo registrarSubcaracteristica para registrarlos en la base de datos.
         * 
         *                    
         * @param     la funcion no recibe parametros 
         * @return    true o false        
         * @version   1.0                 
    */ 
    function registrarRol() {

        $nombre =  $_REQUEST['icono_name'];
        $descripcion = $_REQUEST['descrip'];
        $auto=time();
        $params['nombre'] = $nombre;
        $params['descripcion'] = $descripcion;
        $params['direccion'] = $auto;
        $config['upload_path']='./iconos/';
        $config['allowed_types']='png';
        $config['max_size']='2000';
        $config['max_width']='100';
        $config['max_height']='100';
        $config['file_name']=$auto;
        $this->load->library('upload');
        $this->upload->initialize($config);
        $registrado=true;
        if($this->upload->do_upload('userfile'))
        {
            $result = $this->Icon_model->registrarRol($params);
            //echo json_encode($result);
            if(! $result)
            {
                 $registrado=false;
            }
           

        }
        else
        {
            $registrado=false;
        }
        if($registrado)
        {
            echo '<script type="text/javascript"> 
            alert ("Icono guardado correctamente");
                    location.href = "http://localhost/levantamientorequisitos/IconController"; 
                 
                 </script>';
        }
        else
        {
                        echo '<script type="text/javascript"> 
                                alert (" No se pudo guardar el icono ',$this->upload->display_errors(),'");
                                location.href = "http://localhost/levantamientorequisitos/IconController"; 
                              </script>';
        }
        

    }

    
     /**
         * listarRoles       
         * Metodo que retorna una lista de las Roles, este es llamado a traves de una peticion AJAX
         *                
         * @param     la funcion no recibe paramateros 
         * @return    Un arreglo $result. con la informacion de la roles
         * @version   1.0                 
    */ 
    
    public function listarRoles() {

        $data = $this->Icon_model->getRole();  //llama al metodo que pertenece al modelo
        if (!$data) { //si el retorno es falso
            echo json_encode(null);
        } else {
            $row = array(); //creo un arreglo
            foreach ($data as $datos) { //foreach para recorrer la lista de los procesos que retorno el modelo
                //botonos, esto es codigo html
                $id_icono = $datos['id'];
                $dir = "./iconos/".$datos['direccion'].".png";
 $btnView = "<button class='btn btn-primary btn-sm' onclick='verRol($id_icono);'><span class='glyphicon glyphicon-search'></span></button>";
                $btnEdit = "<button class='btn btn-warning btn-sm' onclick='actualizarIcono($id_icono);'><span class='glyphicon glyphicon-pencil'></span></button>";
                $btnDelete = "<button class='btn btn-danger btn-sm' onclick='eliminarIcono($id_icono);'><span class='glyphicon glyphicon-trash'></span></button>";
                $imagen="<img src='$dir' >";
                //$imagen=$dir;
                ///empiezo a llenar el arreglo con los datos de la BD para mostrarlos en la vista
                if ($this->session->userdata('tipo')==3) {
                    $row[] = array(
                       
                        'id' => $datos['id'],
                            'nombre' => $datos['nombre'],
                            'descripcion' => $datos['descripcion'],
                            'direccion' => $imagen,
                            'accion' => $btnView);
                }
                else{
                    $row[] = array(
                        'id' => $datos['id'],
                            'nombre' => $datos['nombre'],
                            'descripcion' => $datos['descripcion'],
                            'direccion' => $imagen,
                            'accion' => $btnView . " " . $btnEdit . " " . $btnDelete 

                    );
                }
                
            }
            $result = array("data" => $row);
            echo json_encode($result); ///retorno el arreglo a la vista
        }
    }


    /**
         * actualizarRol
         * Funcion que es invocada desde la vista roles_view.php
         * Actualiza la informacion de un rol de proceso los datos 
         * se reciben mediante metodo Post 
         *                 
         * @param     la funcion no recibe paramateros 
         * @return    true o false
         * @version   1.0                 
    */ 
    function actualizarIcono() {
        $nombre =  $_REQUEST['icono_name_edit'];
        $descripcion = $_REQUEST['descrip_edit'];
        $direccion = $_REQUEST['dir_edit'];
        $ndireccion = $_FILES['userfile'];        
        $id = $_REQUEST['id_edit'];
        $auto=time();
        $params['nombre'] = $nombre;
        $params['descripcion'] = $descripcion;



//////////////
        $config['upload_path']='./iconos/';
        $config['allowed_types']='png';
        $config['max_size']='2000';
        $config['max_width']='100';
        $config['max_height']='100';
        $config['file_name']=$auto;
        $this->load->library('upload');
        $this->upload->initialize($config);
        $actualizado=true;
        $errores="";
        if(strlen($ndireccion["name"])>0)
        {
            $params['direccion'] = $auto;
            if($this->upload->do_upload('userfile'))
            {
                $result = $this->Icon_model->actualizarRol($params,$id);
            //echo json_encode($result);
                if(! $result)
                {
                     $actualizado=false;
                }
                else
                {
                            if(file_exists (""."./iconos/".$direccion.".png"))
                                unlink(""."./iconos/".$direccion.".png");
        
                }
           

            }
            else
            {
                $actualizado=false;
                $errores=$errores.$this->upload->display_errors();
            }        
        }
        else
        {
            
            $params['direccion'] = $direccion;
            $result = $this->Icon_model->actualizarRol($params,$id);
            if(! $result)
            {
                     $actualizado=false;
            }
        }        
        if($actualizado)
        {
            echo '<script type="text/javascript"> 
            alert ("Icono actualizado correctamente");
                    location.href = "http://localhost/levantamientorequisitos/IconController"; 
                 
                 </script>';
        }
        else
        {
                        echo '<script type="text/javascript"> 
                                alert (" No se pudo actualizar el icono ',$errores,'");
                                location.href = "http://localhost/levantamientorequisitos/IconController"; 
                 
                            </script>';
        }

//////////////        


    }


    /**
         * consultarRolId
         * Funcion que es invocada desde la vista roles_view.php
         * Consulta la informacion de un Rol. Haciendo uso de la clase
         * Rol_model que se encarga de obtener la información. 
         * @param     la funcion no recibe paramateros 
         * @return    La información del rol de acuerdo al $id. False si no coindicide.
         * @version   1.0                 
    */ 
    function consultarRolId() {
        $id = $this->input->post('id_rol');
        $result = $this->Icon_model->rol_Id($id);
        echo json_encode($result);
    }


    /**
         * eliminarRol         
         * Se encarga de eliminar un registro de un rol         
         * @param     la funcion no recibe paramateros 
         * @return    true o false
         * @version   1.0                 
    */ 
    function eliminarRol() {
        $id_rol = $this->input->post('id_rol');
        $direccion= $this->Icon_model->icon_Dir($id_rol);        
 
        $result = $this->Icon_model->eliminarRol($id_rol);
        if(file_exists (""."./iconos/".$direccion.".png"))
            unlink(""."./iconos/".$direccion.".png");
        echo json_encode($result);
    }

}
