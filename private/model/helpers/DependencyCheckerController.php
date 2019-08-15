<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 25/07/2019
 * Time: 13:04
 */

namespace model\helpers;

use constants\AbstractConstDateStringFormats;
use constants\AbstractDependencyTypes;
use interfaces\DependenciesInterface;
use model\classes\DateFormatterString;

use model\classes\DateValidator;
use model\classes\Dependency;
use model\routers\RouteFinderView;

class DependencyCheckerController implements DependenciesInterface {

    private $controllerDependencies;
    public $authenticatorWeb;
    public $routeFinderView;
    public $dependencyCheckerView;
    public $requestData;
    protected $webControllerDependencies;

    public function __construct() {
        $this->setWebControllerDependencies();
        $this->setDependencies();
    }

    public function hasDependencies(string $className,string $classType = 'controller') : bool {
       switch($classType) {
           default:
               return isset($this->controllerDependencies[$className]);
       }
    }

    public function getDependencies(string $className,string $classType = 'controller') {
        switch($classType) {
            default:
                return $this->controllerDependencies[$className];
        }
    }

    public function setDependencies(){
        $this->controllerDependencies = [
            'Landing' => array_merge($this->webControllerDependencies,[
                new Dependency(AbstractDependencyTypes::FORMATTER,new DateValidator(new DateFormatterString(new \DateTime(),AbstractConstDateStringFormats::d_m_y)))
            ]),
            'AllThoseWhoWander' => $this->webControllerDependencies
        ];
    }

    private function setWebControllerDependencies() {
        $this->webControllerDependencies = [
            new Dependency(AbstractDependencyTypes::ROUTER,$this->getRouteFinderView())];
    }


    private function getRouteFinderView() : RouteFinderView {
        if($this->routeFinderView == null) $this->routeFinderView = new RouteFinderView($this->getDependencyCheckerView());
        return $this->routeFinderView;
    }

    private function getDependencyCheckerView() : DependencyCheckerView {
        if($this->dependencyCheckerView == null) $this->dependencyCheckerView = new DependencyCheckerView();
        return $this->dependencyCheckerView;
    }


}