<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 10/04/2017
 * Time: 6:45
 */
class DataComment
{
    private $dataBase;

    public function DataComment($dataBase)
    {
        // Array de Objetos Noticia
        $this->dataBase = $dataBase;
    }

    public function getComments( $id_noticia )
    {
        $resultNoticias = $this->dataBase->getResultComments( $id_noticia );
        return $this->buildComment($resultNoticias);
    }

    private function buildComment($resultComment)
    {
        $comentariosRequeridos = array();

        while ($row = $resultComment->fetch_assoc()) {
            array_push($comentariosRequeridos, new Comentario($row));
        }
        return $comentariosRequeridos;
    }

    public function getAllComments(){
        $resultComentarios = $this->dataBase->getResultAllComments();
        return $this->buildComment($resultComentarios);
    }

    public function getFiltro(){
        $result = $this->dataBase->getResultFiltro();
        $filtro = array();
        while( $row = $result->fetch_assoc()){
            array_push( $filtro, $row["palabra"] );
        }

        return $filtro;
    }

    // Añadir comentario
    public function getUsuarioByUser($usuario){
        $result = $this->dataBase->getResultUsuarioByUser( $usuario );
        return $result->fetch_assoc();
    }

    public function getMaxIdComentario($idNoticia){
        $result = $this->dataBase->getResultMaxIdComentario($idNoticia)->fetch_assoc()["idComentario"] + 1;
        return $result;
    }
    function get_client_ip_env() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        if($ipaddress == "::1"){
            $ipaddress = "127.0.0.1";
        }
        return $ipaddress;
    }

    public function crearComentarioGest($idNoticia, $usuario, $texto){
        $idComentario = $this->getMaxIdComentario($idNoticia);
        if(!isset($_SESSION["usuarioGest"]) && !isset($_SESSION["editor"]) || true){
            $usuarioData = $this->getUsuarioByUser($usuario);
            $usuario = $usuarioData["usuario"];
            $correo = $usuarioData["email"];
        }else{
            $correo = $this->dataBase->getEditorEmailByLogIn($usuario)->fetch_assoc()["email"];
            $usuario = $this->dataBase->getEditorNameByLogIn($usuario)->fetch_assoc()["nombre"];
        }


        $fecha = getDate();
        $fecha = str_pad($fecha["year"], 2, '0', STR_PAD_LEFT) . "-" .
            str_pad($fecha["mon"], 2, '0', STR_PAD_LEFT) . "-" .
            str_pad($fecha["mday"], 2, '0', STR_PAD_LEFT) . " " .
            str_pad($fecha["hours"], 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($fecha["minutes"], 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($fecha["seconds"], 2, '0', STR_PAD_LEFT);
        $ip = $this->get_client_ip_env();
        $this->dataBase->insertComentario($idNoticia, $idComentario, $usuario, $correo, $texto, $fecha, $ip);
    }

    public function crearComentario($idNoticia, $usuario, $texto){
        $idComentario = $this->getMaxIdComentario($idNoticia);
        if(!isset($_SESSION["usuarioGest"]) && !isset($_SESSION["editor"])){
            $usuarioData = $this->getUsuarioByUser($usuario);
            $usuario = $usuarioData["usuario"];
            $correo = $usuarioData["email"];
        }else{
            $correo = $this->dataBase->getEditorEmailByLogIn($_SESSION["usuario"])->fetch_assoc()["email"];
            $usuario = $this->dataBase->getEditorNameByLogIn($_SESSION["usuario"])->fetch_assoc()["nombre"];
        }


        $fecha = getDate();
        $fecha = str_pad($fecha["year"], 2, '0', STR_PAD_LEFT) . "-" .
            str_pad($fecha["mon"], 2, '0', STR_PAD_LEFT) . "-" .
            str_pad($fecha["mday"], 2, '0', STR_PAD_LEFT) . " " .
            str_pad($fecha["hours"], 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($fecha["minutes"], 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($fecha["seconds"], 2, '0', STR_PAD_LEFT);
        $ip = $this->get_client_ip_env();
        $this->dataBase->insertComentario($idNoticia, $idComentario, $usuario, $correo, $texto, $fecha, $ip);
    }

    // Modificar comentario
    public function getComentarioByIds($idComentario, $idNoticia){
        $result = $this->dataBase->getResultComentarioByIds($idComentario, $idNoticia);
        return new Comentario($result->fetch_assoc());
    }

    public function modificarComentario($idComentario, $idNoticia, $nombre, $correo, $texto){
        $this->dataBase->modifyComentario($idComentario,$idNoticia, $nombre, $correo, $texto);
    }

    // Eliminar Comentario

    public function eliminarComentario($idComentario, $idNoticia){
        $this->dataBase->deleteComentario($idComentario,$idNoticia);
    }
}