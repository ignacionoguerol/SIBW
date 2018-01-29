<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 13/05/2017
 * Time: 23:10
 */
class ModificarNoticiaView
{
    private $cabecera;
    private $menu;
    private $noticia;
    private $secciones;
    private $tags;

    public function ModificarNoticiaView($noticia, $secciones, $tags)
    {
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();

        $this->noticia = $noticia[0];
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
                <?php
                if($this->noticia->getEstado()==2){
                    echo '<p>Alguien está modificando esta noticia.</p>';
                }else{
                   ?>
                    <p>Modificando Noticia</p>
                    <form action="../administrator/index.php?modo=gestNoticias&accion=modificarNoticia&idNoticia=<?php echo $this->noticia->getId() ?>" method="post">
                        <?php
                        if( isset($_SESSION["editor"]) && false){
                            ?>
                            <p>Estado</p>
                            <select name="estado" required>
                                <option selected value="1">Publicar</option>
                                <option value="3">Pendiente</option>
                            </select>
                            <?php
                        }
                        ?>
                        <p>Titular</p>
                        <input type="text" value="<?php echo $this->noticia->getTitular();?>" name=" titular" placeholder="Titular" required>
                        <p>Resumen</p>
                        <textarea type="text" name=" resumen" placeholder="Breve resumen" required><?php echo $this->noticia->getResumen();?></textarea>
                        <p>Texto</p>
                        <textarea type="text" name=" texto" placeholder="Texto extendido" required><?php echo $this->noticia->getTexto();?></textarea>
                        <p>Autor</p>
                        <input type="text" value="<?php echo $this->noticia->getAutor() ?>"
                               name="autor" placeholder="autor" required>
                        <p>Sección</p>
                        <select name="seccion" required>
                            <?php
                            foreach ($this->secciones as $seccion) {
                                foreach ($seccion->getSubSecciones() as $subSeccion) {
                                    if( $subSeccion == $this->noticia->getSeccion()){
                                        echo '<option selected value="' . $subSeccion . '"">' . $seccion->getName() . ' - ' . $subSeccion . '</option>';
                                    }else{
                                        echo '<option value="' . $subSeccion . '"">' . $seccion->getName() . ' - ' . $subSeccion . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                        <p>Tags</p>
                        <select name="tag1" required>
                            <?php
                            foreach ($this->tags->getTags() as $tag) {
                                if( $tag == $this->noticia->getTags()[0]){
                                    echo '<option selected>' . $tag . '</option>';
                                }else{
                                    echo '<option>' . $tag . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <select name="tag2" required>
                            <?php
                            foreach ($this->tags->getTags() as $tag) {
                                if( $tag == $this->noticia->getTags()[1]){
                                    echo '<option selected>' . $tag . '</option>';
                                }else{
                                    echo '<option>' . $tag . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <p>Imagen principal</p>
                        <input type="text" value="<?php echo $this->noticia->getImg()->getUrl()?>" name="imagenPrincipal" placeholder="Localizacion" required>
                        <p>Descripción de la imagen</p>
                        <input type="text" value="<?php echo $this->noticia->getImg()->getTexto()?>" name="imagenTexto" placeholder="Descripción breve" required>
                        <p>Autor de la imagen</p>
                        <input type="text" value="<?php echo $this->noticia->getImg()->getAutor()?>" name="imagenAutor" placeholder="Autor" required>
                        <p>Fecha de la imagen</p>
                        <input type="date" value="<?php echo $this->noticia->getImg()->getFecha()?>" name="imagenFecha" placeholder="fecha" required>
                        <p>Video (Opcional)</p>
                        <input type="text" name="video" placeholder="Localizacion">
                        <input type="submit" class="btn-general" value="Guardar">

                    </form>
                    <?php
                }
                ?>

            </div>
        </div>
        <?php
    }
}