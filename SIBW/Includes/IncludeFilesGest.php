<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 16/05/2017
 * Time: 3:49
 */
class IncludeFilesGest
{
    public function IncludeFilesGest()
    {

    }

    public function includeAll()
    {
        $this->Views();
        $this->includeModels();
        $this->includeDatas();
    }

    public function includeModels()
    {
        include "../Objects/Comentario.php";
        include "../Objects/Imagen.php";
        include "../Objects/Noticia.php";
        include "../Objects/Rss.php";
        include "../Objects/Seccion.php";
        include "../Objects/Tags.php";
        include "../Objects/Usuario.php";
        include "../Objects/Anuncio.php";
    }

    public function includeDatas()
    {
        include "../DataBase/DataBase.php";
        include "../DataBase/DataComment.php";
        include "../DataBase/DataNoticias.php";
        include "../DataBase/DataSeccion.php";
        include "../DataBase/DataUsuario.php";
        include "../DataBase/DataTag.php";
        include "../DataBase/DataAnuncio.php";
    }

    public function Views()
    {
        include "../Views/CommentsView.php";
        include "../Views/NoticiaView.php";
        include "../ViewsGest/HeadGestView.php";
        include "../ViewsGest/MenuGestView.php";
        include "../ViewsGest/GestNoticiasView.php";
        include "../ViewsGest/GestSessionView.php";
        include "../ViewsGest/CrearNoticiaView.php";
        include "../ViewsGest/ModificarNoticiaView.php";
        include "../ViewsGest/GestComentariosView.php";
        include "../ViewsGest/ModificarComentarioView.php";
        include "../ViewsGest/CrearComentarioView.php";
        include "../ViewsGest/GestSeccionesView.php";
        include "../ViewsGest/CrearSeccionView.php";
        include "../ViewsGest/ModificarSeccionView.php";
        include "../ViewsGest/GestPublicidadView.php";
        include "../ViewsGest/CrearAnuncioView.php";
        include "../ViewsGest/ModificarAnuncioView.php";
        include "../ViewsGest/GestPortadaView.php";
        include "../ViewsGest/verNoticiaView.php";
    }
}