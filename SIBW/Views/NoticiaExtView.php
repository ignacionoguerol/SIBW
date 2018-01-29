<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 10/04/2017
 * Time: 6:53
 */
class NoticiaExtView
{
    private $noticia;
    private $warnings;
    private $cabecera;
    private $menu;
    private $social;
    private $pie;

    private $datosUsuario;

    public function NoticiaExtView($noticia, $datosUsuario)
    {
        $this->noticia = $noticia[0];
        $this->warnings = new WarningView();
        $this->cabecera = new HeadView();
        $this->menu = new MenuView();
        $this->social = new SocialView();
        $this->pie = new FootView();

        $this->datosUsuario = $datosUsuario;
    }

    public function out()
    {
        $this->warnings->printView($this->noticia);
        ?>
        <div class="container" onclick="hideResult()">
            <?php
            $this->cabecera->out();
            $this->menu->out();
            ?>

            <div class="news">

                <!-- Comments -->
                <?php
                if (isset($_SESSION["usuario"])) {
                    echo '<button onclick="ToggleComment()" class="btn-comment btn-general">Comentarios</button>';
                    if(isset($_SESSION["editor"])){
                        echo '<a href="index.php?modo=modNoticia&idNoticia='.$this->noticia->getId().'" 
                        class="enlace-editorModificar">Pincha aquí para modificar esta noticia</a>';
                    }
                } else {
                    echo '<p class="advice-comment">Si desea hacer un comentario inicie sesión</p>';
                }
                if(isset($_SESSION["usuario"])) {
                    ?>

                    <div id="comment" style="pointer-events: none">
                        <div id="list-comments">
                            <img src="images/close.jpg" id="close" onclick="ToggleComment()"
                                 class="btn-close btn-general">
                            <?php
                            foreach ($this->noticia->getComentarios() as $comentario) {
                                $comentario->out();
                            }
                            ?>
                        </div>
                        <hr>
                        <h1>Añadir comentario</h1>
                        <form action="index.php?modo=noticiaExp&accion=crearComentario&id=<?php echo $this->noticia->getId() ?>"
                              id="form" method="post" onkeypress="disable-SendEnter()">
                            <?php
                                if(!isset($_SESSION["usuarioGest"]) && !isset($_SESSION["editor"]) ){
                                ?>
                                <p class="element">Nombre*: <?php echo $this->datosUsuario["nombre"] ?></p>
                                <p class="element">Email: <?php echo $this->datosUsuario["email"] ?></p>
                                <?php
                            }
                        ?>
                            <p class="element">Comentario*: </p>
                            <textarea id="comment-form" rows="4" class="input" onkeypress="FilterText()" type="text"
                                      name="texto"
                                      value=""></textarea>
                            <input type="submit" class="btn-general btn-send" value="Añadir">
                        </form>
                        <p> Los campos con * son obligatorios</p>

                        <!--<button id="send" onclick="AddComment()" class="btn-send btn-general">Añadir</button>-->
                    </div> <!-- End comments -->
                    <?php
                }
                    ?>
                <div class="primary-news" onclick="CloseComment()">
                    <div class="newsImagePrincipal">
                        <p class="newsExplainedTheme"><?php echo $this->noticia->getSeccion(); ?></p>
                        <img src=<?php echo $this->noticia->getImg()->getUrl(); ?>>
                        <p class="footer"><?php echo $this->noticia->getImg()->getTexto() . " | " .
                                $this->noticia->getImg()->getFecha() . " | " .
                                $this->noticia->getImg()->getAutor(); ?>
                        </p>
                    </div>


                    <p class="newsExplainedTitle"><?php echo $this->noticia->getTitular() ?></p>
                    <h3><?php echo $this->noticia->getResumen(); ?> </h3>


                    <div class="newsExplainedImageLeft">

                        <?php
                        /*if (count($this->noticia->getListImg()) > 0) {
                            echo '<img src=' . $this->noticia->getListImg()[1]->getUrl() . '>
                            <p class="footer">' . $this->noticia->getImg()->getTexto() . ' | . ' .
                                $this->noticia->getImg()->getFecha() . ' | ' .
                                $this->noticia->getImg()->getAutor() . '</p>';
                        } */?>
                    </div>

                    <?php
                    echo $this->noticia->getTexto();
                    ?>

                    <p>
                        Noticia publicada el <?php echo $this->noticia->getFecha(); ?>
                    </p>
                    <p>
                        Última modificación realizada el <?php echo $this->noticia->getModificacion(); ?>
                    </p>

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