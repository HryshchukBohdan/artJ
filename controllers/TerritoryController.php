<?php // Контролер странички категорий
namespace controllers;

use models\TerritoryModel;

class TerritoryController extends Controller {

    public function indexAction() {

        $terObj = new TerritoryModel;

        $ter = $terObj->get();
        $colomns = $terObj->getColomns();

        $view = new View('main');
        $view->setData(['ter' => $ter, 'colomns' => $colomns]);
    }

    public function ajaxTerAction() {

        $terObj = new TerritoryModel;

        $id = $_POST['ter_id'];

        $ter = $terObj->getChildren($id);

        $view = new View('temp-select');
        $view->setData(['territory' => $ter]);
    }
}