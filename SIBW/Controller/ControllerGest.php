<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 12/05/2017
 * Time: 18:11
 */
class ControllerGest
{
    private $includes;
    private $dataBase;
    private $dataN;
    private $dataC;
    private $dataS;
    private $dataT;
    private $dataU;
    private $dataA;

    private $user;
    private $pssw;
    private $host;
    private $data_base_name;

    private $accion;
    private $modo;
    private $menu;

    private $view;

    public function ControllerGest($host, $user, $pssw, $data_base_name = "periodicoFinish")
    {
        $this->includes = new IncludeFilesGest();
        /* Datos de conexión a la base de datos */
        $this->host = $host;
        $this->user = $user;
        $this->pssw = $pssw;
        $this->data_base_name = $data_base_name;

        /* Recogida de datos a través de url */
        $this->accion = isset($_GET["accion"]) ? $_GET["accion"] : null;
        $this->modo = isset($_GET["modo"]) ? $_GET["modo"] : "gestNoticias";
        $this->menu = isset($_GET["active"]) ? $_GET["active"] : "Noticias";

    }

    public function init()
    {
        session_start();
        $this->includes->includeAll();

        $this->dataBase = new DataBase($this->host, $this->user, $this->pssw, $this->data_base_name);
        $this->dataBase->conection();

        $this->dataN = new DataNoticias($this->dataBase);
        $this->dataS = new DataSeccion($this->dataBase);
        $this->dataT = new DataTag($this->dataBase);
        $this->dataC = new DataComment($this->dataBase);
        $this->dataU = new DataUsuario($this->dataBase);
        $this->dataA = new DataAnuncio($this->dataBase);

        $this->sendFilterWords();
    }

    private function getFilterWords()
    {
        return $this->dataC->getFiltro();
    }

    private function sendFilterWords()
    {
        echo '<div id=data style="display: none">
                ' . json_encode($this->getFilterWords()) . '
              </div>';
    }

    public function checkSession()
    {
        if (!isset($_SESSION["usuarioGest"])) {
            if (isset($_POST["usuario"])) {
                if ($this->dataU->checkGest($_POST["usuario"], md5($_POST["contraseña"]))) {
                    $_SESSION["usuarioGest"] = $_POST["usuario"];
                    if ($this->dataU->checkEditor($_POST["usuario"])) {
                        $_SESSION["editor"] = true;
                    }
                } else {
                    $this->modo = "ini_sess";
                }
            } else {
                $this->modo = "ini_sess";
            }
        }
    }

    public function getMenuActivo()
    {
        return $this->menu;
    }

    public function end()
    {
        $this->dataBase->close();
    }

    public function getAccion()
    {
        switch ($this->accion) {
            case "crearNoticia":
                $this->dataN->crearNoticia($_POST["titular"], $_POST["resumen"], $_POST["texto"], $_POST["autor"], $_POST["seccion"],
                    $_POST["tag1"], $_POST["tag2"],
                    $_POST["imagenPrincipal"], $_POST["imagenTexto"], $_POST["imagenAutor"],
                    $_POST["imagenFecha"], isset($_POST["video"]) ? $_POST["video"] : null);
                break;
            case "modificarNoticia":
                $this->dataN->modificarNoticia($_GET["idNoticia"], $_POST["titular"], $_POST["resumen"], $_POST["texto"], $_POST["autor"], $_POST["seccion"],
                    $_POST["tag1"], $_POST["tag2"],
                    $_POST["imagenPrincipal"], $_POST["imagenTexto"], $_POST["imagenAutor"],
                    $_POST["imagenFecha"], isset($_POST["video"]) ? $_POST["video"] : null,
                    isset($_POST["estado"]) ? $_POST["estado"] : 3);
                break;
            case "eliminarNoticia":
                $this->dataN->eliminarNoticia($_GET["idNoticia"]);
                break;
            case "crearComentario":
                $this->dataC->crearComentarioGest($_GET["idNoticia"], $_POST["usuario"], $_POST["texto"]);
                break;
            case "modificarComentario":
                $this->dataC->modificarComentario($_GET["idComentario"], $_GET["idNoticia"], $_POST["nombre"], $_POST["correo"], $_POST["texto"]);
                break;
            case "eliminarComentario":
                $this->dataC->eliminarComentario($_GET["idComentario"], $_GET["idNoticia"]);
                break;
            case "crearSeccion":
                $this->dataS->crearSeccion($_POST["nombre"], isset($_POST["seccionP"]) ? $_POST["seccionP"] : null);
                break;
            case "modificarSeccion":
                $this->dataS->modificarSeccion($_GET["seccion"], $_POST["nombre"], isset($_POST["seccionP"]) ? $_POST["seccionP"] : null);
                break;
            case "eliminarSeccion":
                $this->dataS->deleteSeccion($_GET["nombre"], $_GET["tipo"]);
                break;
            case "crearAnuncio":
                $this->dataA->crearAnuncio($_POST["texto"], $_POST["imagen"]);
                break;
            case "modificarAnuncio":
                $this->dataA->modificarAnuncio($_GET["idAnuncio"], $_POST["texto"], $_POST["imagen"]);
                break;
            case "eliminarAnuncio":
                $this->dataA->eliminarAnuncio($_GET["idAnuncio"]);
                break;
            case "modificarPortada":
                $this->dataN->cambiarNoticiaOrden($_GET["idNoticia"], $_GET["orden"]);
                break;
            case "modEstado":
                $this->dataN->modificarEstadoNoticia($_GET["idNoticia"], $_GET["estado"]);
                break;
        }
    }

    public function getView()
    {
        switch ($this->modo) {
            case "gestNoticias":
                // Filtro de secciones
                if (isset($_GET["seccionS"]) && $_GET["seccionS"] != "Todas") {
                    if (isset($_SESSION["editor"])) {
                        $seccion = $_GET["seccionS"];
                        $noticia = new GestNoticiasView(($this->dataN->getNewsBySec($seccion)), $this->dataS->getSecciones());
                    } else {
                        $seccion = $_GET["seccionS"];
                        $noticia = new GestNoticiasView(($this->dataN->
                        getNewsBySecByEditor($_SESSION["usuarioGest"], $seccion)), $this->dataS->getSecciones());
                    }
                } else if (isset($_GET["seccionP"]) && $_GET["seccionP"] != "Todas") {
                    if (isset($_SESSION["editor"])) {
                        $seccion = $_GET["seccionP"];
                        $noticia = new GestNoticiasView(($this->dataN->getNewsBySec($seccion)), $this->dataS->getSecciones());
                    } else {
                        $seccion = $_GET["seccionP"];
                        $noticia = new GestNoticiasView(($this->dataN->getNewsBySecByEditor($_SESSION["usuarioGest"], $seccion)), $this->dataS->getSecciones());
                    }
                } else {
                    if (isset($_SESSION["editor"])) {
                        $noticia = new GestNoticiasView($this->dataN->getNews(), $this->dataS->getSecciones());
                    } else {
                        $noticia = new GestNoticiasView($this->dataN->getNewsByEditor($_SESSION["usuarioGest"]), $this->dataS->getSecciones());
                    }
                }
                $noticia->out();
                break;

            case "verNoticia":
                ques("Viendo noticia");
                ques($_GET["idNoticia"]);
                $verNoticia = new verNoticiaView($this->dataN->getNewById($_GET["idNoticia"]));
                $verNoticia->out();
                break;

            case "crearNoticia":
                $crearNoticia = new CrearNoticiaView($this->dataS->getSecciones(), $this->dataT->getAllTags());
                $crearNoticia->out();
                break;
            case "modificarNoticia":

                $modificarNoticia = new ModificarNoticiaView($this->dataN->getNewById($_GET["idNoticia"]), $this->dataS->getSecciones(), $this->dataT->getAllTags());
                $modificarNoticia->out();
                $this->dataN->modificarEstadoNoticia($_GET["idNoticia"],2);
                break;
            case "gestComentariosNoticia":
                if (!isset($_GET["idNoticia"])) {
                    $comentarios = new GestComentariosView(null, $this->dataC->getAllComments());
                } else {
                    $comentarios = new GestComentariosView($this->dataN->getNewById($_GET["idNoticia"]),
                        $this->dataC->getComments($_GET["idNoticia"]));
                }
                $comentarios->out();
                $this->menu = "Comentarios";
                break;
            case "crearComentario":
                $usuarios = $this->dataU->getAllUsers();
                $crearComentario = new CrearComentarioView($usuarios, $_GET["idNoticia"]);
                $crearComentario->out();

                break;
            case "modificarComentario":
                $comentario = $this->dataC->getComentarioByIds($_GET["idComentario"], $_GET["idNoticia"]);
                $modificarComentario = new ModificarComentarioView($comentario);
                $modificarComentario->out();
                $this->menu = "Comentarios";
                break;
            case "gestSecciones":
                $secciones = $this->dataS->getSecciones();
                $gestSecciones = new GestSeccionesView($secciones);
                $gestSecciones->out();
                $this->menu = "Secciones";
                break;
            case "crearSeccion":
                $secciones = $this->dataS->getSecciones();
                $crearSeccion = new CrearSeccionView($secciones);
                $crearSeccion->out();
                $this->menu = "Secciones";
                break;
            case "modificarSeccion":
                $secciones = $this->dataS->getSecciones();
                $crearSeccion = new ModificarSeccionView($_GET["nombre"], $secciones);
                $crearSeccion->out();
                $this->menu = "Secciones";
                break;
            case "gestPublicidad":
                $anuncios = $this->dataA->getAllAnuncios();
                $gestPublicidad = new GestPublicidadView($anuncios);
                $gestPublicidad->out();
                $this->menu = "Publicidad";
                break;
            case "crearAnuncio":
                $crearAnuncio = new CrearAnuncioView();
                $crearAnuncio->out();
                $this->menu = "Publicidad";
                break;
            case "modificarAnuncio":
                $modAnuncio = new ModificarAnuncioView($this->dataA->getAnuncioById($_GET["idAnuncio"]));
                $modAnuncio->out();
                $this->menu = "Publicidad";
                break;

            case "gestPortada":
                // Quiero todas las noticias publicadas por orden
                $gestPortada = new GestPortadaView($this->dataN->getNewsPublicadas());
                $gestPortada->out();
                $this->menu = "Portada";
                break;
            case "ini_sess":
                echo "iniSess";
                $iniView = new GestSessionView();
                $iniView->out();
                break;

            case "close_sess":
                unset($_SESSION["usuarioGest"]);
                unset($_SESSION["editor"]);
                $url = 'location: ../administrator/index.php';
                header($url);
                break;
        }
    }

    public function viewOut()
    {
        return $this->view->out();
    }
}