<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 14/05/2017
 * Time: 20:44
 */
class CrearComentarioView
{
    private $cabecera;
    private $menu;
    private $idNoticia;
    private $usuarios;

    // Todas las noticias para poder coger sus titulares
    // El id de la notica para construir el comentario
    public function CrearComentarioView($usuarios, $idNoticia)
    {
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();

        $this->idNoticia = $idNoticia;
        $this->usuarios = $usuarios;
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
                <p>Crear Nuevo Comentario</p>
                <form action="../administrator/index.php?modo=gestComentariosNoticia&accion=crearComentario&idNoticia=<?php echo $this->idNoticia ?>"
                      method="post">
                    <p>Elegir Usuario</p>

                    <select name="usuario" required>
                        <?php
                        foreach ($this->usuarios as $usuario) {
                            echo '<option value="' . $usuario->getUserName() . '"">' . $usuario->getUserName() . '</option>';
                        }
                        ?>
                    </select>
                    <p>Texto</p>
                    <textarea type="text" name="texto" placeholder="Texto extendido" required></textarea>
                    <input type="submit" class="btn-general" value="Crear">
                </form>
            </div>
        </div>
        <?php
    }
}