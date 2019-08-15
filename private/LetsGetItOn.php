<?php

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/06/2019
 * Time: 19:34
 */

use interfaces\ControllerInterface;
use model\classes\RequestParamsSanitizer;
use model\helpers\DependencyCheckerController;
use model\responseObjects\AjaxResponse;
use model\responseObjects\WebResponse;
use model\routers\RouteFinderController;


class letsGetItOn {

    protected $urlParams;
    protected $postParams;
    protected $controllerResponse;
    protected $controller;
    public $output;

    function __construct() {
        $this->setAutoLoader();
        parse_str($_SERVER["QUERY_STRING"],$this->urlParams);
        $inputSanitizer = new RequestParamsSanitizer();
        foreach($_REQUEST as $key => $value) {
            $inputSanitizer->setInput($value);
            if($inputSanitizer->checkItemTypeIsValid()){
                $inputSanitizer->cleanItem();
                $_REQUEST[$key] = $inputSanitizer->returnItem();
            } else unset($_REQUEST[$key]);
        }
        $dependencyChecker = new DependencyCheckerController();
        //get a controller
        $routeFinder = new RouteFinderController($dependencyChecker);
        $this->controller = $this->getController($routeFinder);

        $this->controller->runRequest();
        $this->controller->setResponse();
        $this->controllerResponse = $this->controller->getResponse();
        $this->setOutput();
    }

    private function setAutoLoader() {
        return spl_autoload_register(
            function($class) {
                $class = 'private/' .  str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
                if(file_exists($class)) include_once $class;
                else die('Classic case of ' . $class . ' not found');
            }
        );
    }

    private function getController(RouteFinderController $routeFinder) : ControllerInterface {
        //if the first param has a value it's a param, else its a controller call
        //there should never be a blank value in the url
        $controller = key($this->urlParams)??'';
        $routeFinder->setEndpoint(isset($this->urlParams[$controller]) && $this->urlParams[$controller] == "" ? $controller : '');
        if(!$routeFinder->checkRouteIsValid()) $routeFinder->updateControllerName('AllThoseWhoWander');
        $routeFinder->setRoute();
        return $routeFinder->returnResult();
    }

    private function setOutput() {
        if(isset($this->controllerResponse->redirect)) {
            //do the redirect
            //die();
        } else if ($this->controllerResponse instanceof WebResponse) {
            //out put a web page
            $this->controllerResponse->setOutput();
            echo $this->controllerResponse->getOutput();
        } else if ($this->controllerResponse instanceof AjaxResponse) {
            //output the ajax string
        } else {
            //output an error
        }
    }
}