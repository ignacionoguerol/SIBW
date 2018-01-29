<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 16/04/2017
 * Time: 19:50
 */
class Controller
{
    private $includes;
    private $dataBase;
    private $dataN;
    private $dataC;
    private $dataS;
    private $dataU;
    private $dataA;

    private $liveSearch;

    private $user;
    private $pssw;
    private $host;
    private $data_base_name;

    private $accion;
    private $modo;
    private $modo_anterior;
    private $id;
    private $seccion;
    private $seccion_pri_activa;
    private $seccion_sec_activa;
    private $dataT;
    private $search;

    private $searching;

    private $view;

    public function Controller($host, $user, $pssw, $data_base_name = "periodicoFinish")
    {
        $this->includes = new IncludeFiles();

        /* Datos de conexión a la base de datos */
        $this->host = $host;
        $this->user = $user;
        $this->pssw = $pssw;
        $this->data_base_name = $data_base_name;

        /* Recogida de datos a través de url */
        $this->accion = isset($_GET["accion"]) ? $_GET["accion"] : null;
        $this->modo = isset($_GET["modo"]) ? $_GET["modo"] : "portada";
        $this->id = isset($_GET["id"]) ? $_GET["id"] : null;
        $this->seccion = isset($_GET["seccion"]) ? $_GET["seccion"] : null;
        $this->modo_anterior = isset($_GET["modoA"]) ? $_GET["modoA"] : null;
        $this->accion = isset($_GET["accion"]) ? $_GET["accion"] : null;

        $this->seccion_pri_activa = isset($_GET["a"]) && $_GET["a"] != null ? $_GET["a"] : "Inicio";
        $this->seccion_sec_activa = isset($_GET["suba"]) ? $_GET["suba"] : null;
        $this->search = isset($_POST["search"]) ? $_POST["search"] : null;
        $this->searching = isset($_GET["searching"]) ? $_GET["searching"] : null;

    }

    public function init()
    {
        $this->includes->includeAll();

        $this->dataBase = new DataBase($this->host, $this->user, $this->pssw, $this->data_base_name);
        $this->dataBase->conection();

        $this->dataN = new DataNoticias($this->dataBase);
        $this->dataC = new DataComment($this->dataBase);
        $this->dataS = new DataSeccion($this->dataBase);
        $this->dataT = new DataTag($this->dataBase);
        // Secciones se podría haber puesto como un atributo de la clase y ser pasado como argumento a la vista
        $_SESSION["secciones"] = $secciones = $this->dataS->getSecciones();
        $this->dataU = new DataUsuario($this->dataBase);
        $this->dataA = new DataAnuncio($this->dataBase);

        if(isset($_SESSION["editor"])){
            $this->liveSearch = new liveSearch($this->searching, $this->dataN->getNews());
        }else{
            $this->liveSearch = new liveSearch($this->searching, $this->dataN->getNewsPublicadas());
        }



        $this->sendFilterWords();
    }

    public function startSearch(){
        $this->liveSearch->start();
    }

    private function connectDataBase()
    {
        $this->dataBase->conection();
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

    private function includeFiles()
    {
        $this->includes->includeAll();
    }

    public function checkSession2()
    {
        if (isset($_POST["usuario"])) {
            if ($this->dataU->check($_POST["usuario"], md5($_POST["contraseña"]))) {
                $_SESSION["usuario"] = $_POST["usuario"];
            } else {
                $this->modo = "ini_sess";
                $_SESSION["iniFail"] = true;
            }
        }
    }

    public function checkSession()
    {
        if (isset($_POST["usuario"])) {
            if ($this->dataU->check($_POST["usuario"], md5($_POST["contraseña"]))) {
                $_SESSION["usuario"] = $_POST["usuario"];
            } else {
                if ($this->dataU->checkGest($_POST["usuario"], md5($_POST["contraseña"]))) {
                    $_SESSION["usuario"] = $_SESSION["usuarioGest"] = $_POST["usuario"];
                    if ($this->dataU->checkEditor($_POST["usuario"])) {
                        $_SESSION["usuario"] = $_SESSION["editor"] = $_POST["usuario"];
                    }
                } else {
                    ques("ou!");
                    $this->modo = "ini_sess";
                }
            }
        }
    }

    /*public function sendDataJs(){
        $p = $this->seccion_pri_activa;
        $s = $this->seccion_sec_activa;

        echo '<script> active( "<?php echo" '.json_encode( $this->seccion_pri_activa ).'?>,<?php echo'.json_encode($this->seccion_sec_activa).
            '?>)</script>';
    }*/

    public function getSecP()
    {
        return $this->seccion_pri_activa;
    }

    public function getSecS()
    {
        return $this->seccion_sec_activa;
    }

    public function end()
    {
        $this->dataBase->close();
    }

    public function getAccion()
    {
        switch ($this->accion) {
            case "crearComentario":
                $this->dataC->crearComentario($this->id, $_SESSION["usuario"], $_POST["texto"]);
                break;
            case "modificarNoticia":
                $this->dataN->modificarNoticia($_GET["id"], $_POST["titular"], $_POST["resumen"], $_POST["texto"], $_POST["autor"], $_POST["seccion"],
                    $_POST["tag1"], $_POST["tag2"],
                    $_POST["imagenPrincipal"], $_POST["imagenTexto"], $_POST["imagenAutor"],
                    $_POST["imagenFecha"], isset($_POST["video"]) ? $_POST["video"] : null,
                    isset($_POST["estado"]) ? $_POST["estado"] : 3);
                break;
        }
    }

    public function getView()
    {
        switch ($this->modo) {
            case "noticiaExp":
                $this->view = new NoticiaExtView($this->dataN->getNewById($this->id),
                    $this->dataC->getUsuarioByUser(isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : null));
                break;
            case "noticiaImp":
                $this->view = new NoticiaImpView(($this->dataN->getNewById($this->id)));
                break;
            case "modNoticia":
                $this->view = new NoticiaExtModView($this->dataN->getNewById($_GET["idNoticia"]),$this->dataS->getSecciones(), $this->dataT->getAllTags());
                $this->dataN->modificarEstadoNoticia($_GET["idNoticia"],2);

                break;
            case "seccion":
                if ($this->accion == "incAnuncio") {
                    $this->dataA->incVisitas($_GET["idAnuncio"]);
                }
                $this->view = new SeccionView(($this->dataN->getNewsBySecPublicadas($this->seccion)), $this->dataA->getAllAnuncios());
                //echo '<script>showDivs(0)</script>';
                break;
            case "search":
                $noticias_buscadas = $this->dataN->getNewsByTit($this->search);
                if (count($noticias_buscadas) == 0) {
                    $this->view = new NotFoundView();
                } else {
                    $this->view = new PortadaView($noticias_buscadas,$this->dataA->getAllAnuncios());
                }
                break;
            case "ini_sess":
                $this->view = new SessionView();
                break;
            case "clos_sess":
                unset($_SESSION["usuario"]);
                unset($_SESSION["usuarioGest"]);
                unset($_SESSION["editor"]);
                $url = 'location: index.php?modo=' . $_GET["modoA"] . '&a=' . $_GET["a"] . '&suba=' . $_GET["suba"] . '&id=' . $_GET["id"] . '&seccion=' . $_GET["seccion"];
                header($url);
                break;
            default:
                if ($this->accion == "incAnuncio") {
                    $this->dataA->incVisitas($_GET["idAnuncio"]);
                }
                $this->view = new PortadaView($this->dataN->get10News(), $this->dataA->getAllAnuncios());
                break;
        }
    }

    public function viewOut()
    {
        return $this->view->out();
    }
}