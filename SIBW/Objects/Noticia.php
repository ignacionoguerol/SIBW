<?php
/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 09/04/2017
 * Time: 19:59
 */


class Noticia
{
    private $id;
    private $seccion;
    private $titular;
    private $resumen;
    private $texto;
    private $autor;
    private $fecha;
    private $modificacion;
    private $visitas = 0;
    private $video;
    private $view;

    private $listaImg;
    private $img;

    private $tags;

    private $comentarios;

    private $noticias_rel;

    private $textoImp;
    private $estado;

    public function Noticia($noticia)
    {
        // Atributos principales de una noticia
        $this->id = $noticia["id-noticia"];
        $this->estado = $noticia["Estado"];
        $this->seccion = $noticia["seccion"];
        $this->titular = $noticia["titular"];
        $this->resumen = $noticia["resumen"];
        $this->texto = $noticia["texto"];
        $this->autor = $noticia["autor"];
        $this->fecha = $noticia["publicacion"];
        $this->modificacion = $noticia["ultima-modificacion"];
        $this->visitas = $noticia["visitas"];
        $this->img = $noticia["img-principal"];
        $this->video = $noticia["video"];
        $this->view = new NoticiaView();
        // Los objetos Noticia que sean relacionadas no tendrán estos atributos, no son necesarios.
        if (isset($noticia["lista-img"])) {
            $this->listaImg = $noticia["lista-img"];

            $this->tags = $noticia["lista-tags"];

            $this->comentarios = $noticia["lista-comentarios"];

            $this->noticias_rel = $noticia["lista-rel"];

            $this->dividirTextoImpresion();
        }
    }

    public function getEstado(){
        return $this->estado;
    }

    public function getModificacion(){
        return $this->modificacion;
    }
    public function dividirTextoImpresion(){
        $t = $this->texto;
        $posMedia = strlen($t) / 2;
        $posEsp = strpos($t, " ", $posMedia);
        $this->textoImp["colLeft"] = substr($t, 0, $posEsp);
        $this->textoImp["colRight"] = substr($t, $posEsp);
    }

    public function getListImg(){
        return $this->listaImg;
    }

    public function getTexto(){
        return $this->texto;
    }

    public function getTextImpLeft(){
        return $this->textoImp["colLeft"];
    }

    public function getTextImpRight(){
        return $this->textoImp["colRight"];
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getAutor(){
        return $this->autor;
    }

    public function getNewsRel(){
        return $this->noticias_rel;
    }

    public function getComentarios()
    {
        return $this->comentarios;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getUrlImage()
    {
        $this->img->getUrl();
    }

    public function out()
    {
        $this->view->printView($this);
    }

    public function outPrincipal()
    {
        $this->view->printViewPrincipal($this);
    }

    public function getTitular()
    {
        return $this->titular;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function getSeccion()
    {
        return $this->seccion;
    }

    public function getResumen()
    {
        return $this->resumen;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getVideo(){
        return $this->video;
    }
}