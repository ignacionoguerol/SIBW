<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 09/04/2017
 * Time: 18:17
 */
class PortadaView
{
    private $noticias;
    private $cabecera;
    private $menu;
    private $pie;
    private $rss;
    private $anuncios;

    public function PortadaView($noticias, $anuncios)
    {
        $this->noticias = $noticias;
        $this->cabecera = new HeadView();
        $this->menu = new MenuView();
        $this->pie = new FootView();
        $this->rss = new Rss("NBC");
        $this->anuncios = $anuncios;
    }

    public function out()
    {
        ?>
        <div class="container" onclick="hideResult()">
            <?php
            $this->cabecera->out();
            $this->menu->out();
            ?>


            <div class="news">
                <div class="newsPrincipal">
                    <?php
                    $this->noticias[0]->outPrincipal();
                    ?>
                </div>

                <div class=newsLeft>
                    <?php
                    for ($i = 1; $i < count($this->noticias); $i += 2) {
                        $this->noticias[$i]->out();
                    }
                    ?>
                </div>

                <div class=newsCenter>
                    <?php
                    for ($i = 2; $i < count($this->noticias); $i += 2) {
                        $this->noticias[$i]->out();
                    }
                    ?>
                </div>

                <div class=newsRight>
                    <?php
                    /*$repeat = array();
                    for ($i = 1; $i <= 4; $i++) {
                        do {
                            $rss_i = rand(1, 10);
                            $ads_i = rand(1, 8);
                        } while (in_array($rss_i, $repeat) || in_array("ads" . $ads_i, $repeat));

                        array_push($repeat, $rss_i);
                        array_push($repeat, "ads" . $ads_i);

                        $this->rss->out($rss_i);
                        echo("<img src='ads/anuncio" . $ads_i . ".jpeg' alt='img'>");
                    }
                    */
                    foreach ($this->anuncios as $anuncio){
                        $anuncio->out();
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