<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 09/04/2017
 * Time: 20:00
 */

class Comentario
{
    private $id_noticia;
    private $id_comentario;
    private $nombre;
    private $correo;
    private $texto;
    private $fecha;
    private $ip;
    private $view;

    public function Comentario( $comentario ){
        $this->id_noticia = $comentario["id-noticia"];
        $this->id_comentario = $comentario["id-comentario"];
        $this->nombre = $comentario["usuario"];
        $this->correo = $comentario["correo"];
        $this->texto = $comentario["texto"];
        $this->fecha = $comentario["fecha"];
        $this->ip = $comentario["ip"];
        $this->view = new CommentsView();
    }
    public function getId(){
        return $this->id_comentario;
    }
    public function getNoticiaId(){
        return $this->id_noticia;
    }
    public function getNombre(){
        return $this->nombre;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getIp(){
        return $this->ip;
    }

    public function getTexto(){
        return $this->texto;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function out(){
        return $this->view->printView($this);
    }

    public function outGest(){
        return $this->view->printViewGest($this);
    }
}