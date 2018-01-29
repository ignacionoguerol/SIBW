<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 14/04/2017
 * Time: 0:19
 */
class IncludeFiles
{
    public function IncludeFiles()
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
        include "Objects/Comentario.php";
        include "Objects/Imagen.php";
        include "Objects/Noticia.php";
        include "Objects/Rss.php";
        include "Objects/Seccion.php";
        include "Objects/Anuncio.php";
        include "Objects/Tags.php";
        include "Objects/liveSearch.php";
    }

    public function includeDatas()
    {
        include "DataBase/DataBase.php";
        include "DataBase/DataComment.php";
        include "DataBase/DataNoticias.php";
        include "DataBase/DataSeccion.php";
        include "DataBase/DataUsuario.php";
        include "DataBase/DataAnuncio.php";
        include "DataBase/DataTag.php";
    }

    public function Views()
    {
        // Vistas que se repiten
        include "Views/HeadView.php";
        include "Views/MenuView.php";

        include "Views/NoticiaView.php";
        include "Views/CommentsView.php";
        include "Views/WarningView.php";
        include "Views/RSSView.php";

        include "Views/SocialView.php";
        include "Views/FootView.php";

        // Vistas Completas
        include "Views/PortadaView.php";
        include "Views/NoticiaExtView.php";
        include "Views/NoticiaImpView.php";
        include "Views/SessionView.php";
        include "Views/SeccionView.php";
        include "Views/NotFoundView.php";

        include "Views/NoticiaExtModView.php";
    }
}