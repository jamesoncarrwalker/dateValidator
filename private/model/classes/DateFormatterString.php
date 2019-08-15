<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/08/2019
 * Time: 21:28
 */
declare(strict_types=1);

namespace model\classes;


use abstractClasses\AbstractFormatter;
use constants\AbstractConstDateStringFormats;
use DateTime;


class DateFormatterString extends AbstractFormatter {

    public function __construct(DateTime $dateTime, string $format) {
        $this->inputFormat = $format;
        $this->dateTime = $dateTime;
    }

    public function updateInputFormat(string $format) {
        $originalFormat = $this->inputFormat;
        $this->inputFormat = $format;
        if(!$this->expectedOutputFormatIsValid()) $this->inputFormat = $originalFormat;
    }

    public function getFormat() {
        return $this->inputFormat;
    }

    function setInput($dateString) {
        $this->inputValue = $dateString;
    }

    public function isValid() : bool {
        if($this->expectedOutputFormatIsValid()) return $this->inputMatchesExpectedFormat();
        return false;

    }

    public function setMessage(string $message) {
        $this->message = $message;
    }

    public function getMessage() : string {
        return $this->message;
    }

    public function getFormattedData() {
        if($this->isValid()) return str_replace('/','-',$this->inputValue);
        return false;
    }

    private function expectedOutputFormatIsValid() {
        $date = new DateTime();
        $format = str_replace('/','-',$this->inputFormat);
        if(strtotime($date->format($format)) === false) {
            $this->setMessage("Invalid expected date format");
            return false;
        }
        return true;
    }

    private function inputMatchesExpectedFormat() : bool {
        switch($this->inputFormat) {
            case AbstractConstDateStringFormats::d_m_y:
               if(preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$this->inputValue) == 1) return true;
        }
        $this->setMessage("Could not verify date format");
        return false;
    }

    function setFormattedData() {
        $this->formattedDate = $this->dateTime->createFromFormat($this->inputFormat,$this->inputValue);
    }
}