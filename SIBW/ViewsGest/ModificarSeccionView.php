<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 15/05/2017
 * Time: 2:41
 */
class ModificarSeccionView
{
    private $cabecera;
    private $menu;
    private $secciones;
    private $nombreSeccion;

    public function ModificarSeccionView( $nombreSeccion, $secciones )
    {
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();
        $this->secciones = $secciones;
        $this->nombreSeccion = $nombreSeccion;
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
                    <p>Modificar Sección Principal</p>
                    <form action="../administrator/index.php?modo=gestSecciones&accion=modificarSeccion&seccion=<?php echo $this->nombreSeccion?>"
                          method="post">
                        <p>Insertar nuevo nombre de la nueva sección Principal</p>
                        <input type="text" name="nombre" value="<?php echo $this->nombreSeccion?>" placeholder="Nombre de sección" required>
                        <input type="submit" class="btn-general" value="Modificar">
                    </form>
                </div>
                <?php
            }else{
                ?>
                <div class="formGestion">
                    <p>Modificar Sección Secundaria</p>
                    <form action="../administrator/index.php?modo=gestSecciones&accion=modificarSeccion&seccion=<?php echo $this->nombreSeccion?>"
                          method="post">
                        <p>Insertar nombre de la nueva sección Secundaria</p>
                        <input type="text" name="nombre" value="<?php echo $this->nombreSeccion?>" placeholder="Nombre de subsección" required>
                        <p>Cambiar la sección principal a la que pertenecerá</p>
                        <select name="seccionP" required>
                            <?php
                            foreach ($this->secciones as $seccion) {
                                echo '<option value="' . $seccion->getName() . '"">' . $seccion->getName() . '</option>';
                            }
                            ?>
                        </select>
                        <input type="submit" class="btn-general" value="Modificar">
                    </form>
                </div>
                <?php
            }
            ?>

        </div>
        <?php
    }
}