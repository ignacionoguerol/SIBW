<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 15/05/2017
 * Time: 22:16
 */
class DataAnuncio
{
    private $dataBase;

    public function DataAnuncio($dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function incVisitas($idAnuncio){
        $this->dataBase->incVisitasAnuncio($idAnuncio);
    }

    public function getAllAnuncios(){
        $result = $this->dataBase->getResultAllAnuncios();

        $anuncios = array();

        while ( $anuncio = $result->fetch_assoc() ){
            array_push($anuncios, new Anuncio($anuncio));
        }

        return $anuncios;
    }

    public function getAnuncioById($idAnuncio){
        $result = $this->dataBase->getResultAnuncioById($idAnuncio);
        return new Anuncio($result->fetch_assoc());
    }

    public function getMaxId(){
        $result = $this->dataBase->getResultMaxIdAnuncios();
        return $result->fetch_assoc()["id-anuncio"] + 1;
    }

    public function crearAnuncio($texto, $imagen){
        $idAnuncio = $this->getMaxId();
        $this->dataBase->insertAnuncio($idAnuncio,$texto, $imagen);
    }

    public function modificarAnuncio($idAnuncio, $texto, $imagen){
        $this->dataBase->modifyAnuncio($idAnuncio, $texto, $imagen);
    }

    public function eliminarAnuncio($idAnuncio){
        $this->dataBase->deleteAnuncio($idAnuncio);
    }
}