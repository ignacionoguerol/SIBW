<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 12/05/2017
 * Time: 18:51
 */
class HeadGestView
{
    public function out()
    {
        ?>
        <div class="head">
            <a href="../administrator/index.php?modo=gestNoticias">
                <img id="imgLogo" src="../images/logo.png" alt="Imagen del logo"></a>
            <p>RoboScience Administrator</p>
        </div>
        <?php
    }
}