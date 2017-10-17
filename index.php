<?php

require_once 'controllers/Loader.php';

use controllers\Loader;
use controllers\Router;

session_start(); // Старт сесии

$loader = new Loader();
spl_autoload_register([$loader, 'loadClass']);

$router = new Router();
$router->start();