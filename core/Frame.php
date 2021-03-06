<?php

namespace core;

class Frame
{
    public static function run()
    {
        list($controller, $action) = explode('/', $_GET['s']);
        if (empty($controller)) {
            $controller = 'Index';
            $action = 'index';
        }
        $controller = "\app\controller\\" . ucfirst($controller);
        return (new $controller)->$action();
    }

}