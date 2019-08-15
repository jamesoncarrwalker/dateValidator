<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/08/2019
 * Time: 22:56
 */

namespace view\forms\sections;


use abstractClasses\AbstractView;

class DateInput extends AbstractView {

    public function __construct(string $name = "dateInput") {
        parent::__construct($name);
    }

    public function setViewContent() {
       $this->html = '<form action="/dateValidator/?request=checkHistoricalDate" method="post">
                          <div class="form-group">
                            <label for="historicalDate">Date to check:</label>
                            <input name="historicalDate" type="text" class="form-control" placeholder="DD/MM/YYYY" ' . (isset($_REQUEST['historicalDate']) ? 'value="' . $_REQUEST['historicalDate'] . '"' : "") . '>
                          </div>
                          <button type="submit" class="btn btn-default">Submit</button>
                        </form>';
    }

}