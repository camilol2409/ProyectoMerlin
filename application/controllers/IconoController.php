<?php

/* 
 
Esta clase es el controlador para gestionar los iconos asociadas a cada prototipo
 * 
 */
/*
 * Esta clase recibe las peticiones desde la vista ico, la cual invoca a 
 * los metodos la clase Icono_model realizando diferentes consultas en la base de datos (CRUD)
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class IconoController extends CI_Controller {

    //Funcion para conectarse y/o cargar modelos y clases
    function __construct() {
        parent::__construct();
        $this->load->model('Proceso_model'); 
        $this->load->model('Icono_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('unit_test');
        

    }
    
    //funcion que carga la vista de login
    function index() {
        if ($this->session->userdata('login')) {
            $login["username"] = $this->session->userdata('username');
            $login["tipo"] = $this->session->userdata('tipo');
            $login["nombre"] = $this->session->userdata('nombre');
            $login["apellido"] = $this->session->userdata('apellido');
            $login["email"] = $this->session->userdata('email');
            $login["login"] = $this->session->userdata('login');

            $this->load->view('icono_view', $login);
        } else {
            $this->load->view('login');
        }
    }
    
    //Funcion que recibe los datos de una nueva normativa, y crea una nueva normativa mediante el modelo 
    function registrarIcono() {
        $nombre = $this->input->post('nombre');
        $descripcion= $this->input->post('descripcion');
        $direccion= $this->input->post('direccion');
        
        //$params['idproceso'] = $idproceso;
        $completo=time();
        $params['nombre'] = $direccion;
        $params['direccion'] = $nombre.$completo;
        $params['descripcion'] = $descripcion;


        //parametros de configuracion de subida
        $config['upload_path']='./iconos/';
        $config['allowed_types']='png';
        $config['max_size']='2000';
        $config['max_width']='100';
        $config['max_height']='100';
        //$config['file_name']=$nombre.$completo;
        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('foto');
        
        

        $result = $this->Icono_model->registrarIcono($params);
            echo json_encode("result");








            
        
    }
     
    
   
}

