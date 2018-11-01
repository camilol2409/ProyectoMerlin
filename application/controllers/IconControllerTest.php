<?php
 
namespace App\Tests;
class IconControllerTest extends \PHPUnit\Framework\TestCase
//class IconControllerTest
{
   
    public function testEliminarIconoExiste()
    {
        //$direccion="nombre";
        if(file_exists("/opt/lampp/htdocs/levantamientorequisitos/iconos/nombre.png"))
            echo "true";
        else
            echo "false";
        $this->assertFileExists("/opt/lampp/htdocs/levantamientorequisitos/iconos/nombre.png");
    }
}