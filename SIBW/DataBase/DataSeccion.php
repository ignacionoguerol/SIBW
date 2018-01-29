<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 13/04/2017
 * Time: 21:28
 */
class DataSeccion
{
    private $dataBase;

    public function DataSeccion($dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function getSeccionesPrinc()
    {
        $result = $this->dataBase->getResultSeccionPrinc();
        $secciones = array();
        while ($row = $result->fetch_assoc()) {
            array_push($secciones, $row["nombre"]);
        }
        return $secciones;
    }

    public function getSeccionesSec($seccion)
    {
        $result = $this->dataBase->getResultSeccionSec($seccion);
        $secciones = array();
        while ($row = $result->fetch_assoc()) {
            array_push($secciones, $row["nombre"]);
        }
        return $secciones;
    }

    public function getSecciones()
    {
        $seccP = $this->getSeccionesPrinc();
        $secciones = array();
        for ($i = 0; $i < count($seccP); $i++) {
            $nombre = $seccP[$i];
            $seccS = $this->getSeccionesSec($nombre);

            array_push($secciones, new Seccion($nombre, $seccS));
        }
        return $secciones;
    }

    public function getIdSeccionP($seccion){
        $result = $this->dataBase->getResultIdSeccionP($seccion);
        return $result->fetch_assoc()["id-seccion"];
    }

    public function getIdSeccionS($subseccion){
        $result = $this->dataBase->getResultIdSeccionS($subseccion);
        return $result->fetch_assoc()["id-subseccion"];
    }

    public function getMaxIdSeccionP(){
        $result = $this->dataBase->getResultMaxIdSeccionP();
        return $result->fetch_assoc()["id-seccionP"]+1;
    }

    public function getMaxIdSeccionS(){
        $result = $this->dataBase->getResultMaxIdSeccionS();
        return $result->fetch_assoc()["id-seccionS"]+1;
    }

    public function crearSeccion($nombre, $seccionPrincipal){
        // Crear seccion Secundaria
        if( isset($seccionPrincipal )){
            $idsubseccion = $this->getMaxIdSeccionS();
            $idseccion = $this->getIdSeccionP($seccionPrincipal);
            $this->dataBase->insertSubseccion($idsubseccion, $nombre);
            $this->dataBase->insertSecSubsec($idseccion, $idsubseccion);
        }else{ // Crear sección principal
            $idseccion = $this->getMaxIdSeccionP();
            $this->dataBase->insertSeccion($idseccion, $nombre);
        }
    }

    public function modificarSeccion($seccion, $nombre, $seccionPrincipal){
        if( isset($seccionPrincipal )){
            $this->dataBase->modifySubseccion($nombre, $seccion);
            $idSeccion = $this->getIdSeccionP($seccionPrincipal);
            $idSubSeccion = $this->getIdSeccionS($nombre);
            $this->dataBase->modifySecSubsec($idSeccion, $idSubSeccion);
        }else{
            $this->dataBase->modifySeccion($nombre, $seccion);
        }
    }

    public function deleteSubSeccion($idsubseccion){
        $this->dataBase->deleteNoticiaSubsec($idsubseccion);
        $this->dataBase->deleteSecSubsec($idsubseccion);
        $this->dataBase->deleteSubsecion($idsubseccion);
    }

    public function getIdSubsecciones($idseccion){
        $result = $this->dataBase->getResultIdSubsecionSec($idseccion);
        $idSubsecciones = array();
        while( $row = $result->fetch_assoc()){
            array_push($idSubsecciones, $row["id-subseccion"]);
        }
        return $idSubsecciones;
    }

    public function deleteSubsecciones($idseccion){
        $idSubsecciones = $this->getIdSubsecciones($idseccion);
        foreach ($idSubsecciones as $idSubseccion){
            $this->deleteSubSeccion($idSubseccion);
        }
    }



    public function deleteSeccion($seccion, $tipo){
        if($tipo == "principal"){
            $idseccion = $this->getIdSeccionP($seccion);
            $this->deleteSubsecciones($idseccion);
            $this->dataBase->deleteSeccion($idseccion);
        }else{
            $idsubseccion = $this->getIdSeccionS($seccion);
            $this->deleteSubSeccion($idsubseccion);
        }
    }
}