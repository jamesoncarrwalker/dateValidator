<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/08/2019
 * Time: 20:07
 */

namespace view\common\sections;

use abstractClasses\AbstractView;

class Header extends AbstractView {
    public function __construct(string $name = 'publicHeader') {
        parent::__construct($name);
    }

    public function setViewContent() {
        $this->html = '
            <div class="container-fluid historicalHeader">
                <div class="row text-center">
                    <h2 >Historical Date Checker</h2>
                    <h4>Is that date in the past?  Let\'s check</h4>
                </div>
            </div>';
    }

}