<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/08/2019
 * Time: 21:11
 */

namespace abstractClasses;

use interfaces\FormatterInterface;
use interfaces\ValidatorInterface;

abstract class AbstractFormatter implements ValidatorInterface, FormatterInterface {

    protected $dateTime;
    protected $inputFormat;
    protected $inputValue;
    protected $message;
    protected $formattedDate;

    abstract function updateInputFormat(string $format);

    abstract function getFormat();

    abstract function setInput($data);

    abstract function isValid() : bool;

    abstract function setMessage(string $message);

    abstract function getMessage();

    abstract function setFormattedData();

    abstract function getFormattedData();

}