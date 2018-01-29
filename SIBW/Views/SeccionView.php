<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 14/04/2017
 * Time: 1:49
 */
class SeccionView
{
    private $noticias;
    private $cabecera;
    private $menu;
    private $pie;
    private $rss;
    private $anuncios;

    public function SeccionView($noticias, $anuncios)
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
        {
            ?>
            <div class="container">
                <?php
                $this->cabecera->out();
                $this->menu->out();
                ?>


                <div class="news">

                    <div class="sliderGalery">
                        <?php
                        // Obtenemos todas las imagenes de todas las noticias de la seccion
                        for ($i = 0; $i < count($this->noticias); $i++) {
                            echo '<img class="sliderImg" src=' . $this->noticias[$i]->getImg()->getUrl() . '>';
                            $lista = $this->noticias[$i]->getListImg();
                            for ($j = 1; $j <= count($lista); $j++) {
                                echo '<img class="sliderImg" src=' . $lista[$j]->getUrl() . '>';
                            }
                        }
                        if (isset($this->noticias[0])) {
                            ?>
                            <button class="sliderButtonLeft" onclick="plusDivs(-1)">&#10094;</button>
                            <button class="sliderButtonRight" onclick="plusDivs(1)">&#10095;</button>

                            <?php
                        }else{
                            echo '<p>No hay noticias asociadas aún a esta categoría</p>';
                        }
                        ?>
                </div>

                    <div class=newsLeft>
                        <?php
                        for ($i = 0; $i < count($this->noticias); $i += 2) {
                            $this->noticias[$i]->out();
                        }
                        ?>
                    </div>

                    <div class=newsCenter>
                        <?php
                        for ($i = 1; $i < count($this->noticias); $i += 2) {
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
                            } while (in_array($rss_i, $repeat) || in_array('ads' . $ads_i, $repeat));

                            array_push($repeat, $rss_i);
                            array_push($repeat, "ads" . $ads_i);
                            $this->rss->out($rss_i);
                            echo("<img src='ads/anuncio" . $ads_i . ".jpeg'>");
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
}