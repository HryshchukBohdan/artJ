<?php // Контролер главной странички
namespace controllers;



class IndexController extends Controller {

    public function indexAction() {



//        $view = new View('main');


        $view = new View('user-form');
        $view->setData([]);

    }
}