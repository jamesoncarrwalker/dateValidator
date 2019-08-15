<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/08/2019
 * Time: 19:22
 */

namespace model\classes;

use abstractClasses\AbstractFormatter;
use interfaces\ValidatorInterface;

class DateValidator implements ValidatorInterface {

    private $dateFormatValidator;
    private $dateToValidate;
    public $message;

    public function __construct(AbstractFormatter $dateFormatValidator) {
        $this->dateFormatValidator = $dateFormatValidator;
    }

    public function setDateInputFormat(string $format) {
        $this->dateFormatValidator->updateInputFormat($format);
    }
    public function getDateInputFormat() {
        return $this->dateFormatValidator->getFormat();
    }

    public function validateHistoricalDate(string $date) {
        $this->dateToValidate = $date;
    }

    public function isValid() : bool {
        $this->dateFormatValidator->setInput($this->dateToValidate);
        if(!$this->dateFormatValidator->isValid()) {
            $this->setMessage($this->dateFormatValidator->getMessage());
            return false;
        } else {
            $this->dateToValidate = new \DateTime($this->dateFormatValidator->getFormattedData());
            return $this->dateIsHistorical();
        }
    }

    public function setMessage(string $message) {
        $this->message = $message;
    }

    public function getMessage() : string {
        return $this->message;
    }

    private function dateIsHistorical() {
        $now = new \DateTime('now');
        if($now > $this->dateToValidate) return true;
        $this->setMessage("This date is not in the past, you'll need to wait...");
        return false;
    }
}