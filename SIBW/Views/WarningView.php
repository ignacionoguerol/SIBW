<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 10/04/2017
 * Time: 22:53
 */
class WarningView
{
    public function printView($noticia)
    {
        ?>
        <div class="warning" id="warning-comment" style="display: none">
            <p> Complete los campos necesarios: </p>
            <p> Nombre </p>
            <p> Comentario </p>
            <button onclick="EnableAllMessageWarning('warning-comment')" class="btn-general"> Entendido</button>
        </div>
        <div class="warning" id="comment-added" style="display: none">
            <p> Comentario añadido correctamente . </p>
            <button onclick="EnableAllMessageWarning('comment-added')" class="btn-general"> Aceptar</button>
        </div>

        <div class="warning" id="social-share">
            <img src="images/close.jpg" onclick="EnableAllMessageWarning('social-share')" class="btn-close btn-general">
            <p>La siguiente información será compartida:</p>
            <img src=<?php echo $noticia->getImg()->getUrl(); ?>>
            <p>
                <?php
                echo($noticia->getTitular());
                ?>
            </p>
            <h2>Vía @RoboScience</h2>
            <button onclick="EnableAllMessageWarning('social-share')" class="btn-general">Publicar</button>

        </div>

        <?php
    }
}