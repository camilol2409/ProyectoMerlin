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

class RolGeneralController extends CI_Controller {
     /**
         * Es una función que crea el constructor de la clase. En esta se pueden cargar 
         * librerias,helper,modelos.                
    */ 
    function __construct() {
        parent::__construct();
        $this->load->model('RolGeneral_model'); //Para conectarse con el modelo de procesos
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
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
            
            $this->load->view('rol_general_view', $login);

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

        $id_rol_negocio = $this->input->post('id_rol_negocio');
        $nombre_rol_negocio = $this->input->post('nombre_rol_negocio');
        $descripcion_rol_negocio = $this->input->post('descripcion_rol_negocio');

        $params['id_rol_negocio'] = $id_rol_negocio;
        $params['nombre_rol_negocio'] = $nombre_rol_negocio;
        $params['descripcion_rol_negocio'] = $descripcion_rol_negocio;

        // SI HAY DOS ROLES GENERALES IGUALES .. ¿SE GUARDAN O NO?

        $existe = $this->RolGeneral_model->existe_rol($nombre_rol_negocio);
        if ($existe) {
            echo json_encode("exist");
        } else {
            $result = $this->RolGeneral_model->registrarRol($params);
            echo json_decode($result);
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

        $data = $this->RolGeneral_model->getRole();  //llama al metodo que pertenece al modelo
        if (!$data) { //si el retorno es falso
            echo json_encode(null);
        } else {
            $row = array(); //creo un arreglo
            foreach ($data as $datos) { //foreach para recorrer la lista de los procesos que retorno el modelo
                //botones, esto es codigo html
                $id_rol_negocio = $datos['id_rol_negocio'];
                $btnView = "<button class='btn btn-primary btn-sm' onclick='verRol($id_rol_negocio);'><span class='glyphicon glyphicon-search'></span></button>";
                $btnEdit = "<button class='btn btn-warning btn-sm' onclick='actualizarRol($id_rol_negocio);'><span class='glyphicon glyphicon-pencil'></span></button>";
                $btnDelete = "<button class='btn btn-danger btn-sm' onclick='eliminarRol($id_rol_negocio);'><span class='glyphicon glyphicon-trash'></span></button>";

                ///empiezo a llenar el arreglo con los datos de la BD para mostrarlos en la vista
                if ($this->session->userdata('tipo')==3) {
                    $row[] = array(
                        'id_rol_negocio' => $datos['id_rol_negocio'],
                        'nombre_rol_negocio' => $datos['nombre_rol_negocio'],
                        'descripcion_rol_negocio' => $datos['descripcion_rol_negocio'],
			'accion' => $btnView 
                    );
                }
                else{
                    $row[] = array(
                        'id_rol_negocio' => $datos['id_rol_negocio'],
                        'nombre_rol_negocio' => $datos['nombre_rol_negocio'],
                        'descripcion_rol_negocio' => $datos['descripcion_rol_negocio'],
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
    function actualizarRol() {

        $nombre_rol_negocio = $this->input->post('nombre_rol_negocio');
        $descripcion_rol_negocio = $this->input->post('descripcion_rol_negocio');
        $id_rol_negocio = $this->input->post('id_rol_negocio');

        $params['nombre_rol_negocio'] = $nombre_rol_negocio;
        $params['descripcion_rol_negocio'] = $descripcion_rol_negocio;
        $result = $this->RolGeneral_model->actualizarR($params, $id_rol_negocio);
        echo json_decode($result);
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
        $id_rol_negocio = $this->input->post('id_rol_negocio');
        $result = $this->RolGeneral_model->rol_Id($id_rol_negocio);
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
        $id_rol_negocio = $this->input->post('id_rol_negocio');
        $result = $this->RolGeneral_model->eliminarRol($id_rol_negocio);
        echo json_encode($result);
    }

}
