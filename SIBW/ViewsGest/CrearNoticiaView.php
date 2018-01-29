<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 13/05/2017
 * Time: 14:44
 */
class CrearNoticiaView
{
    private $cabecera;
    private $menu;
    private $secciones;
    private $tags;

    public function CrearNoticiaView( $secciones, $tags )
    {
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();

        $this->secciones = $secciones;
        $this->tags = $tags;
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
                <p>Crear Nueva Noticia</p>
                <form action="../administrator/index.php?modo=gestNoticias&accion=crearNoticia" method="post">
                    <p>Titular</p>
                    <input type="text" name="titular" placeholder="Titular" required>
                    <p>Resumen</p>
                    <textarea type="text" name="resumen" placeholder="Breve resumen" required></textarea>
                    <p>Texto</p>
                    <textarea type="text" name="texto" placeholder="Texto extendido" required></textarea>
                    <p>Autor</p>
                    <input type="text" name="autor" placeholder="autor" required>
                    <p>Asignar sección</p>
                    <select name="seccion" required>
                        <?php
                        foreach ($this->secciones as $seccion){
                            foreach ($seccion->getSubSecciones() as $subSeccion){
                                echo '<option value="'.$subSeccion.'"">'.$seccion->getName().' - '.$subSeccion.'</option>';
                            }
                        }
                        ?>
                    </select>
                    <p>Asignar tags</p>
                    <select name="tag1" required>
                        <?php
                        foreach ($this->tags->getTags() as $tag) {
                            echo '<option>' . $tag . '</option>';
                        }
                        ?>
                    </select>
                    <select name="tag2" required>
                        <?php
                        foreach ($this->tags->getTags() as $tag) {
                            echo '<option>' . $tag . '</option>';
                        }
                        ?>
                    </select>
                    <p>Imagen principal</p>
                    <input type="text" name="imagenPrincipal" placeholder="Localizacion" required>
                    <p>Descripción de la imagen</p>
                    <input type="text" name="imagenTexto" placeholder="Descripción breve" required>
                    <p>Autor de la imagen</p>
                    <input type="text" name="imagenAutor" placeholder="Autor" required>
                    <p>Fecha de la imagen</p>
                    <input type="date" value="2000-01-01" name="imagenFecha" placeholder="fecha" required>
                    <p>Video (Opcional)</p>
                    <input type="text" name="video" placeholder="Localizacion">
                    <input type="submit" class="btn-general" value="Crear">

                </form>
            </div>

        </div>
        <?php
    }
}