<?php
/**
 * 
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
		 * La  clase ReporteController extiende de la clase CI_Controller, propia del
		 * framework Codeignither
		 * Es una clase que responde que a la  invocacion de los metodos de la clase Reporte_model.
		 * @package   levantamientorequisitos/application/controllers/ReporteController.		 
		 * @version   1.0  Fecha 14-06-2018             
	*/ 

class ReporteController extends CI_Controller {
	/**
		 * Es una función que crea el constructor de la clase. En esta se pueden cargar 
		 * librerias,helper,modelos.		        
	*/ 

	// variable que contiene el nombre generico del Pdf a generar.
	private $nombre_pdf;
    function __construct() {
        parent::__construct();
        //Invocamos a la libreria tcpdf para hacer uso de sus metodos
        $this->load->library('Pdf'); 
        /* 
         * blibioteca de codigo disponible, donde hacemos el llamdo de funciones especiales para permirtir 
         * usar formularios y peticiones de diferentes url 
         */        
		$this->load->helper(array('form', 'url'));                
		//Invocamos a la clase Reporte_model para poder hacer uso de sus metodos
        $this->load->model('Reporte_model'); 
        //Invocamos a la clase Interfaz_model para poder hacer uso de sus metodos
        $this->load->model('Interfaz_model');
        //Invocamos a la clase Normativa_model para poder hacer uso de sus metodos
        $this->load->model('Normativa_model');    
        //El Download Helper Nos ayuda a descargar datos a nuestro computador.
        $this->load->helper('download'); 
        //Se inicializa el nombre generico del Pdf a generar.
        $this->nombre_pdf='Reporte_Requisitos.pdf';   

    }

    /** 
     	 * Este metodo se carga de manera predeterminada cuando llamamos al controlador a traves de la URL	 	 
	*/ 

    public function index() {        
         if($this->session->userdata('login')){//Datos del usuario que se mantienen en sesion

           /* 
             * Agrega los paramametros de la clase sesion a un arreglo.  
             * estos parametros son guardados en la cache cuando el usuario inicia su sesion, los cuales sirven 
             * para realizar validaciones y visualizacion de informacion. 
            */ 
          $login["username"]=$this->session->userdata('username');
          $login["tipo"]=$this->session->userdata('tipo');
          $login["nombre"]=$this->session->userdata('nombre');
          $login["apellido"]=$this->session->userdata('apellido');
          $login["email"]=$this->session->userdata('email');
          $login["login"]=$this->session->userdata('login');          
                   
          }else{ //si el usuario no ha iniciado sesion, entra por este camino y se le redirecciona a la vista del inicio de sesion 
          //Lama a la vista de inicio de sesion.	
          $this->load->view('login');
          }         
    }

    /**
		 * Generar archivo PDF. 
		 * 
		 * Crea un archivo PDf con toda la información del los procesos
		 * sus interfaces,normativas y caracteristicas de calidad que se encuentran asosciados.
		 * 
		 *
		 * @package   levantamientorequisitos/application/controllers/ReporteController.php/generarPDF		 	 
		 * @param     la funcion no recibe paramateros 
		 * @see 	  para mas informacion consultar la documentacion TCPDF	 https://tcpdf.org/
		 * @return    Un archivo con extensión .pdf con toda la información realcionada
		 * @version   1.0                 
	*/ 

    public function generarPDF() {

    	//primera parte de la prueba mostrar un alert para ver la secuencia
    	//echo "<script>alert('Ejjjjjjjjjjjj!.');</script>";
    	//segunda parte ajax y jquery
    	/////////////////////++++++

    	/////////////////////******

echo json_encode("dos");

    }
}
