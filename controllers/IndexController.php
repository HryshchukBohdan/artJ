<?php // Контролер главной странички
namespace controllers;

use models\TerritoryModel;

class IndexController extends Controller {

    public function indexAction() {

        $terObj = new TerritoryModel();

        $ter = $terObj->getSection();

        $view = new View('user-form');
        $view->setData(['territory' => $ter]);
    }
}