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
        $this->load->model('Icono_model');
                $this->load->model('Rol_model');
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
  
public function listarIconos() 
{

  $data = $this->Rol_model->getRole();  //llama al metodo que pertenece al modelo
        if (!$data) { //si el retorno es falso
            echo json_encode(null);
        } else {
            $row = array(); //creo un arreglo
            foreach ($data as $datos) { //foreach para recorrer la lista de los procesos que retorno el modelo
                //botonos, esto es codigo html
                $id_rol = $datos['idrole'];
                $btnView = "<button class='btn btn-primary btn-sm' onclick='verRol($id_rol);'><span class='glyphicon glyphicon-search'></span></button>";
                $btnEdit = "<button class='btn btn-warning btn-sm' onclick='actualizarRol($id_rol);'><span class='glyphicon glyphicon-pencil'></span></button>";
                $btnDelete = "<button class='btn btn-danger btn-sm' onclick='eliminarRol($id_rol);'><span class='glyphicon glyphicon-trash'></span></button>";

                ///empiezo a llenar el arreglo con los datos de la BD para mostrarlos en la vista
                if ($this->session->userdata('tipo')==3) {
                    $row[] = array(
                        'id' => $datos['idrole'],
                        'nombre' => $datos['nombre'],
                        'descripcion' => $datos['descripcion'],
                        'encargado' => $datos['encargado'],
                        'accion' => $btnView 
                    );
                }
                else{
                    $row[] = array(
                        'id' => $datos['idrole'],
                        'nombre' => $datos['nombre'],
                        'descripcion' => $datos['descripcion'],
                        'encargado' => $datos['encargado'],
                        'accion' => $btnView . " " . $btnEdit . " " . $btnDelete
                    );
                }
                
            }
            $result = array("data" => $row);
            echo json_encode($result); ///retorno el arreglo a la vista
        }


    }





    //Funcion que recibe los datos de una nueva normativa, y crea una nueva normativa mediante el modelo 
    function registrarIcono() {
       /* $nombre = $this->input->post('nombre');
        $descripcion= $this->input->post('descripcion');
        $direccion= $this->input->post('direccion');*/
        
        //$params['idproceso'] = $idproceso;
        $completo=time();
       /* $params['nombre'] = $direccion;
        $params['direccion'] = $nombre.$completo;
        $params['descripcion'] = $descripcion;*/


        //parametros de configuracion de subida
        $config['upload_path']='./iconos/';
        $config['allowed_types']='png';
        $config['max_size']='2000';
        $config['max_width']='100';
        $config['max_height']='100';
        //$config['file_name']=$nombre.$completo;
        $config['file_name']="icono".$completo;
        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('userfile');
        
        //$this->load->IconoController();

        site_url('IconoController');

       // $result = $this->Icono_model->registrarIcono($params);
            echo json_encode("result");

          
        
    }

    function eliminarIcono() {

        $id = $this->input->post('id_icono');
        if (is_numeric($id)) {
            $result = $this->Icono_model->eliminarIcono($id);
            echo json_encode($result);
        }
    }

    function consultarIconoId() {
        //parametros de entrada desde la vista por medio de peticiones AJAX de tipo POST
        $id = $this->input->post('id_icono');

        //invoca al metodo de la clase modelo, el cual consulta los registros de un proceso en la base de datos y los retorna en un arreglo
        $result = $this->Icono_model->icono_Id($id);
        //restorna el resultado a la vista.
        echo json_encode($result);
    }
     
    
   
}

