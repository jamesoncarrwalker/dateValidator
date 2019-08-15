<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/08/2019
 * Time: 20:23
 */

namespace model\classes;


use interfaces\SanitizerInterface;

class RequestParamsSanitizer implements SanitizerInterface {

    private $input;
    public $output;

    //can be of varying type
    public function setInput($input) {
        $this->input = $input;
    }

    public function checkItemTypeIsValid() {
        return (in_array(gettype($this->input), ["string", "integer", "boolean", "array"]));
    }

    public function cleanItem() {
        switch(gettype($this->input)) {
            case "string":
                $this->cleanString();
                break;
            case "integer":
                $this->cleanInt();
                break;
            case "array":
                $this->cleanArray();
                break;
            default:
                $this->setError();
        }
    }

    public function returnItem() {
       return $this->output;
    }

    private function cleanString() {
        $this->output = $this->input;
    }

    private function cleanInt() {
        //TODO::IMPLEMENT CLEANMETHOD
    }

    private function cleanArray() {
        //TODO::IMPLEMENT CLEANMETHOD
    }

    private function setError() {
        $this->output = false;
    }
}