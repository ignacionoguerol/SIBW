<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 13/05/2017
 * Time: 20:50
 */
class Tag
{
    private $tags;

    public function Tag( $listaTags ){
        $this->tags = $listaTags;
    }

    public function getTags(){
        return $this->tags;
    }
}