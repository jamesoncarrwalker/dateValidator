<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/08/2019
 * Time: 20:38
 */

namespace interfaces;


interface UserOutputInterface {

    public function setMessage(string $message);

    public function getMessage();
}