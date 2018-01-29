<?php
/**
 * Created by PhpStorm.
 * User: Nacho
 * Date: 13/4/17
 * Time: 8:55
 */

class Rss{

    private $xmlDoc;
    private $xml;
    private $x;

    private $channel;
    private $channel_title = "";
    private $channel_link;
    private $channel_desc;

    private $item_title;
    private $item_link;
    private $item_desc;
    private $q;

    public $view;


    public function Rss( $tema ){
        /*$this->q = $tema;

        if($this->q=="Google") {
            $this->xml=("http://news.google.com/news?ned=us&topic=h&output=rss");
        } elseif($this->q=="NBC") {
            $this->xml = ("http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml");
        } elseif($this->q=="Xataka") {
            $this->xml = ("http://www.xataka.com/index.xml");
        }

        $this->xmlDoc = new DOMDocument();
        $this->xmlDoc->load($this->xml);

        //get elements from "<channel>"
        $this->channel=$this->xmlDoc->getElementsByTagName('channel')->item(0);
        $this->channel_title = $this->channel->getElementsByTagName('title')
            ->item(0)->childNodes->item(0)->nodeValue;
        $this->channel_link = $this->channel->getElementsByTagName('link')
            ->item(0)->childNodes->item(0)->nodeValue;
        $this->channel_desc = $this->channel->getElementsByTagName('description')
            ->item(0)->childNodes->item(0)->nodeValue;

        $this->x = $this->xmlDoc->getElementsByTagName('item');

        $this->view = new RSSView();*/


    }

    public function getChannelTitle(){
        return $this->channel_title;
    }

    public function getChannelLink(){
        return $this->channel_link;
    }

    public function getChannelDescription(){
        return $this->channel_desc;
    }

    public function getTitle($i){
        $this->item_title = $this->x->item($i)->getElementsByTagName('title') ->item(0)->childNodes->item(0)->nodeValue;
        return $this->item_title;
    }

    public function getLink($i){
        $this->item_link = $this->x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
        return $this->item_link;
    }

    public function getDescription($i){
        $this->item_desc = $this->x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
        return $this->item_desc;
    }

    public function out($indice){
        return $this->view->printView($this, $indice);
    }
}