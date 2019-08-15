<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/08/2019
 * Time: 21:48
 */

namespace view\landing;

use abstractClasses\AbstractPublicPage;
use view\common\sections\Header;
use view\forms\sections\DateInput;

class LandingPage extends AbstractPublicPage {

    private $header;
    private $dateInput;

    public function __construct(Header $header,DateInput $dateInput) {
        //define which views this page depends on
        $this->header = $header;
        $this->dateInput = $dateInput;
    }

    public function setBody() {
       $this->body = $this->header->getViewContent() . '
        <body>
            <div class="container">
                <div class="jumbotron">
                    ' . $this->dateInput->getViewContent() . '
                    <div class="message">
                          ' . (isset($_SESSION['message']) ? $_SESSION['message'] : '') . '
                    </div>
                </div>
            </div>
        </body>';
        unset($_SESSION['message']);
    }
}