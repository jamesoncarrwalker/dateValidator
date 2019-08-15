<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 26/07/2019
 * Time: 12:31
 */

namespace model\responseObjects;


use abstractClasses\AbstractPage;
use interfaces\ResponseInterface;


class WebResponse implements ResponseInterface {

    private $page;
    public $errors;
    public $messages;
    public $redirect;
    public $status;
    public $output;
    public $css = [];
    public $js = [];

    public function __construct(AbstractPage $page) {
        $this->page = $page;
        $this->setCommonCss();
        $this->setCommonJs();
    }

    public function setResponseErrors() {
        // TODO: Implement setResponseErrors() method.
    }

    public function setResponseMessages() {
        // TODO: Implement setResponseMessages() method.
    }

    public function setResponseStatus() {
        // TODO: Implement setResponseStatus() method.
    }

    public function getResponsesStatus(int $responseStatus) {
        $this->status = $responseStatus;
    }

    public function setHead() {
        return '<!DOCTYPE html>
                            <html>
                                <head>'
                                    . implode('',$this->css)
                                    . implode('',$this->js) .
                                '</head>';
    }

    public function setOutput() {
        $this->page->setBody();
        $this->page->setTemplate();
        $this->output = $this->setHead() . $this->page->body . '</html>';
    }

    public function getOutput() {
        return $this->output;
    }

    public function setRedirect(string $location) {
        // TODO: Implement setRedirect() method.
    }

    private function setCommonCss() {
        $this->css[] =  '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
        $this->css[] =  '<link href="css/style.css" rel="stylesheet"/>';
    }

    private function setCommonJs() {
        $this->js[] = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
        $this->js[] = '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
    }
}