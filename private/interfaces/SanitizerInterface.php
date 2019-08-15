<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 23/07/2019
 * Time: 13:54
 */

namespace interfaces;

interface SanitizerInterface {

    public function checkItemTypeIsValid();

    public function cleanItem();

    public function returnItem();
}