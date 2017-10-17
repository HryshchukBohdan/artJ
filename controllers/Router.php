<?php
namespace controllers;
//use config;
//include_once '../config/config.php';

class Router
{
    public function start()
    {
        $route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $routing = [
//

        ];
        $is404 = true;

        foreach ($routing as $urlTemlate => $code) {
            $regexp = "/^" . str_replace("/", "\\/", $urlTemlate) . "$/";
            if (preg_match($regexp, $route, $matches)) {
                if (is_array($code)) {

                    $controller = 'controllers\\' . $code[0];
                    $controller_obj = new $controller();
                    $action = $code[1];

                        if (isset($matches[1])) {
                            $controller_obj->$action($matches[1]);
                        } else {
                            $controller_obj->$action();
                        }
                    }
                 $is404 = false;
                }
            }
        if ($is404) {
            ErrorController::errorAction();
        }
    }
}