<?php
namespace controllers;

class ErrorController extends Controller {

     static public function errorAction() {

         $view = new View('404');
         return $view;
    }
}