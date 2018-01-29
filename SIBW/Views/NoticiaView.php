<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 09/04/2017
 * Time: 20:44
 */
class NoticiaView
{

    public function printViewPrincipal($noticia){
        echo '
        <p class="newsTheme" >' . $noticia->getSeccion() . '</p >
        <h1 class="newsTitle"><a href="index.php?modo=noticiaExp&id='. $noticia->getId() .'">'. $noticia->getTitular() .'</a></h1>
        <img class="newsImagePrincipal" src='. $noticia->getImg()->getUrl() .' alt="Imagen de la noticia">
        <p>'. $noticia->getResumen() .'</p>
        <div>
           <hr>
        </div>
        ';
    }
    public function printView($noticia)
    {
        echo '
        <p class="newsTheme" >' . $noticia->getSeccion() . '</p >
        <img class="newsImageCenter" src='. $noticia->getImg()->getUrl() .' alt="Imagen de la ncoticia">
        
        
        
        <h3 class="newsTitle"><a href="index.php?modo='. urlencode("noticiaExp").'&id='. urlencode($noticia->getId()) .'">'. $noticia->getTitular() .'</a></h3>
        <p>'. $noticia->getResumen() .'</p>
        <hr>
        ';
    }
}