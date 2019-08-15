<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/08/2019
 * Time: 20:51
 */

namespace interfaces;


interface StatusInterface {

    public function setStatus(bool $status);

    public function getStatus() : bool;
}