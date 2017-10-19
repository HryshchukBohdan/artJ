<?php // Контролер пользователей
namespace controllers;

use models\UserModel;

class UserController extends Controller
{
    public function regAction() {

        $userObj = new UserModel();

        $user = $userObj->userInfoByEmail($_POST['email']);

        if($user && isset($user[0])) {

            $view = new View('temp-modal');
            $view->setData(['user' => $user[0]]);
            return $view;

        } else {

            $user = $userObj->insertUser($_POST);

            if($user) {
                return true;
            } else {
                $view = new View('404');
                return $view;
            }
        }
    }
}