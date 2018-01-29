<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 10/04/2017
 * Time: 5:00
 */
class DataNoticias
{
    private $dataBase;

    public function DataNoticias($dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function getNews()
    {
        $resultNoticias = $this->dataBase->getResultNews();
        return $this->buildNoticias($resultNoticias);
    }

    public function modificarEstadoNoticia($idNoticia, $estado){
        $this->dataBase->modifyEstadoNoticia($idNoticia, $estado);
    }

    // Coger todas las noticias publicadas ordenadas por su orden y asignarles el orden a las 10 primeras, el resto es 0
    public function getNewsPublicadas(){
        $resultNoticias = $this->dataBase->getResultNewsPublicadas();
        $noticias = $this->buildNoticias($resultNoticias);

        // Reasignar orden
        for( $i = 0; $i < count($noticias) && $i < 10; $i++){
            $this->dataBase->changeOrdenNoticia($noticias[$i]->getId(), 10-$i);
        }
        if( count($noticias) > 10 ){
            for( $i = 10; $i < count($noticias); $i++){
                $this->dataBase->changeOrdenNoticia($noticias[$i]->getId(), 0);
            }
        }

        return $noticias;
    }


    // Coger noticias para la portada

    public function get10News(){
        $resultNoticias = $this->dataBase->getResultNewsPublicadas();
        $noticiasRequeridas = array();
        $cantidad = 0;
        while (($row = $resultNoticias->fetch_assoc()) && $cantidad < 10) {

            // Coger sección principal
            $seccion = $this->dataBase->getResultSecById($row["id-noticia"]);
            $row["seccion"] = $seccion->fetch_assoc()["nombre"];

            // Cogemos los comentarios
            $comentarios = (new DataComment($this->dataBase))->getComments($row["id-noticia"]);
            $row["lista-comentarios"] = $comentarios;

            // Cogemos las noticias relacionadas
            $row["lista-rel"] = $this->getNewsRel($row["id-noticia"]);

            // Cogemos todas las imágenes asociadas a la noticia, podría hacer un dataImagenes para esto
            $lista_imagenes = $this->dataBase->getResultImg($row["id-noticia"]);
            $row["lista-img"] = array();
            while ($img = $lista_imagenes->fetch_assoc()) {
                array_push($row["lista-img"], new Imagen($img));
            }

            $row["img-principal"] = $row["lista-img"][0];
            unset($row["lista-img"][0]);

            // Cogemos todos los tags asociados a la noticia
            $lista_tags = $this->dataBase->getResultTags($row["id-noticia"]);
            $row["lista-tags"] = array();
            while ($tag = $lista_tags->fetch_assoc()) {
                array_push($row["lista-tags"], $tag["tag"]);
            }
            array_push($noticiasRequeridas, new Noticia($row));
            $cantidad = $cantidad + 1;
        }
        return $noticiasRequeridas;
    }

    public function getNewById($id)
    {
        $resultNoticias = $this->dataBase->getResultNewById($id);
        return $this->buildNoticias($resultNoticias);
    }

    public function getNewsBySec($seccion)
    {
        $resultNoticias = $this->dataBase->getResultNewsBySec($seccion);
        $result = $this->buildNoticias($resultNoticias);
        return $result;
    }

    public function getNewsBySecPublicadas($seccion)
    {
        $resultNoticias = $this->dataBase->getResultNewsBySecPublicadas($seccion);
        $result = $this->buildNoticias($resultNoticias);
        return $result;
    }

    public function getNewsByTit($titular)
    {
        $result = $this->dataBase->getResultNewsByTit($titular);
        return $this->buildNoticias($result);
    }

    public function getNewsByEditor($editor){
        $resultNoticias = $this->dataBase->getResultNewsByEditor($editor);
        $result = $this->buildNoticias($resultNoticias);
        return $result;
    }

    public function getNewsBySecByEditor($editor, $seccion){
        $resultNoticias = $this->dataBase->getResultNewsBySecByEditor($editor, $seccion);
        $result = $this->buildNoticias($resultNoticias);
        return $result;
    }

    public function getNewsRel($id)
    {
        $resultNoticias = $this->dataBase->getResultNewsRel($id);
        return $this->buildNoticiasRel($resultNoticias);
    }

    private function buildNoticias($resultNoticias)
    {
        $noticiasRequeridas = array();

        while ($row = $resultNoticias->fetch_assoc()) {

            // Coger sección principal
            $seccion = $this->dataBase->getResultSecById($row["id-noticia"]);
            $row["seccion"] = $seccion->fetch_assoc()["nombre"];

            // Cogemos los comentarios
            $comentarios = (new DataComment($this->dataBase))->getComments($row["id-noticia"]);
            $row["lista-comentarios"] = $comentarios;

            // Cogemos las noticias relacionadas
            $row["lista-rel"] = $this->getNewsRel($row["id-noticia"]);

            // Cogemos todas las imágenes asociadas a la noticia, podría hacer un dataImagenes para esto
            $lista_imagenes = $this->dataBase->getResultImg($row["id-noticia"]);
            $row["lista-img"] = array();
            while ($img = $lista_imagenes->fetch_assoc()) {
                array_push($row["lista-img"], new Imagen($img));
            }

            $row["img-principal"] = $row["lista-img"][0];
            unset($row["lista-img"][0]);

            // Cogemos todos los tags asociados a la noticia
            $lista_tags = $this->dataBase->getResultTags($row["id-noticia"]);
            $row["lista-tags"] = array();
            while ($tag = $lista_tags->fetch_assoc()) {
                array_push($row["lista-tags"], $tag["tag"]);
            }
            array_push($noticiasRequeridas, new Noticia($row));
        }
        return $noticiasRequeridas;
    }

    private function buildNoticiasRel($resultNoticiasRel)
    {
        // Para las noticias relacionadas solo necesitamos su imagen principal y sus atributos básicos de noticia.
        $noticiasRequeridas = array();

        while ($row = $resultNoticiasRel->fetch_assoc()) {
            // Coger sección principal
            $seccion = $this->dataBase->getResultSecById($row["id-noticia"]);
            $row["seccion"] = $seccion->fetch_assoc()["nombre"];

            // Cogemos todas las imágenes asociadas a la noticia
            $lista_imagenes = $this->dataBase->getResultImg($row["id-noticia"]);
            $row["lista-img"] = array();
            while ($img = $lista_imagenes->fetch_assoc()) {
                array_push($row["lista-img"], new Imagen($img));
            }
            $row["img-principal"] = $row["lista-img"][0];
            unset($row["lista-img"]);
            array_push($noticiasRequeridas, new Noticia($row));
        }
        return $noticiasRequeridas;
    }

    public function getNextId()
    {
        $id = $this->dataBase->getMaxId()->fetch_assoc()["id"] + 1;
        return $id;
    }

    public function getIdTag( $tag )
    {
        $id = $this->dataBase->getIdTag( $tag )->fetch_assoc()["id-tag"];
        return $id;
    }

    public function getEditor(){
        $editor = $this->dataBase->getEditorNameByLogin($_SESSION["usuarioGest"])->fetch_assoc()["nombre"];
        return $editor;
    }

    public function getIdSeccion($seccion){
        $id_seccion = $this->dataBase->getResultIdSeccion($seccion)->fetch_assoc()["id-subseccion"];
        return $id_seccion;
    }

    public function crearImagen($idimg, $idnot, $url, $texto, $autor, $fecha){

    }

    public function crearNoticia($titular, $resumen, $texto, $autor, $seccion,
                                 $tag1, $tag2, $imagen, $imgDesc, $imgAutor, $imgFecha, $video)
    {

        $id = $this->getNextId();
        $fecha = getDate();
        $publicacion = str_pad($fecha["year"], 2, '0', STR_PAD_LEFT) . "-" .
            str_pad($fecha["mon"], 2, '0', STR_PAD_LEFT) . "-" .
            str_pad($fecha["mday"], 2, '0', STR_PAD_LEFT) . " " .
            str_pad($fecha["hours"], 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($fecha["minutes"], 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($fecha["seconds"], 2, '0', STR_PAD_LEFT);
        $modificacion = $publicacion;
        $visitas = 0;
        $orden = 0;
        $estado = 3;
        $editor = $this->getEditor();

        // Incluir imagen
        //tags
        $id_tag = $this->getIdTag($tag1);
        $id_tag2 = $this->getIdTag($tag2);

        $idSeccion = $this->getIdSeccion($seccion);

        $this->dataBase->insertNoticia($id, $titular, $resumen, $texto, $autor, $publicacion, $modificacion, $visitas, $video, $estado, $orden);
        $this->dataBase->insertImagenNoticia(1, $id, $imagen, $imgDesc, $imgAutor, $imgFecha);
        $this->dataBase->insertEditorNoticia($id,$editor);
        $this->dataBase->insertNoticiaTag($id,$id_tag);
        if($tag1 != $tag2){
            $this->dataBase->insertNoticiaTag($id,$id_tag2);
        }
        $this->dataBase->insertSubseccionNoticia($id, $idSeccion);
    }

    // Eliminar Noticia

    public function eliminarNoticia($idNoticia){
        $this->dataBase->deleteImagenNoticia($idNoticia);
        $this->dataBase->deleteComentariosNoticia($idNoticia);
        $this->dataBase->deleteEditorNoticia($idNoticia);
        $this->dataBase->deleteTagNoticia($idNoticia);
        $this->dataBase->deleteSubseccionNoticia($idNoticia);
        $this->dataBase->deleteNoticia($idNoticia);
    }

    // Modificar Noticia

    public function modificarNoticia($idNoticia,$titular, $resumen, $texto, $autor, $seccion,
                                     $tag1, $tag2, $imagen, $imgDesc, $imgAutor, $imgFecha, $video, $estado){
        // Calcular campos necesarios para la modificación de la noticia
        $fecha = getDate();
        $modificacion = str_pad($fecha["year"], 2, '0', STR_PAD_LEFT) . "-" .
            str_pad($fecha["mon"], 2, '0', STR_PAD_LEFT) . "-" .
            str_pad($fecha["mday"], 2, '0', STR_PAD_LEFT) . " " .
            str_pad($fecha["hours"], 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($fecha["minutes"], 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($fecha["seconds"], 2, '0', STR_PAD_LEFT);
        $this->dataBase->modifyNoticia($idNoticia, $titular, $resumen, $texto, $autor,$modificacion, $video);
        if(isset($estado)){
            $this->dataBase->modifyEstadoNoticia($idNoticia, $estado);
        }

        $idSeccionNew = $this->getIdSeccion($seccion);
        $noticiaActual = $this->getNewById($idNoticia)[0];
        $seccionOld = $noticiaActual->getSeccion();
        $idSeccionOld = $this->getIdSeccion($seccionOld);
        $this->dataBase->modifySubseccionNoticia($idNoticia, $idSeccionOld, $idSeccionNew);

        $tags = $noticiaActual->getTags();
        $idTagOld1 = $this->getIdTag($tags[0]);
        $idTagNew1 = $this->getIdTag($tag1);
        $this->dataBase->modifyTagNoticia($idNoticia, $idTagOld1, $idTagNew1);


        if( $tag1 != $tag2 ){
            $idTagOld2 = $this->getIdTag($tags[1]);
            $idTagNew2 = $this->getIdTag($tag2);
            $this->dataBase->modifyTagNoticia($idNoticia, $idTagOld2, $idTagNew2);
        }
        $this->dataBase->modifyImagen($imagen, $imgDesc, $imgAutor, $imgFecha, $idNoticia);
    }

    // Cambiar noticia de orden por otra
    public function cambiarNoticiaOrden($idNoticia, $nuevoOrden){
        // Obtener el orden de la noticia
        $orden = $this->dataBase->getResultOrdenByIdNoticia($idNoticia)->fetch_assoc()["orden"];
        // Cambiar el orden de la noticia de nuevoOrden
        $this->dataBase->uptadeOrden($nuevoOrden, $orden);
        // cambiar el orden de la noticia idNoticia
        $this->dataBase->changeOrdenNoticia($idNoticia, $nuevoOrden);
    }
}