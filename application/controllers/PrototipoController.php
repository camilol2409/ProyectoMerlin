<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PrototipoController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Proceso_model');
        $this->load->model('Icon_model');
        $this->load->model('Lienzo_model');
    }

    function show($id) {
        if($this->session->userdata('login')){
            //Datos que se mantienen al iniciar la seseion
            $login["username"]=$this->session->userdata('username');
            $login["tipo"]=$this->session->userdata('tipo');
            $login["nombre"]=$this->session->userdata('nombre');
            $login["apellido"]=$this->session->userdata('apellido');
            $login["email"]=$this->session->userdata('email');
            $login["login"]=$this->session->userdata('login');
            $login['id'] = $id;
            $proceso = $this->Proceso_model->proceso_Id($id); 
            //$iconos=$this->$this->Icon_model->getIcon();   
            $login["proceso"] = $proceso;
            //$login["iconos"] = $iconos;
            $this->load->view('prototipo_view', $login);

        }else{
            $this->load->view('login');
        }
    }

    function save($id) {
        echo($id);
        echo(var_dump($this->input->post()));
    }
}