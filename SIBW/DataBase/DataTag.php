<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 13/05/2017
 * Time: 20:48
 */
class DataTag
{
    private $dataBase;

    public function DataTag($dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function getAllTags()
    {
        $resultTags = $this->dataBase->getAllTags();
        $lista_tags = array();
        while( $row = $resultTags->fetch_assoc() ){
            array_push($lista_tags, $row["tag"]);
        }
        $tags = new Tag($lista_tags);
        return $tags;
    }
}