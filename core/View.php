<?php


namespace core;


class View
{
    private $url = '';
    private $param;
    public function __construct($url,$param){
        $this->url = 'app/view/'.$url;
        $this->param = $param;
    }

    public function view(){
        extract($this->param);
        include $this->url;
        return $this;
    }


}


