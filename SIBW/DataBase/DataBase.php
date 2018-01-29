<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 09/04/2017
 * Time: 0:05
 */
class DataBase
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function DataBase($servername, $username, $password, $dbname = "periodico")
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

    }

    public function conection()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $this->conn->set_charset("UTF8");

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function close()
    {
        $this->conn->close();
    }

    public function getConn()
    {
        return $this->conn;
    }

    /******************************************************************************************************************/
    /****************************************** NOTICIA ***************************************************************/
    /******************************************************************************************************************/

    // Todas las noticias ordenadas por el número de visitas
    public function getResultNews()
    {
        return ($this->conn->query("SELECT * FROM noticia ORDER BY estado DESC"));
    }

    public function getResultNewsByEditor( $editor ){
        $sql = $this->conn->prepare("SELECT * FROM noticia WHERE `id-noticia` IN 
                                        (SELECT `id-noticia` FROM `editor-noticia` WHERE editor IN 
                                              (SELECT nombre FROM editor WHERE editor = ?))");
        $sql->bind_param("s", $editor);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    public function getResultNewsPublicadas()
    {
        return ($this->conn->query("SELECT * FROM noticia WHERE estado = 1 ORDER BY orden DESC "));
    }


    // Noticia mediante su ID
    public function getResultNewById($id)
    {

        /* De esta forma, preparando la sentencia para recibir un entero, si se modifica la url y se añade algo después
        del id pasado por get, se ignora. */

        $sql = $this->conn->prepare("SELECT * FROM noticia WHERE `id-noticia` = ?");
        $sql->bind_param("i", $id);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    // Noticias relacionadas con una dado su ID
    public function getResultNewsRel($id)
    {
        $sql = $this->conn->prepare("SELECT * from noticia WHERE `id-noticia` IN
                                    (SELECT `id-noticia` from `noticia-tag` WHERE `id-tag` IN
                                    (SELECT `id-tag` from `noticia-tag` WHERE `id-noticia` = ?)) 
                                      AND `id-noticia` != ?");
        $sql->bind_param("ii", $id, $id);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    // Noticias que coincidan con el titular dado
    public function getResultNewsByTit($titular)
    {
        $titular = '%' . $titular . '%';
        $sql = $this->conn->prepare("SELECT * FROM noticia WHERE titular LIKE ? ORDER BY visitas DESC");
        $sql->bind_param("s", $titular);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    /******************************************************************************************************************/
    /****************************************** SECCION ***************************************************************/
    /******************************************************************************************************************/

    public function getResultSeccionPrinc()
    {
        $sql = $this->conn->prepare("SELECT * FROM seccion ");
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();

        return $result;
    }


    public function getResultSeccionSec($seccion)
    {
        $sql = $this->conn->prepare("SELECT `nombre` FROM subseccion WHERE `id-subseccion` IN
                                    (SELECT `id-subseccion` FROM `sec-subsec` WHERE `id-seccion` IN 
                                    (SELECT `id-seccion` FROM seccion WHERE `nombre`=?))");
        $sql->bind_param("s", $seccion);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function getResultIdSeccion($seccion)
    {
        $sql = $this->conn->prepare("SELECT `id-subseccion` FROM `subseccion` WHERE `nombre` = ?");
        $sql->bind_param("s", $seccion);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    // Devuelve todas las noticias dada una seccion PRINCIPAL O SECUNDARIA
    public function getResultNewsBySec($seccion)
    {
        $sql = $this->conn->prepare("SELECT * FROM noticia WHERE `id-noticia` IN
                                      (SELECT `id-noticia`FROM `noticia-subsec` WHERE `id-subseccion` IN 
                                      ( SELECT `id-subseccion` FROM `sec-subsec` WHERE `id-seccion` IN 
                                      (SELECT `id-seccion` FROM seccion WHERE nombre = ?) UNION 
                                      (SELECT `id-subseccion` FROM subseccion WHERE nombre = ?)))");
        $sql->bind_param("ss", $seccion, $seccion);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function getResultNewsBySecByEditor($editor, $seccion){
        $sql = $this->conn->prepare("SELECT * FROM noticia WHERE `id-noticia` IN
                                      (SELECT `id-noticia`FROM `noticia-subsec` WHERE `id-subseccion` IN 
                                      ( SELECT `id-subseccion` FROM `sec-subsec` WHERE `id-seccion` IN 
                                      (SELECT `id-seccion` FROM seccion WHERE nombre = ?) UNION 
                                      (SELECT `id-subseccion` FROM subseccion WHERE nombre = ?)))
                                      AND `id-noticia`
                                      IN 
                                        (SELECT `id-noticia` FROM `editor-noticia` WHERE editor IN 
                                              (SELECT nombre FROM editor WHERE editor = ?))");
        $sql->bind_param("sss", $seccion, $seccion, $editor);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function getResultNewsBySecPublicadas($seccion)
    {
        $sql = $this->conn->prepare("SELECT * FROM noticia WHERE estado = 1 AND `id-noticia` IN
                                      (SELECT `id-noticia`FROM `noticia-subsec` WHERE `id-subseccion` IN 
                                      ( SELECT `id-subseccion` FROM `sec-subsec` WHERE `id-seccion` IN 
                                      (SELECT `id-seccion` FROM seccion WHERE nombre = ?) UNION 
                                      (SELECT `id-subseccion` FROM subseccion WHERE nombre = ?)))");
        $sql->bind_param("ss", $seccion, $seccion);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function getResultSecById($id_noticia)
    {
        // Aquí se decide si el atributo seccion del objeto noticia (titulo rojo) es la sección principal o la subsección.
        // Ahora mismo es la sección secundaria.
        $sql = $this->conn->prepare("SELECT `nombre` FROM subseccion WHERE `id-subseccion` IN 
                                    (SELECT `id-subseccion` FROM `noticia-subsec` WHERE `id-noticia`=?);");
        $sql->bind_param("i", $id_noticia);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    /******************************************************************************************************************/
    /****************************************** OTHERS ****************************************************************/
    /******************************************************************************************************************/

    // Obtiene todas las imágenes asociadas a una noticia mediante el id de noticia
    public function getResultImg($id)
    {
        $sql = $this->conn->prepare("SELECT * FROM imagen WHERE `id-noticia` = ?");
        $sql->bind_param("i", $id);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    // Obtiene todos los tags de una noticia mediante su id
    public function getResultTags($id)
    {
        $sql = $this->conn->prepare("SELECT tag FROM tags WHERE `id-tag` IN 
                                      (SELECT `id-tag` FROM `noticia-tag` WHERE `id-noticia` = ?);");
        $sql->bind_param("i", $id);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    // Obtiene el id de un tag dado su nombre
    public function getResultIdTag($tag)
    {
        $sql = $this->conn->prepare("SELECT `id-tag` FROM tags WHERE tag = ?");
        $sql->bind_param("s", $tag);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    // Obtiene todos los comentarios de una noticia
    public function getResultComments($id_noticia)
    {
        $sql = $this->conn->prepare("SELECT * FROM comentario WHERE `id-noticia` = ?");
        $sql->bind_param("i", $id_noticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    // Obtiene las palabras prohibidas al poner comentarios
    public function getResultFiltro()
    {
        $sql = $this->conn->prepare("SELECT * FROM filtro");
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    /******************************************************************************************************************/
    /****************************************** SESSION ***************************************************************/
    /******************************************************************************************************************/

    public function user($user)
    {
        $sql = $this->conn->prepare("SELECT usuario FROM usuario WHERE usuario = ?");
        $sql->bind_param("s", $user);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function pssw($pssw)
    {
        $sql = $this->conn->prepare("SELECT usuario FROM usuario WHERE contraseña = ?");
        $sql->bind_param("s", $pssw);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function getResultAllUsers()
    {
        $sql = $this->conn->prepare("SELECT * FROM usuario");
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    /******************************************************************************************************************/
    /****************************************** GESTION ***************************************************************/
    /******************************************************************************************************************/

    public function checkEditor($user){
        $sql = $this->conn->prepare("SELECT * FROM editor WHERE `Editor-jefe`= 1 AND editor = ?");
        $sql->bind_param("s", $user);
        $sql->execute();
        $result = $sql->get_result();

        $sql->close();

        return $result;
    }

    public function userGest($userGest)
    {
        $sql = $this->conn->prepare("SELECT * FROM editor WHERE editor = ?");
        $sql->bind_param("s", $userGest);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function psswGest($psswGest)
    {
        $sql = $this->conn->prepare("SELECT * FROM editor WHERE contraseña = ?");
        $sql->bind_param("s", $psswGest);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }
    //****************
    //INSERTAR NOTICIA
    //****************

    public function getMaxId()
    {
        $sql = $this->conn->prepare("SELECT MAX(`id-noticia`) as id FROM noticia");
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    public function getEditorNameByLogIn($login)
    {
        $sql = $this->conn->prepare("SELECT nombre FROM editor WHERE editor = ?");
        $sql->bind_param("s", $login);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    public function getEditorEmailByLogIn($login)
    {
        $sql = $this->conn->prepare("SELECT email FROM editor WHERE editor = ?");
        $sql->bind_param("s", $login);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    public function insertNoticia($idnoticia, $titular, $resumen, $texto, $autor, $publicacion, $modificacion, $visitas,
                                  $video, $estado, $orden)
    {

        $sql = $this->conn->prepare("INSERT INTO `noticia`(`id-noticia`, `titular`, `resumen`, `texto`, `autor`, 
                  `publicacion`, `ultima-modificacion`, `visitas`, `video`, `Estado`, `Orden`) VALUES (?, ?, ?, ?, ?, 
                  ?, ?, ?, ?, ?, ?)");

        $sql->bind_param("issssssisii", $idnoticia, $titular, $resumen, $texto, $autor, $publicacion, $modificacion,
            $visitas, $video, $estado, $orden);

        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function insertImagenNoticia($idimagen, $idnoticia, $url, $texto, $autor, $fecha)
    {
        $sql = $this->conn->prepare("INSERT INTO `imagen` (`id-imagen`, `id-noticia`, `url`, `texto`, `autor`, `fecha`) 
                                      VALUES (?, ?, ?, ?, ?, ?)");
        echo "SE METE";
        $sql->bind_param("iissss", $idimagen, $idnoticia, $url, $texto, $autor, $fecha);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();
        echo "..";
        return $result;

    }

    public function getIdTag($tag)
    {
        $sql = $this->conn->prepare("SELECT `id-tag` FROM tags WHERE tag = ?");
        $sql->bind_param("s", $tag);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;

    }

    public function getAllTags()
    {
        $sql = $this->conn->prepare("SELECT tag FROM tags");
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    public function insertEditorNoticia($idnoticia, $editor)
    {
        $sql = $this->conn->prepare("INSERT INTO `editor-noticia` (`id-noticia`, `editor`) VALUES (?, ?)");
        $sql->bind_param("is", $idnoticia, $editor);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function insertNoticiaTag($idnoticia, $idtag)
    {
        $sql = $this->conn->prepare("INSERT INTO `noticia-tag` (`id-noticia`, `id-tag`) VALUES (?, ?)");
        $sql->bind_param("ii", $idnoticia, $idtag);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function insertSubseccionNoticia($idnoticia, $idsubseccion)
    {
        $sql = $this->conn->prepare("INSERT INTO `noticia-subsec` (`id-noticia`, `id-subseccion`) VALUES (?, ?);");
        $sql->bind_param("ii", $idnoticia, $idsubseccion);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }
    //****************
    //ELIMINAR NOTICIA
    //****************
    public function deleteImagenNoticia($idnoticia)
    {
        $sql = $this->conn->prepare("DELETE FROM imagen WHERE `id-noticia`=?");
        $sql->bind_param("i", $idnoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function deleteComentariosNoticia($idnoticia)
    {
        $sql = $this->conn->prepare("DELETE FROM comentario WHERE `id-noticia`=?");
        $sql->bind_param("i", $idnoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function deleteEditorNoticia($idnoticia)
    {
        $sql = $this->conn->prepare("DELETE FROM `editor-noticia` WHERE `id-noticia`=?");
        $sql->bind_param("i", $idnoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function deleteTagNoticia($idnoticia)
    {
        $sql = $this->conn->prepare("DELETE FROM `noticia-tag` WHERE `id-noticia`=?");
        $sql->bind_param("i", $idnoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function deleteSubseccionNoticia($idnoticia)
    {
        $sql = $this->conn->prepare("DELETE FROM `noticia-subsec` WHERE `id-noticia`=?");
        $sql->bind_param("i", $idnoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function deleteNoticia($idnoticia)
    {
        $sql = $this->conn->prepare("DELETE FROM noticia WHERE `id-noticia`=?");
        $sql->bind_param("i", $idnoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    //*****************
    //MODIFICAR NOTICIA
    //*****************

    public function modifyNoticia($idnoticia, $titular, $resumen, $texto, $autor, $modificacion, $video)
    {
        $sql = $this->conn->prepare("UPDATE noticia SET `titular`=?,`resumen`=?,`texto`=?,`autor`=?,`ultima-modificacion`=?,`video`=? WHERE `id-noticia`=?");
        $sql->bind_param("ssssssi", $titular, $resumen, $texto, $autor, $modificacion, $video, $idnoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function modifyEstadoNoticia($idnoticia, $estado)
    {
        $sql = $this->conn->prepare("UPDATE `noticia` SET `estado`=? WHERE `id-noticia`=?");
        $sql->bind_param("ii", $estado, $idnoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function modifySubseccionNoticia($idnoticia, $idseccionold, $idseccionnew)
    {
        $sql = $this->conn->prepare("UPDATE `noticia-subsec` SET `id-subseccion`=? WHERE `id-noticia`=? AND `id-subseccion`=?;");
        $sql->bind_param("iii", $idseccionnew, $idnoticia, $idseccionold);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function modifyTagNoticia($idnoticia, $idtagold, $idtagnew)
    {
        $sql = $this->conn->prepare("UPDATE `noticia-tag` SET `id-tag`=? WHERE `id-noticia`=? AND `id-tag`=?");
        $sql->bind_param("iii", $idtagnew, $idnoticia, $idtagold);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function modifyImagen($url, $texto, $autor, $fecha, $idNoticia)
    {
        $sql = $this->conn->prepare("UPDATE imagen SET `url`=?,`texto`=?,`autor`=?,`fecha`=?
                                     WHERE `id-noticia`=?");
        $sql->bind_param("ssssi", $url, $texto, $autor, $fecha, $idNoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    //*******************
    //INSERTAR COMENTARIO
    //*******************

    public function getResultUsuarioByUser($user)
    {
        $sql = $this->conn->prepare("SELECT * FROM usuario WHERE usuario = ?");
        $sql->bind_param("s", $user);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    public function getResultMaxIdComentario($idNoticia)
    {
        $sql = $this->conn->prepare("SELECT MAX(`id-comentario`) as idComentario FROM comentario WHERE `id-noticia` = ?");
        $sql->bind_param("i", $idNoticia);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    public function insertComentario($idNoticia, $idComentario, $usuario, $correo, $texto, $fecha, $ip)
    {
        $sql = $this->conn->prepare("INSERT INTO comentario (`id-noticia`, `id-comentario`, usuario, correo, texto, fecha, `ip`) 
                                    VALUES (?,?,?,?,?,?,?)");

        $sql->bind_param("iisssss", $idNoticia, $idComentario, $usuario, $correo, $texto, $fecha, $ip);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    //*********************
    //Modificar COMENTARIO*
    //*********************

    public function getResultComentarioByIds($idComentario, $idNoticia)
    {
        $sql = $this->conn->prepare("SELECT * FROM comentario WHERE `id-comentario` = ? AND `id-noticia` = ?");

        $sql->bind_param("ii", $idComentario, $idNoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function modifyComentario($idComentario, $idNoticia, $nombre, $correo, $texto)
    {
        $sql = $this->conn->prepare("UPDATE comentario SET `usuario`=?,`correo`=?, `texto`=?
                                     WHERE `id-comentario` = ? AND `id-noticia`= ?");
        $sql->bind_param("sssii", $nombre, $correo, $texto, $idComentario, $idNoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    //*********************
    //Eliminar COMENTARIO**
    //*********************

    public function getResultAllComments()
    {
        $sql = $this->conn->prepare("SELECT * FROM comentario");
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function deleteComentario($idComentario, $idNoticia)
    {
        $sql = $this->conn->prepare("DELETE FROM comentario WHERE `id-comentario` = ? AND `id-noticia` = ?");
        $sql->bind_param("ii", $idComentario, $idNoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    /******************************************************************************************************************/
    /****************************************** SECCIONES *************************************************************/
    /******************************************************************************************************************/
    public function getResultMaxIdSeccionP()
    {
        $sql = $this->conn->prepare("SELECT MAX(`id-seccion`) as `id-seccionP` FROM seccion");
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }


    public function getResultMaxIdSeccionS()
    {
        $sql = $this->conn->prepare("SELECT MAX(`id-subseccion`) as `id-seccionS` FROM subseccion");
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    public function insertSubseccion($idsubseccion, $nombre)
    {
        $prueba = $this->conn->prepare("SELECT * FROM subseccion WHERE nombre = ?");
        $prueba->bind_param("s",$nombre);
        $prueba->execute();
        $result = $prueba->get_result();
        $prueba->close();

        if( !$result->fetch_assoc() > 0){
            $sql = $this->conn->prepare("INSERT INTO subseccion (`id-subseccion`, `nombre`) VALUES (?, ?);");
            $sql->bind_param("is", $idsubseccion, $nombre);
            $sql->execute();

            $result = $sql->get_result();
            $sql->close();
        }

    }

    public function getResultIdSeccionP( $seccion ){
        $sql = $this->conn->prepare("SELECT `id-seccion` FROM seccion WHERE nombre = ?");
        $sql->bind_param("s", $seccion);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function getResultIdSeccionS( $subseccion ){
        $sql = $this->conn->prepare("SELECT `id-subseccion` FROM subseccion WHERE nombre = ?");
        $sql->bind_param("s", $subseccion);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function insertSecSubsec($idseccion, $idsubseccion)
    {
        $sql = $this->conn->prepare("INSERT INTO `sec-subsec` (`id-seccion`, `id-subseccion`) VALUES (?, ?)");
        $sql->bind_param("ii", $idseccion, $idsubseccion);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function modifySubseccion($nombreNew, $nombreOld)
    {
        $sql = $this->conn->prepare("UPDATE subseccion SET `nombre`=? WHERE `nombre`=?");
        $sql->bind_param("ss", $nombreNew, $nombreOld);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function modifySecSubsec($idSeccion,$idSubSeccion){
        $sql = $this->conn->prepare("UPDATE `sec-subsec` SET `id-seccion`=? WHERE `id-subseccion`=?");
        $sql->bind_param("ii", $idSeccion, $idSubSeccion);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function insertSeccion($idseccion, $nombre)
    {
        $prueba = $this->conn->prepare("SELECT * FROM seccion WHERE nombre = ?");
        $prueba->bind_param("s",$nombre);
        $prueba->execute();
        $result = $prueba->get_result();
        $prueba->close();

        if( !$result->fetch_assoc() > 0 ){
            $sql = $this->conn->prepare("INSERT INTO seccion (`id-seccion`, `nombre`) VALUES (?, ?)");
            $sql->bind_param("is",  $idseccion, $nombre);
            $sql->execute();

            $result = $sql->get_result();
            $sql->close();
        }

    }

    public function modifySeccion($nombreNew, $nombreOld)
    {
        $sql = $this->conn->prepare("UPDATE seccion SET `nombre`=? WHERE `nombre`=?");
        $sql->bind_param("ss", $nombreNew, $nombreOld);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    //*****************
    //ELIMINAR SUBSECCION
    //*****************
    public function deleteNoticiaSubsec($idsubseccion){
        $sql = $this->conn->prepare("UPDATE `noticia-subsec` SET `id-subseccion` = 0 WHERE `id-subseccion`=?");
        $sql->bind_param("i", $idsubseccion);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function deleteSecSubsec($idsubseccion){
        $sql = $this->conn->prepare("DELETE FROM `sec-subsec` WHERE `id-subseccion`=?");
        $sql->bind_param("i", $idsubseccion);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function deleteSubsecion($idsubseccion){
        $sql = $this->conn->prepare("DELETE FROM subseccion WHERE `id-subseccion`=?");
        $sql->bind_param("i", $idsubseccion);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    //*****************
    //ELIMINAR SECCION
    //*****************

    //Devuelve todas las subsecciones asociadas a la seccion dada, para eliminarlas una a una con las funciones de la
    //seccion anterior.
    public function getResultIdSubsecionSec($idseccion){
        $sql = $this->conn->prepare("SELECT `id-subseccion` FROM `sec-subsec` WHERE `id-seccion`=?");
        $sql->bind_param("i", $idseccion);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    //Eliminar seccion
    public function deleteSeccion($idseccion){
        $sql = $this->conn->prepare("DELETE FROM seccion WHERE `id-seccion`=?");
        $sql->bind_param("i", $idseccion);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    //*****************
    //PUBLICIDAD ******
    //*****************

    public function getResultAllAnuncios(){
        $sql = $this->conn->prepare("SELECT * FROM anuncio");
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    public function incVisitasAnuncio($idAnuncio){
        $sql = $this->conn->prepare("UPDATE anuncio SET visitas = visitas + 1 WHERE `id-anuncio`=?");
        $sql->bind_param("i", $idAnuncio);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function getResultMaxIdAnuncios(){
        $sql = $this->conn->prepare("SELECT MAX(`id-anuncio`) as `id-anuncio` FROM anuncio");
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    public function getResultAnuncioById($idAnuncio){
        $sql = $this->conn->prepare("SELECT * FROM anuncio WHERE `id-anuncio` = ?");
        $sql->bind_param("i", $idAnuncio);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        return $result;
    }

    public function insertAnuncio($idAnuncio, $texto, $imagen){
        $sql = $this->conn->prepare("INSERT INTO anuncio (`id-anuncio`, `texto`, `imagen`, `visitas`) VALUES (?, ?, ?,0)");
        $sql->bind_param("iss",  $idAnuncio, $texto, $imagen);
        $sql->execute();
        $sql->close();
    }

    public function modifyAnuncio( $idAnuncio, $texto, $imagen ){
        $sql = $this->conn->prepare("UPDATE anuncio SET texto = ?, imagen = ? WHERE `id-anuncio`= ?");
        $sql->bind_param("ssi", $texto, $imagen, $idAnuncio);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    public function deleteAnuncio($idAnuncio){
        $sql = $this->conn->prepare("DELETE FROM anuncio WHERE `id-anuncio`=?");
        $sql->bind_param("i", $idAnuncio);
        $sql->execute();
        $sql->close();
    }

    /*****************/
    /* CAMBIAR ORDEN */
    /*****************/
    // cambiar orden de una noticia
    public function changeOrdenNoticia($idNoticia, $ordenNuevo){
        $sql = $this->conn->prepare("UPDATE noticia SET orden = ? WHERE `id-noticia`= ?");
        $sql->bind_param("ii", $ordenNuevo, $idNoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    // obtener orden de una noticia
    public function getResultOrdenByIdNoticia($idNoticia){
        $sql = $this->conn->prepare("SELECT orden FROM noticia WHERE `id-noticia`= ?");
        $sql->bind_param("i", $idNoticia);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }

    // actualizar orden (como solo hay uno distinto no pasa nada)
    public function uptadeOrden($ordenAntiguo, $ordenNuevo){
        $sql = $this->conn->prepare("UPDATE noticia SET orden = ? WHERE `orden`= ?");
        $sql->bind_param("ii", $ordenNuevo, $ordenAntiguo);
        $sql->execute();

        $result = $sql->get_result();
        $sql->close();

        return $result;
    }
}