<?php

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 14/08/2019
 * Time: 00:11
 */

use constants\AbstractConstDateStringFormats;
use model\classes\DateFormatterString;
use model\classes\DateValidator;
use PHPUnit\Framework\TestCase;


class DateValidatorTest extends TestCase {


    public function CanCreateDateValidator() {
        $validator = new DateValidator(new DateFormatterString(new DateTime(),AbstractConstDateStringFormats::d_m_y));
        $this->assertTrue($validator instanceof DateValidator);

        return $validator;
    }

    /**
     * @depends testCanCreateDateValidator
     */

    public function CanUpdateFormat(DateValidator $validator) {
        $originalExpectedFormat = $validator->getDateInputFormat();
        $newExpectedFormat = "His";
        $validator->setDateInputFormat($newExpectedFormat);
        $this->assertNotEquals($originalExpectedFormat,$validator->getDateInputFormat());
        return $validator;

    }

    /**
     * @depends testCanUpdateFormat
     */

    public function CantSetInvalidFormat(DateValidator $validator) {
        $originalExpectedFormat = $validator->getDateInputFormat();
        $newExpectedFormat = "jam on toast";
        $validator->setDateInputFormat($newExpectedFormat);
        $this->assertNotEquals($newExpectedFormat,$validator->getDateInputFormat(),'FAIL1');
        $this->assertEquals($originalExpectedFormat,$validator->getDateInputFormat(),'FAIL2');

        $validator->setDateInputFormat(AbstractConstDateStringFormats::d_m_y);
        $this->assertEquals(AbstractConstDateStringFormats::d_m_y,$validator->getDateInputFormat(),'FAIL3');

        return $validator;
    }

    public function HistoricalDateInputMustBeCorrectFormat() {
        $validator = new DateValidator(new DateFormatterString(new DateTime(),AbstractConstDateStringFormats::d_m_y));

        $validator->validateHistoricalDate('4-jan-19');
        $this->assertFalse($validator->isValid());


        $validator->validateHistoricalDate('4/1/19');
        $this->assertFalse($validator->isValid());


        $validator->validateHistoricalDate('4/10/0199');
        $this->assertFalse($validator->isValid());


        $validator->validateHistoricalDate('14/9/1991');
        $this->assertFalse($validator->isValid());

//        $validator->validateHistoricalDate('14/09/1991');
//        $this->assertTrue($validator->isValid());
//        echo $validator->getMessage();
    }

    public function testDateIsInThePast() {
        $validator = new DateValidator(new DateFormatterString(new DateTime(),AbstractConstDateStringFormats::d_m_y));
        $validator->validateHistoricalDate('14/00/1991');
        $validator->isValid();
//        $this->assertTrue();
        echo $validator->getMessage();
        $this->assertTrue(true);
    }


}
