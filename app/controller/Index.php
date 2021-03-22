<?php

namespace app\controller;
use core\View;

class Index
{
    public function index(){
       $info =  (new View('index.html',['id'=>2,'name'=>'yqx','info'=>['age'=>14,'sex'=>'女']]))->view();
    }

    public function ceshi(){
        dd('hehelow');
    }
}