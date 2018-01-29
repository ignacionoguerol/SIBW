<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 09/04/2017
 * Time: 20:13
 */
class Imagen
{
    private $id;
    private $id_noticia;
    private $url;
    private $texto;
    private $fecha;
    private $autor;

    public function Imagen($image)
    {
        $this->id = $image["id-imagen"];
        $this->id_noticia = $image["id-noticia"];
        $this->url = $image["url"];
        $this->texto = $image["texto"];
        $this->fecha = $image["fecha"];
        $this->autor = $image["autor"];
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getAutor(){
        return $this->autor;
    }
}