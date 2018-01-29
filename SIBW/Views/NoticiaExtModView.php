<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 16/05/2017
 * Time: 5:50
 */
class NoticiaExtModView
{
    private $noticia;
    private $warnings;
    private $cabecera;
    private $menu;
    private $social;
    private $pie;

    private $secciones;
    private $tags;


    public function NoticiaExtModView($noticia, $secciones, $tags)
    {
        $this->noticia = $noticia[0];
        $this->warnings = new WarningView();
        $this->cabecera = new HeadView();
        $this->menu = new MenuView();
        $this->social = new SocialView();
        $this->pie = new FootView();

        $this->secciones = $secciones;
        $this->tags = $tags;

    }

    public function out()
    {
        $this->warnings->printView($this->noticia);
        ?>
        <div class="container">
            <?php
            $this->cabecera->out();
            $this->menu->out();
            ?>

            <div class="news">
                <div class="primary-news" onclick="CloseComment()">
                    <div class="newsImagePrincipal">
        <?php
        if($this->noticia->getEstado()==2){
            echo '<p>Alguien está modificando esta noticia.</p>';
        }else{
            ?>
            <div class="formGestion">

                <form action="index.php?modo=noticiaExp&accion=modificarNoticia&id=<?php echo $this->noticia->getId() ?>"
                      method="post">

                    <p>Sección</p>
                    <select name="seccion" required>
                        <?php
                        foreach ($this->secciones as $seccion) {
                            foreach ($seccion->getSubSecciones() as $subSeccion) {
                                if ($subSeccion == $this->noticia->getSeccion()) {
                                    echo '<option selected value="' . $subSeccion . '"">' . $seccion->getName() . ' - ' . $subSeccion . '</option>';
                                } else {
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
                    <input type="text" value="<?php echo $this->noticia->getImg()->getUrl() ?>"
                           name="imagenPrincipal" placeholder="Localizacion" required>
                    <p>Descripción de la imagen</p>
                    <input type="text" value="<?php echo $this->noticia->getImg()->getTexto() ?>"
                           name="imagenTexto" placeholder="Descripción breve" required>
                    <p>Fecha de la imagen</p>
                    <input type="date" value="<?php echo $this->noticia->getImg()->getFecha() ?>"
                           name="imagenFecha" placeholder="fecha" required>
                    <p>Autor de la imagen</p>
                    <input type="text" value="<?php echo $this->noticia->getImg()->getAutor() ?>"
                           name="imagenAutor" placeholder="Autor" required>

                    <p>Titular</p>
                    <input type="text" value="<?php echo $this->noticia->getTitular(); ?>" name=" titular"
                           placeholder="Titular" required>
                    <p>Autor</p>
                    <input type="text" value="<?php echo $this->noticia->getAutor() ?>"
                           name="autor" placeholder="autor" required>
                    <p>Resumen</p>
                    <textarea type="text" rows="6" style="min-width: 100%" name=" resumen"
                              placeholder="Breve resumen"
                              required><?php echo $this->noticia->getResumen(); ?></textarea>
                    <p>Texto</p>
                    <textarea type="text" rows="60" style="min-width: 100%" name=" texto"
                              placeholder="Texto extendido"
                              required><?php echo $this->noticia->getTexto(); ?></textarea>

                    <input type="submit" class="btn-general" value="Guardar">
                </form>
            </div>
            <?php
        }?>

                    </div>

                    <hr>
                    <?php $this->social->out($this->noticia->getId()); ?>
                </div>
                <div class="secondary-news" onclick="CloseComment()">

                    <?php
                    foreach ($this->noticia->getNewsRel() as $noticiaRel) {
                        $noticiaRel->out();
                    }
                    ?>
                </div>
            </div>
            <?php
            $this->pie->out();
            ?>
        </div>
        <?php
    }
}