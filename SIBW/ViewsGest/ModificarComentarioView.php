<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 14/05/2017
 * Time: 15:45
 */
class ModificarComentarioView
{
    private $cabecera;
    private $menu;
    private $comentario;

    public function ModificarComentarioView($comentario)
    {
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();
        $this->comentario = $comentario;
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

                <p>Modificando Comentario</p>
                <form action="../administrator/index.php?modo=gestComentariosNoticia&accion=modificarComentario&idComentario=<?php echo $this->comentario->getId() ?>&idNoticia=<?php echo $this->comentario->getNoticiaId()?>" method="post">
                    <p>Nombre</p>
                    <input type="text" value="<?php echo $this->comentario->getNombre();?>" name="nombre" placeholder="Nombre de Usuario" required>
                    <p>Correo</p>
                    <input type="text" value="<?php echo $this->comentario->getCorreo();?>" name="correo" placeholder="Correo de Usuario" required>
                    <p>Texto</p>
                    <textarea type="text" name="texto" placeholder="Texto extendido" required><?php echo $this->comentario->getTexto();?></textarea>
                    <input type="submit" class="btn-general" value="Guardar">
                </form>
            </div>
        </div>
        <?php
    }
}