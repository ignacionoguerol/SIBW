<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 15/05/2017
 * Time: 21:55
 */
class GestPublicidadView
{
    private $cabecera;
    private $menu;
    private $anuncios;
    private $noticia;

    public function GestPublicidadView($anuncios)
    {
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();
        $this->anuncios = $anuncios;
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
                    <p>Publicidad existente</p>
                    <a class="btn-general" id="btn-anuncio"
                       href="../administrator/index.php?modo=crearAnuncio">Añadir Anuncio</a>
                </div>
                <div class="contentContent">
                    <?php foreach ($this->anuncios as $anuncio) { ?>
                        <div class="acciones accionesP">
                            <form>
                                <select class="select" name="area" onChange="window.location.href=this.value">
                                    <option value="Seleccione una opción">Accion</option>
                                    <option value="../administrator/index.php?modo=modificarAnuncio&idAnuncio=<?php echo $anuncio->getId() ?>">
                                        Modificar
                                    </option>
                                    <option value="../administrator/index.php?modo=gestPublicidad&accion=eliminarAnuncio&idAnuncio=<?php echo $anuncio->getId() ?>">
                                        Eliminar
                                    </option>
                                    </option>
                                </select>
                            </form>
                        </div>
                        <?php
                        ?>
                        <?php
                        echo "<a href='../administrator/index.php?modo=modificarAnuncio&idAnuncio=" . $anuncio->getId() . "'>" . $anuncio->getTexto() . "</a>";
                    } ?>
                </div>
            </div>
        </div>
        <?php
    }
}