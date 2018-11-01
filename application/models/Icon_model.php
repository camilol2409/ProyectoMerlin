<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
         * La clase Icon_model extiende de la clase CI_Model, propia del
         * framework Codeignither. Esta clase recibe peticiones del controlador IconController.
         * conectandodose con la base de datos.
         * @package   levantamientorequisitos/application/models/Icon_model.         
         * @version   1.0  Fecha 15-10-2018             
    */
class Icon_model extends CI_Model 
{
    /**
      * Constructor de la clase
    */

    function __construct() 
    { ///funcion por defecto, NO QUITAR
        parent:: __construct();
    }
    
    /**
         * getIcon  
         * Realiza la consulta a la base de datos de todas las direcciones de Iconos 
         * que se encuentran en la BD. 
         * @param     la funcion no recibe paramateros 
         * @return    Un arreglo con toda la información relacionada.
         *            False, si no hay resultados-.
         * @version   1.0                 
    */ 
    function getIcon() 
    {
        $this->db->order_by("nombre", "asc");
        $data = $this->db->get("icono"); //nombre de la tabla en la base de datos
        if ($data->num_rows() > 0) 
        { //si el numero de filas es mayor a 0
            return $data->result_array(); //retorna un arreglo de tipo roles
        }else 
        {
            return false; /// si no hay datos  en la tabla retorna false
        }
    }

      /**
         * registrarIcono
         * Realiza el registro de la información de un Icono a la base de datos.               
         * @param     Array $data. Un arreglo con los datos enviados por el controlador. 
         * @return    True. Si los datos se agregan en la tabla de la base de datos
         *            False. Si no se ingresan los datos.
         * @version   1.0                 
    */ 
    
    function registrarIcono($data) 
    {

        $this->db->insert('icono', $data);
        if ($this->db->affected_rows()) 
        {
            return true;
        }else 
        {
            return false;
        }
    }
    
    /**
         * Icono_Id
         * Realiza la consulta a la base de datos en la tabla Icono.
         * @param     Integer $id_icono 
         * @return    True. Un array con toda la información del rol
        *             False. Si no asocia nada en la busqueda.
         * @version   1.0                 
    */ 

    function icono_Id($id_icono) 
    {

        $this->db->select('*');
        $this->db->where('id', $id_icono);
        $this->db->from('icono');
        $data = $this->db->get();
        if ($data->num_rows() > 0) 
        {
            return $data->row();
        }else 
        {
            return false;
        }
    }
    /**
         * icon_Dir
         * Realiza la consulta a la base de datos en la tabla Icono.
         * @param     Integer $id_icono 
         * @return    True. El nombre de Archivo del icono.
        *             0. Si no asocia nada en la busqueda.
         * @version   1.0                 
    */ 
    function icon_Dir($id_icono) 
    {

        $this->db->select('direccion');
        $this->db->where('id', $id_icono);
        $this->db->from('icono');
        $data = $this->db->get();
        if ($data->num_rows() > 0) 
	    {
            return $data->row()->direccion;
        }else 
        {
            return 0;
        }
    }
    /**
         * actualizarIcono
         * Actualiza la información de un icono en la base de datos. 
         * @param     Array $data datos del icono, Integer $id  id del icono todos llegan desde el controlador                    
         * @return    True. Si los datos se actualiza en la tabla de la base de datos
         *            False. Si no se actualizan los datos.
         * @version   1.0                 
    */ 
    
    function actualizarIcono($data, $id) {//actualizar
        $this->db->where("id", $id);
        $this->db->update('icono', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

     /**
         * eliminarIcono. 
         * 
         * Elimina un registro de la tabla icono
         * @param     Integer $id_icono  id del icono
         * @return    True. Si el registro se elimina en la tabla de la base de datos
         *            False. Si no se elimina el registro.
         * @version   1.0                 
    */ 
    
     function eliminarIcono($id_icono){
        $this->db->where("id", $id_icono);
        $this->db->delete('icono');
       if ($this->db->affected_rows()) {
            return true;
        } else {            
            return false;
        }
    }


    
}

