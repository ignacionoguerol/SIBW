<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 15/05/2017
 * Time: 1:24
 */
class CrearSeccionView
{
    private $cabecera;
    private $menu;
    private $secciones;

    public function CrearSeccionView( $secciones )
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

            if($_GET["tipo"] == "principal"){
                ?>
                <div class="formGestion">
                    <p>Crear Sección Principal</p>
                    <form action="../administrator/index.php?modo=gestSecciones&accion=crearSeccion"
                          method="post">
                        <p>Insertar nombre de la nueva sección Principal</p>
                        <input type="text" name="nombre" placeholder="Nombre de sección" required>
                        <input type="submit" class="btn-general" value="Crear">
                    </form>
                </div>
                <?php
            }else{
                ?>
                <div class="formGestion">
                    <p>Crear Sección Secundaria</p>
                    <form action="../administrator/index.php?modo=gestSecciones&accion=crearSeccion"
                          method="post">
                        <p>Insertar nombre de la nueva sección Secundaria</p>
                        <input type="text" name="nombre" placeholder="Nombre de subsección" required>
                        <p>Seleccionar sección principal a la que pertenecerá</p>
                        <select name="seccionP" required>
                            <?php
                            foreach ($this->secciones as $seccion) {

                                if(isset($_GET["primaria"]) && $_GET["primaria"] == $seccion->getName()){
                                    echo '<option value="' . $seccion->getName() . '"selected>' . $seccion->getName() . '</option>';
                                }else{
                                    echo '<option value="' . $seccion->getName() . '">' . $seccion->getName() . '</option>';
                                }

                            }
                            ?>
                        </select>
                        <input type="submit" class="btn-general" value="Crear">
                    </form>
                </div>
                <?php
            }
            ?>

        </div>
        <?php
    }
}