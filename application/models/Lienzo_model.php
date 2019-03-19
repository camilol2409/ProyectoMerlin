    <?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * esta clase manipula la peticiones que hace el controlador que extiende de la clase CI_Model.
 * ademas interactua con la base de datos enviando y recibiendo informacion del controlador.
 * Autor: Kristein Johan Ordoñez
 * Fecha: 2018-06-13 
 */
class Lienzo_model extends CI_Model {

    function __construct() { ///funcion por defecto
        parent:: __construct(); 
    }

    function load($proceso_id) {
        $this->db->select('l.id, p.numero, el.width, el.height, el.left_position, el.top, el.source');
        $this->db->where('l.proceso_id', $proceso_id);
        $this->db->from('lienzos l');
        $this->db->join('paginas p', 'p.lienzo_id = l.id');
        $this->db->join('elementos el', 'el.pagina_id = p.id');
        return $this->db->get()->result_array();
    }

    function create($data, $proceso_id) {
        $proceso_to_insert = array('proceso_id' => $proceso_id);
        $this->db->insert('lienzos', $proceso_to_insert);
        $new_lienzo_id = $this->db->insert_id();
        foreach($data as $clave1 => $item) {
            $page_to_insert = array('numero' => $clave1, 'lienzo_id' => $new_lienzo_id, 'nombre' => $item['nombre']);
            $this->db->insert('paginas', $page_to_insert);
            $new_page_id = $this->db->insert_id();
            foreach($item['elementos'] as $element){
                $to_insert = array(
                    'width' => $element['width'],
                    'height' => $element['height'],
                    'top' => $element['top'],
                    'source' => $element['source'],
                    'left_position' => $element['left'],
                    'pagina_id' => $new_page_id,
                );
                $this->db->insert('elementos', $to_insert);
            }
        }
        return true;
    }
}
