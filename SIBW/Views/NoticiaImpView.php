<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 11/04/2017
 * Time: 19:31
 */
class NoticiaImpView
{
    private $noticia;
    private $cabecera;

    public function NoticiaImpView($noticia)
    {
        $this->cabecera = new HeadView();
        $this->noticia = $noticia[0];
    }

    public function out()
    {
        ?>
        <div class="container">
            <?php echo $this->cabecera->out(); ?>
            <div class="news">
                <div class="dateDiv">
                    <p> <?php echo $this->noticia->getFecha() . " | " . $this->noticia->getAutor(); ?></p>
                    <hr>
                </div>
                <img class="newsImageCenter" src=<?php echo $this->noticia->getImg()->getUrl(); ?>>
                <p class="newsExplainedTitle"><?php echo $this->noticia->getTitular();?></p>
                <h3><?php echo $this->noticia->getResumen();?></h3>

                <div class="newColLeft">
                    <p>
                        <?php echo $this->noticia->getTextImpLeft(); ?>
                    </p>
                </div>
                <div class="newColRight">
                    <p>
                        <?php echo $this->noticia->getTextImpRight();
                        if($this->noticia->getVideo() != ""){
                            echo 'Url de video explicativo: '.$this->noticia->getVideo();
                        }?>
                    </p>
                </div>


            </div>
        </div>
        <?php
    }
}