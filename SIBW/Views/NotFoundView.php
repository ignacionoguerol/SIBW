<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 16/04/2017
 * Time: 18:56
 */
class NotFoundView
{

    private $head;
    private $menu;

    public function NotFoundView()
    {
        $this->head = new HeadView();
        $this->menu = new menuView();
    }

    public function out()
    {
        ?>
        <div class="container">
            <?php
            $this->head->out();
            $this->menu->out();
            ?>
            <h1>Ups, no se han encontrado coincidencias</h1>
        </div>
        <?php
    }
}