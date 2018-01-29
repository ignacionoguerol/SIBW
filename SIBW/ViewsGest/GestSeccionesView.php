<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 14/05/2017
 * Time: 21:51
 */
class GestSeccionesView
{
    private $cabecera;
    private $menu;
    private $secciones;

    public function GestSeccionesView($secciones)
    {
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();
        $this->secciones = $secciones;
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
                    <p>Listado de secciones con sus subsecciones</p>
                    <a class="btn-general" id="btn-seccionPrincipal"
                       href="../administrator/index.php?modo=crearSeccion&tipo=principal">
                        Añadir Sección Principal</a>
                    <a class="btn-general" id="btn-seccionSecundaria"
                       href="../administrator/index.php?modo=crearSeccion&tipo=secundaria">
                        Añadir Sección Secundaria</a>
                </div>
                <div class="contentContent">

                    <?php
                    // Quitamos la seccion N/A, no tiene sentido modificar nada de esta sección.
                    //unset($this->secciones[0]);
                    foreach ($this->secciones as $seccion) { ?>
                        <div class="acciones" id="secciones">
                            <form>
                                <select class="select" name="area" onChange="window.location.href=this.value">
                                    <option value="Seleccione una opción">Accion</option>
                                    <option value="../administrator/index.php?modo=crearSeccion&tipo=secundaria&primaria=<?php echo $seccion->getName() ?>">
                                        Add Subsec
                                    </option>
                                    <option value="../administrator/index.php?modo=modificarSeccion&tipo=principal&nombre=<?php echo $seccion->getName() ?>">
                                        Modificar
                                    </option>
                                    <option value="../administrator/index.php?modo=gestSecciones&accion=eliminarSeccion&tipo=principal&nombre=<?php echo $seccion->getName() ?>">
                                        Eliminar
                                    </option>
                                    </option>
                                </select>
                            </form>
                        </div>
                        <?php
                        ?>
                        <?php
                        echo "<a href='../administrator/index.php?modo=modificarSeccion&tipo=principal&nombre=" . $seccion->getName() . "'>" . $seccion->getName() . "</a>";
                        foreach ($seccion->getSubSecciones() as $subseccion) {
                            ?>
                            <div class="acciones" id="subSecciones">
                                <form>
                                    <select class="select" name="area" onChange="window.location.href=this.value">
                                        <option value="Seleccione una opción">Accion</option>
                                        <option value="../administrator/index.php?modo=modificarSeccion&tipo=secundaria&nombre=<?php echo $subseccion ?>">
                                            Modificar
                                        </option>
                                        <option value="../administrator/index.php?modo=gestSecciones&accion=eliminarSeccion&tipo=secundaria&nombre=<?php echo $subseccion ?>">
                                            Eliminar
                                        </option>
                                        </option>
                                    </select>
                                </form>
                            </div>
                            <?php
                            ?>
                            <?php
                            echo "<a href='../administrator/index.php?modo=modificarSeccion&tipo=secundaria&nombre=" . $subseccion . "'>".$subseccion."</a>";
                            ?>
                            <?php
                        }
                    } ?>
                </div>
            </div>
        </div>
        <?php
    }
}