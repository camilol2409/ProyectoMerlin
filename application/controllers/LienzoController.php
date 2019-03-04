<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Esta clase ProcesoController extiende de la clase CI_controller, 
 * es una clase que responde a eventos de la vista procesos_view.php y que invoca a los metodos de la clase
 * Proceso_model, la cual realiza el CRUD de los Procesos, para finalmente mostrar los datos retornados
 * a la vista procesos_view.
 * Autor: Kristein Johan Ordoñez
 * Fecha: 2018-06-13 
 */

class ProcesoController extends CI_Controller {

    //creamos el constructor de la clase
    function __construct() {
        parent::__construct();
        //Invocamos a la clase Proceso_model para poder hacer uso de sus metodos
        $this->load->model('Lienzo_model');
    }
}
