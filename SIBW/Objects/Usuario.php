<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 14/05/2017
 * Time: 21:13
 */
class Usuario
{
    private $usuario;
    private $nombre;
    private $email;

    public function Usuario($usuario){
        $this->usuario = $usuario["usuario"];
        $this->nombre = $usuario["nombre"];
        $this->email = $usuario["email"];
    }

    public function getUserName(){
        return $this->usuario;
    }
}