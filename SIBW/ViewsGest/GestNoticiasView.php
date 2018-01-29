<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 12/05/2017
 * Time: 18:46
 */
class GestNoticiasView
{
    private $cabecera;
    private $menu;
    private $noticias;
    private $secciones;

    public function GestNoticiasView($noticias, $secciones)
    {
        $this->noticias = $noticias;
        $this->secciones = $secciones;
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();
    }

    public function out()
    {
        ?>
        <div class="container">
            <?php
            $this->cabecera->out();
            $this->menu->out();
            //ques($this->secciones);
            ?>
            <div class="content">
                <div class="cabeceraContent">
                    <p>Buscar por Secciones</p>

                    <form id="buscadorSecciones">
                        <select name="secPrincipal" onChange="window.location.href=this.value">
                            <option value="../administrator/index.php?modo=gestNoticias&seccionP=Todas">Todas
                                Principales
                            </option>
                            <?php
                            foreach ($this->secciones as $seccion) {
                                // Si existe una seccion principal seleccionada la ponemos en el select
                                if (isset($_GET["seccionP"]) && $seccion->getName() == $_GET["seccionP"]) {
                                    echo '<option value ="../administrator/index.php?modo=gestNoticias&seccionP=' . $seccion->getName()
                                        . '" selected>' . $seccion->getName() . '</option>';
                                } else {
                                    echo '<option value ="../administrator/index.php?modo=gestNoticias&seccionP=' . $seccion->getName()
                                        . '">' . $seccion->getName() . '</option>';
                                }
                            }
                            ?>
                        </select>

                        <select name="secSecundaria" onChange="window.location.href=this.value">
                            <option value='../administrator/index.php?modo=gestNoticias&seccionP=<?php echo $_GET["seccionP"] ?>&seccionS=Todas'>
                                Todas Secundarias
                            </option>
                            <?php
                            if (isset($_GET["seccionS"]) && "N/A" == $_GET["seccionS"]) {
                                echo '<option value ="../administrator/index.php?modo=gestNoticias&seccionP=Todas&seccionS=N/A" selected>N/A</option>';
                            } else {
                                echo '<option value ="../administrator/index.php?modo=gestNoticias&seccionP=Todas&seccionS=N/A">N/A</option>';
                            }
                            ?>
                            <?php
                            foreach ($this->secciones as $seccion) {
                                $subSecciones = $seccion->getSubSecciones();
                                // Si existe una seccion Principal seleccionada solo mostramos sus secundarias asociadas
                                // Si la seccion Principal son todas, se muestran todas las secundarias
                                if (isset($_GET["seccionP"]) && $_GET["seccionP"] == $seccion->getName() || $_GET["seccionP"] == "Todas" || !$_GET["seccionP"]) {
                                    foreach ($subSecciones as $subSeccion) {
                                        // Si existe una seccion secundaria seleccionada la ponemos en el select
                                        if (isset($_GET["seccionS"]) && $subSeccion == $_GET["seccionS"]) {
                                            echo '<option value ="../administrator/index.php?modo=gestNoticias&seccionS=' .
                                                $subSeccion . '&seccionP=' . $_GET["seccionP"] . '" selected>' . $subSeccion . '</option>';
                                        } else {
                                            echo '<option value ="../administrator/index.php?modo=gestNoticias&seccionS=' .
                                                $subSeccion . '&seccionP=' . $_GET["seccionP"] . '">' . $subSeccion . '</option>';
                                        }
                                    }
                                }
                            }
                            ?>
                        </select>
                    </form>
                    <a class="btn-general" id="btn-crarNoticia" href="../administrator/index.php?modo=crearNoticia">Añadir
                        Noticia</a>
                </div>
                <div class="contentContent" id="estadoNoticia">
                    <?php foreach ($this->noticias as $noticia) {
                        echo "<a id='titular' href='../administrator/index.php?modo=modificarNoticia&idNoticia=" . $noticia->getId() . "'>Titular: " . $noticia->getTitular() . "</a>";

                        ?>
                        <div class="fila">
                            <div class="accionesN">
                                <form>
                                    <select class="select" name="area" onChange="window.location.href=this.value">
                                        <option value="Seleccione una opción">Accion</option>

                                        <option value="../administrator/index.php?modo=verNoticia&idNoticia=<?php echo $noticia->getId() ?>">
                                            Visualizar
                                        </option>

                                        <option value="../administrator/index.php?modo=gestNoticias&accion=eliminarNoticia&idNoticia=<?php echo $noticia->getId() ?>">
                                            Eliminar
                                        </option>
                                        <option value="../administrator/index.php?modo=modificarNoticia&idNoticia=<?php echo $noticia->getId() ?>">
                                            Modificar
                                        </option>
                                        <?php
                                        if( isset($_SESSION["editor"])) {
                                            ?>
                                            <option value="../administrator/index.php?modo=gestComentariosNoticia&idNoticia=<?php echo $noticia->getId() ?>">
                                                Gest.Comentarios
                                            </option>
                                            <?php
                                        }
                                            ?>
                                        </option>
                                    </select>
                                </form>
                            </div>
                            <?php

                            if ($noticia->getEstado() == 1) {
                                echo 'Estado: Publicada';
                            } else {
                                echo 'Estado: Pendiente';
                            }
                            if (isset($_SESSION["editor"])) {
                                ?>
                                <div class="accionesN">
                                    <form>
                                        <select name="estado" onChange="window.location.href=this.value">
                                            <option>Cambiar Estado</option>
                                            <option value="../administrator/index.php?modo=gestNoticias&accion=modEstado&estado=1&idNoticia=<?php echo $noticia->getId() ?>">
                                                Publicada
                                            </option>
                                            <option value="../administrator/index.php?modo=gestNoticias&accion=modEstado&estado=3&idNoticia=<?php echo $noticia->getId() ?>">
                                                Pendiente
                                            </option>
                                        </select>
                                    </form>
                                </div>
                                <hr>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    } ?>


                </div>
            </div>

        </div>
        <?php
    }
}