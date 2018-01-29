<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 14/04/2017
 * Time: 0:11
 */
class Seccion
{
    private $seccion;
    private $subsecciones;

    public function Seccion( $seccion, $subsecciones ){
        $this->seccion = $seccion;
        $this->subsecciones = $subsecciones;
    }

    public function getName(){
        return $this->seccion;
    }

    public function getSubSecciones(){
        return $this->subsecciones;
    }
}