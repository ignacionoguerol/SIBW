<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 10/04/2017
 * Time: 6:54
 */
class CommentsView
{
    public function printView( $comentario )
    {
        echo '
                <hr>
                <h1>Nombre: </h1>
                <p>'. $comentario->getNombre() .'</p>
                <h1>Fecha y Hora: </h1>
                <p>'. $comentario->getFecha() .'</p>
                <h1>Comentario: </h1>
                <p>'. $comentario->getTexto() .'</p>
            ';
    }

    public function printViewGest( $comentario ){
        echo '
                <hr>
                <h1>Nombre: </h1>
                <p>'. $comentario->getNombre() .'</p>
                <h1>Correo: </h1>
                <p>'. $comentario->getCorreo() .'</p>
                <h1>Fecha y Hora: </h1>
                <p>'. $comentario->getFecha() .'</p>
                <h1>Dirección IP: </h1>
                <p>'. $comentario->getIp() .'</p>
                <h1>Comentario: </h1>
                <p>'. $comentario->getTexto() .'</p>
            ';
    }
}