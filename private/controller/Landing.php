<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 07/07/2019
 * Time: 17:10
 */

namespace controller;

use abstractClasses\AbstractWebController;
use interfaces\RouteFinderInterface;
use interfaces\ValidatorInterface;
use view\common\sections\Header;
use view\forms\sections\DateInput;
use view\landing\LandingPage;

class Landing extends AbstractWebController {

    public $dateValidator;

    public function __construct(RouteFinderInterface $routeFinder, ValidatorInterface $dateValidator) {
        parent::__construct($routeFinder);
        $this->dateValidator = $dateValidator;
    }


    public function getDefaultRequest() {
        return 'loadLandingPage';
    }

    public function loadLandingPage() {
        $this->setPage();
    }

    public function checkHistoricalDate() {
        if(isset($_REQUEST['historicalDate'])) {
            $this->dateValidator->validateHistoricalDate($_REQUEST['historicalDate']);
            if($this->dateValidator->isValid())$_SESSION['message'] = 'Yes, it\'s in the past! ';
            else $_SESSION['message'] = $this->dateValidator->getMessage();
        }
        $this->setPage();
    }

    function setPage() {
        $this->page = new LandingPage(new Header(),new DateInput());
    }
}