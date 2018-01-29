<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 15/05/2017
 * Time: 23:53
 */
class GestPortadaView
{
    private $cabecera;
    private $menu;
    private $noticias; // Ordenadas por visitas

    public function GestPortadaView($noticias)
    {
        $this->cabecera = new HeadGestView();
        $this->menu = new MenuGestView();
        $this->noticias = $noticias;
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
                    <p>Organizador de Portada</p>
                    <?php
                    if (isset($_GET["errorPortada"])) {
                        echo '<p>No se deben de repetir noticias en las posiciones</p>';
                    }
                    ?>
                </div>
                <div class="contentContent">
                    <?php
                    ?>
                    <form method="post" action="../administrator/index.php?modo=gestPortada&accion=modificarPortada">
                        <?php

                        for ($i = 0; $i < count($this->noticias) && $i < 10; $i++) { ?>
                            <div class="acciones">
                                <p>Posición <?php echo $i + 1 ?>: </p>
                                <select class="select" id="gestPortada" name="pos<?php echo $i ?>" onChange="window.location.href=this.value">

                                    <?php
                                    foreach ($this->noticias as $noticia) {
                                        if($noticia == $this->noticias[$i]){
                                            ?>
                                            <option selected value="../administrator/index.php?modo=gestPortada&accion=modificarPortada&idNoticia=<?php echo $noticia->getId() ?>&orden=<?php echo 10-$i?>">
                                                <?php echo $noticia->getTitular() ?></option>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <option value="../administrator/index.php?modo=gestPortada&accion=modificarPortada&idNoticia=<?php echo $noticia->getId() ?>&orden=<?php echo 10-$i?>">

                                            <?php echo $noticia->getTitular() ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                        }
                        ?>
                        <!--<input type="submit" class="btn-general" id="btn-modPortada" value="Modificar Portada">-->
                    </form>
                </div>

            </div>
        </div>
        <?php
    }
}