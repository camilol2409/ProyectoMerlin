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
    	/*
    	   * Se carga la liberia TCPDF para generar el pdf. 
    	   * para mas informacion consultar la documentacion TCPDF
    	*/    	
         $this->load->library('Pdf');        

        $single_cell_size = 115;
        
        $pdf = new TCPDF('L', 'mm', 'LEGAL', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('RNF');
		$pdf->SetTitle('Reporte RNF');
		$pdf->SetSubject('RNF');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// remove default header/footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(true);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('times', '', 9);			
		$pdf->AddPage();

		$pdf->SetFillColor(255, 255, 127);

		$html = '<h2> Reporte Requisitos NO funcionales y de Calidad </h3>';
		$html = '<h3> Proyecto Elicitación Requisitos</h2>';
		/*
			* Se encarga de recopilar toda la información de los procesos
			* que se encuentra en la base de datos.
		*/
		$procesos = $this->Reporte_model->getReporteInfoProceso();

		$pdf->writeHTML($html,true,false,false,false,'C');
		$pdf->AddPage();

				foreach ($procesos as $record) {			
					$pdf->SetTextColor(63, 81, 181);
					$pdf->MultiCell(70, 5,"CARACTERISTICAS DEL PROCESO", 1, 'C', 0, 1, '20', '23', true);	
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Ln(2);

					if($respuestas ==false){
						$pdf->MultiCell(70, 5,"No hay caracteristicas para este proceso", 1, 'C', 0, 1, '20', '', true);
					}else{

						foreach ($respuestas as $resp) {
							$idsub = $resp->id_sub_caracteristica;
							$infosubcar = $this->Reporte_model->getCaractSubc($idsub);						
							foreach ($infosubcar as $info ) {
									$pdf->MultiCell(70, 5,"Caracteristica: ".$info->nombre, 1, 'C', 0, 1, '20', '', true);
									$pdf->MultiCell(70, 5,"Subcaracteristica: ".$info->nombreS, 1, 'C', 0, 1, '20', '', true);								
								}							
													
							$pdf->Ln(2);
							$pdf->MultiCell(70, 5,$resp->descripcion."\n", 1, 'C', 0, 1, '20', '', true);					

						}
					}																											

					$pdf->SetTextColor(63, 81, 181);
					$pdf->MultiCell($single_cell_size, 5,'PROCESO', 1, 'C', 0, 1, '100', '23', true);
					$pdf->SetTextColor(0, 0, 0);
					//$pdf->Cell(0,8,"Informacion Del Proceso",0,false,'L',0,'',false,'M','M');
					//$pdf->Ln(6);
					$pdf->MultiCell($single_cell_size, 5,$record->nombre, 1, 'C', 0, 1, '100', '', true);
					//$pdf->Cell(0,8,"Nombre: ".$record->nombre,0,0);
					//$pdf->Ln(4);
					$pdf->MultiCell($single_cell_size, 5,"Prioridad: ".$record->prioridad, 1, 'C', 0, 1, '100', '', true);
					//$pdf->Cell(0,8,"Prioridad: ".$record->prioridad,0,0 );
					$pdf->MultiCell($single_cell_size, 5,"Orden Secuencia: ".$record->orden_secuencia, 1, 'C', 0, 1, '100', '', true);
					//$pdf->Cell(0,8,"Orden Secuencia: ".$record->orden_secuencia,0,0 );
					//$pdf->Ln(4);
					$pdf->MultiCell($single_cell_size, 5,"Descripción", 1, 'C', 0, 1, '100', '', true);
					//$pdf->Cell(0,8,"Descripción",0,0 );
					//$pdf->Ln(5);
					$pdf->MultiCell($single_cell_size, 5,$record->descripcion."\n", 1, 'C', 0, 1, '100', '', true);
					//$pdf->Ln(4);$record->descripcion."\n", 1, 1, 'C', 0, '', 0);
					//$pdf->MultiCell(175,3,$record->descripcion."\n", 0, 'J', 0, 1, '', '', true);								
					$pdf->SetTextColor(63, 81, 181);
					$pdf->MultiCell($single_cell_size, 5,"ROLES INVOLUCRADOS", 1, 'C', 0, 1, '215', '23', true);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->MultiCell($single_cell_size, 5,$record->nombre_R, 1, 'C', 0, 1, '215', '', true);
					//$pdf->Cell(0,8,"Nombre del Rol: ".$record->nombre_R,0,0 );

					$pdf->SetTextColor(63, 81, 181);
					$pdf->MultiCell(2*$single_cell_size, 5,"PROTOTIPO", 1, 'C', 0, 1, '100', '63', true);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->MultiCell(2*$single_cell_size, 5,"Numero de prototipo: ", 1, 'C', 0, 1, '100', '', true);
					$pdf->MultiCell(2*$single_cell_size, 5,"\n"."\n"."\n"."\n"."\n"."\n", 1, 'C', 0, 1, '100', '', true);

					$idproceso = $record->idproceso;
					/**
						* Se encarga de recopilar toda la información de:
						* interfaces(131), 
						* normativas(132),
						* respuesta (133),
						* asociadas a un proceso en particular que se encuentra en base de datos.
						*@param     Integer $idproceso  identificación del proceso		 			
					*/

					$interfaces = $this->Interfaz_model->getInterfaz_Proceso($idproceso);
					$normativas = $this->Normativa_model->geNormativa_Proceso($idproceso);
					$respuestas = $this->Reporte_model->getRespuestaPregunta($idproceso);
					/* 
					 * Estructura comnado multicell
					 * $pdf->MultiCell(Ancho, alto, texto, borde, alineación, llenado, Hay salto de línea? (1 sí, 0 no), posX='', posY='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0))
					 */									
					$pdf->Ln(5);
					$pdf->SetTextColor(63, 81, 181);
					$pdf->MultiCell(2*$single_cell_size, 5,"INTERFACES Y NORMATIVIDAD", 1, 'C', 0, 1, '100', '', true);
					$pdf->MultiCell($single_cell_size, 5,"INTERFACES", 1, 'C', 0, 0, '100', '', true);	
					$pdf->MultiCell($single_cell_size, 5,"NORMATIVIDAD", 1, 'C', 0, 1, '215', '', true);	
					$pdf->SetTextColor(0, 0, 0);
				

					if($interfaces == false){
							$pdf->MultiCell($single_cell_size, 5,"No hay interfaces relacionadas para este proceso", 1, 'C', 0, 0, '100', '', true);
						if($normativas == false){
							$pdf->MultiCell($single_cell_size, 5,"No hay normatividad relacionada para este proceso", 1, 'C', 0, 1, '215', '', true);
						}
						else {
							foreach ($normativas as $norma) {
								$pdf->MultiCell($single_cell_size, 5, $norma->nombre, 1, 'C', 0, 1, '215', '', true);
							}
						}
					}
					
					else {
						if($normativas == false) {
							$pdf->MultiCell($single_cell_size/2, 5, "ID interfaz", 1, 'C', 0, 0, '100', '', true);
							$pdf->MultiCell($single_cell_size/4, 5, "Entradas", 1, 'C', 0, 0, '157.5', '', true);
							$pdf->MultiCell($single_cell_size/4, 5, "Salidas", 1, 'C', 0, 0, '186.25', '', true);
							$pdf->MultiCell($single_cell_size, 5,"No hay normatividad relacionada para este proceso", 1, 'C', 0, 1, '215', '', true);
							for($i = 0; $i < count($interfaces); $i++) {
								$pdf->MultiCell($single_cell_size, 5,"Nombre: ".$inter->nombre, 1, 'C', 0, 1, '100', '', true);	
								$pdf->MultiCell($single_cell_size, 5,$inter->descripcion."\n", 1, 'C', 0, 1, '100', '', true);
								$pdf->MultiCell($single_cell_size, 5,"Tipo: ".$inter->tipo, 1, 'C', 0, 1, '100', '', true);
								$pdf->MultiCell($single_cell_size, 5,$inter->detalle_tipo."\n", 1, 'C', 0, 1, '100', '', true);		
							}
						} else {
							$norm = $normativas[0];
							$inter = $interfaces[0];
							$pdf->MultiCell($single_cell_size/2, 5, "ID interfaz", 1, 'C', 0, 0, '100', '', true);
							$pdf->MultiCell($single_cell_size/4, 5, "Entradas", 1, 'C', 0, 0, '157.5', '', true);
							$pdf->MultiCell($single_cell_size/4, 5, "Salidas", 1, 'C', 0, 0, '186.25', '', true);
							$pdf->MultiCell($single_cell_size, 5, $norm->nombre, 1, 'C', 0, 1, '215', '', true);
							$pdf->MultiCell($single_cell_size/4, 5, $inter->id, 1, 'C', 0, 0, '100', '', true);
							switch($inter->tipo) {
								case 1:
									$tipoString = "Automática";
									break;
								case 2:
									$tipoString = "Semiautomática";
									break;
								case 3:
									$tipoString = "Manual";
									break;
							}
							$pdf->MultiCell($single_cell_size/4, 5, $tipoString, 1, 'C', 0, 0, '128.75', '', true);
							$pdf->MultiCell($single_cell_size/4, 5, "", 1, 'C', 0, 0, '157.5', '', true);
							if (count($normativas)>1) {
								$norm = $normativas[1];
								$pdf->MultiCell($single_cell_size/4, 5, "", 1, 'C', 0, 0, '186.25', '', true);
								$pdf->MultiCell($single_cell_size, 5, $norm->nombre, 1, 'C', 0, 1, '215', '', true);
							} else {
								$pdf->MultiCell($single_cell_size/4, 5, "", 1, 'C', 0, 1, '186.25', '', true);
							}
							$int_index = 0;
							for($i = 2; $i < count($normativas); $i++) {
								$int_index = $i-1;
								$norm = $normativas[$i];
								if ($int_index < count($interfaces)) {
									$inter = $interfaces[$int_index];
									$pdf->MultiCell($single_cell_size/4, 5, $inter->id, 1, 'C', 0, 0, '100', '', true);
									switch($inter->tipo) {
										case 1:
											$tipoString = "Automática";
											break;
										case 2:
											$tipoString = "Semiautomática";
											break;
										case 3:
											$tipoString = "Manual";
											break;
									}
									$pdf->MultiCell($single_cell_size/4, 5, $tipoString, 1, 'C', 0, 0, '128.75', '', true);
									$pdf->MultiCell($single_cell_size/4, 5, "", 1, 'C', 0, 0, '157.5', '', true);
									$pdf->MultiCell($single_cell_size/4, 5, "", 1, 'C', 0, 0, '186.25', '', true);
								}
								$pdf->MultiCell($single_cell_size, 5, $norm->nombre, 1, 'C', 0, 1, '215', '', true);
							}
							if ($int_index < count($interfaces)-1) {
								for($i = ($int_index+1); $i < count($interfaces); $i++) {
									$inter = $interfaces[$i];
									$pdf->MultiCell($single_cell_size/4, 5, $inter->id, 1, 'C', 0, 0, '100', '', true);
									switch($inter->tipo) {
										case 1:
											$tipoString = "Automática";
											break;
										case 2:
											$tipoString = "Semiautomática";
											break;
										case 3:
											$tipoString = "Manual";
											break;
									}
									$pdf->MultiCell($single_cell_size/4, 5, $tipoString, 1, 'C', 0, 0, '128.75', '', true);
									$pdf->MultiCell($single_cell_size/4, 5, "", 1, 'C', 0, 0, '157.5', '', true);
									$pdf->MultiCell($single_cell_size/4, 5, "", 1, 'C', 0, 1, '186.25', '', true);
								}
							}
						}
					}
					$pdf->AddPage();
				}
		
		// ---------------------------------------------------------
		

		//echo json_encode("exito");

		//Close and output PDF document
		ob_clean();
		//echo "<script>alert('Estás suscrito, ¡Gracias!.');</script>";
		$bandera=true;

		$pdf->Output('Reporte_Requisitos.pdf', 'D');

		/*
			* file_get_contens devuelve el fichero a un string, comenzando por el offset especificado hasta maxlen bytes. Si falla, file_get_contents() devolverá FALSE. 
			* en caso de que la variable data contenga los datos del fichero
			se realiza la descarga con force_download de este segun la configuracion del navegador.
		*/
		if(file_exists ( $this->nombre_pdf))
		{
		$data = file_get_contents($this->nombre_pdf);
		if($data)
		{
			force_download($this->nombre_pdf,$data);
		}
      	}
      	else
      	{
      		$this->load->view('tests');
      	}
		//end_ob_clean();
		//============================================================+
		// END OF FILE
		//============================================================+
	}
}
