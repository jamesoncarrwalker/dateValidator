<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/08/2019
 * Time: 21:13
 */

namespace interfaces;


interface FormatterInterface {

    public function getFormat();

    public function setFormattedData();

    public function getFormattedData();

    public function setInput($mixedData);
}