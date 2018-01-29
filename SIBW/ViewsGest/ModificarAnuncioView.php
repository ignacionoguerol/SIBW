<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 15/05/2017
 * Time: 23:15
 */
class ModificarAnuncioView
{
    private $cabecera;
    private $menu;
    private $anuncio;

    public function ModificarAnuncioView($anuncio)
    {
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();
        $this->anuncio = $anuncio;
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
                <p>Modificar Anuncio</p>
                <form action="../administrator/index.php?modo=gestPublicidad&accion=modificarAnuncio&idAnuncio=<?php echo $this->anuncio->getId() ?>"
                      method="post">
                    <p>Descripción</p>
                    <input type="text" name="texto" value="<?php echo $this->anuncio->getTexto() ?>" placeholder="Breve descripción" required>
                    <p>URL de imagen</p>
                    <input type="text" name="imagen" value="<?php echo $this->anuncio->getImagen() ?>"placeholder="URL" required>
                    <input type="submit" class="btn-general" value="Modificar">
                </form>
            </div>
        </div>
        <?php
    }
}