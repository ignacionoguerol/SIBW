<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 16/05/2017
 * Time: 5:36
 */
class verNoticiaView
{
    private $cabecera;
    private $menu;
    private $noticia;

    public function verNoticiaView($noticia)
    {
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();
        $this->noticia = $noticia[0];
    }

    public function out()
    {
        ?>
        <div class="container">
            <?php
            $this->cabecera->out();
            $this->menu->out();
            ?>
            <div class="content">


                <div class="cabeceraContent">
                    <p>Contenido de la noticia</p>
                </div>
                <div class="contentContent">
                    <div class="accionesN">
                        <form>
                            <select class="select" name="area" onChange="window.location.href=this.value">
                                <option value="Seleccione una opción">Accion</option>

                                <option value="../administrator/index.php?modo=verNoticia&idNoticia=<?php echo $this->noticia->getId() ?>">
                                    Visualizar
                                </option>

                                <option value="../administrator/index.php?modo=gestNoticias&accion=eliminarNoticia&idNoticia=<?php echo $this->noticia->getId() ?>">
                                    Eliminar
                                </option>
                                <option value="../administrator/index.php?modo=modificarNoticia&idNoticia=<?php echo $this->noticia->getId() ?>">
                                    Modificar
                                </option>
                                <?php
                                if (isset($_SESSION["editor"])) {
                                    ?>
                                    <option value="../administrator/index.php?modo=gestComentariosNoticia&idNoticia=<?php echo $this->noticia->getId() ?>">
                                        Gest.Comentarios
                                    </option>
                                    <?php
                                }
                                ?>

                            </select>
                        </form>
                    </div>

                    <?php
                    if (isset($_SESSION["editor"])) {
                        ?>
                        <div class="accionesN">
                            <form>
                                <select name="estado" onChange="window.location.href=this.value">
                                    <option>Cambiar Estado</option>
                                    <option value="../administrator/index.php?modo=verNoticia&accion=modEstado&estado=1&idNoticia=<?php echo $this->noticia->getId() ?>">
                                        Publicada
                                    </option>
                                    <option value="../administrator/index.php?modo=verNoticia&accion=modEstado&estado=3&idNoticia=<?php echo $this->noticia->getId() ?>">
                                        Pendiente
                                    </option>
                                </select>
                            </form>
                        </div>
                        <hr>
                        <?php
                    }

                    ?>
                    <div class="vistaComentario">
                        <?php
                        echo $this->noticia->out();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}