<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/08/2019
 * Time: 19:40
 */

namespace interfaces;


interface ViewInterface {

    public function setViewName(string $name);

    public function setViewContent();

    public function getViewContent();

}