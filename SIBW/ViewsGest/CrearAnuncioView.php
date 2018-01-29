<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 15/05/2017
 * Time: 23:15
 */
class CrearAnuncioView
{
    private $cabecera;
    private $menu;

    public function CrearAnuncioView()
    {
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
            ?>
            <div class="formGestion">
                <p>Crear Nuevo Anuncio</p>
                <form action="../administrator/index.php?modo=gestPublicidad&accion=crearAnuncio"
                      method="post">
                    <p>Descripción</p>
                    <input type="text" name="texto" placeholder="Breve descripción" required>
                    <p>URL de imagen</p>
                    <input type="text" name="imagen" placeholder="URL" required>
                    <input type="submit" class="btn-general" value="Crear">
                </form>
            </div>
        </div>
        <?php
    }
}