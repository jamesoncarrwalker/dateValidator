<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/08/2019
 * Time: 21:12
 */

namespace interfaces;


interface ValidatorInterface extends UserOutputInterface {

    public function isValid() : bool;

}