<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 14/05/2017
 * Time: 14:44
 */
class GestComentariosView
{
    private $cabecera;
    private $menu;
    private $comentarios;
    private $noticia;

    public function GestComentariosView($noticia, $comentarios)
    {
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();
        $this->comentarios = $comentarios;
        $this->noticia = isset($noticia) ? $noticia[0] : null;
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
                    <?php
                    if (isset($this->noticia) && isset($this->comentarios[0])) {
                        echo
                        '<p>Comentarios de la noticia con titular:</p>
                        <p>'.$this->noticia->getTitular().'</p>
                        <a class="btn-general" id="btn-crarComentario" 
                        href="../administrator/index.php?modo=crearComentario&idNoticia='.$this->comentarios[0]->getNoticiaId().'">
                        Añadir Comentario</a>';
                    } else if(isset($this->comentarios[0])){
                        echo '<p>Todos los comentarios</p>';
                    } else{
                        echo '<p>Ups, no hay comentarios</p>';
                        echo '<a class="btn-general" id="btn-crarComentario" 
                        href="../administrator/index.php?modo=crearComentario&idNoticia='.$this->noticia->getId().'">
                            Añadir Comentario</a>';
                    }
                    ?>
                </div>
                <div class="contentContent">
                    <?php foreach ($this->comentarios as $comentario) { ?>
                    <div class="acciones">
                        <form>
                            <select class="select" name="area" onChange="window.location.href=this.value">
                                <option value="Seleccione una opción">Accion</option>
                                <option value="../administrator/index.php?modo=modificarComentario&idComentario=<?php echo $comentario->getId() ?>&idNoticia=<?php echo $comentario->getNoticiaId() ?>">
                                    Modificar
                                </option>
                                <option value="../administrator/index.php?modo=gestComentariosNoticia&accion=eliminarComentario&idComentario=<?php echo $comentario->getId() ?>&idNoticia=<?php echo $comentario->getNoticiaId() ?>">
                                    Eliminar
                                </option>
                                </option>
                            </select>
                        </form>
                    </div>
                    <?php
                    ?>
                    <div class="vistaComentario">
                        <?php
                        echo "<a>" . $comentario->outGest() . "</a>";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}