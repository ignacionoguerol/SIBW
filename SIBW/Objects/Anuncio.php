<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 15/05/2017
 * Time: 22:17
 */
class Anuncio
{
    private $idAnuncio;
    private $imagen;
    private $texto;
    private $visitas;

    public function Anuncio( $anuncio ){
        $this->idAnuncio = $anuncio["id-anuncio"];
        $this->imagen = $anuncio["imagen"];
        $this->texto = $anuncio["texto"];
        $this->visitas = $anuncio["visitas"];
    }

    public function getId(){
        return $this->idAnuncio;
    }

    public function getTexto(){
        return $this->texto;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function getVisitas(){
        return $this->visitas;
    }

    public function out(){
        echo '<a href="index.php?accion=incAnuncio&idAnuncio='.$this->idAnuncio.'">'.$this->texto.'</a>';
        echo "<img src='" . $this->imagen . "' alt='img'>";
        echo '<p>Visitado: '.$this->visitas.' veces</p>';
    }
}