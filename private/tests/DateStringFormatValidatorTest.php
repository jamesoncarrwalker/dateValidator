<?php
declare(strict_types=1);
use model\classes\DateStringFormatValidator;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 14/08/2019
 * Time: 17:31
 */




class DateStringFormatValidatorTest extends TestCase {

    public function testDatePregmatch() {
        $dateString = "14/08/2019";

//        $this->assertTrue(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$dateString),"original regex");
        $this->assertTrue(preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$dateString) == 1);
    }
//
//    public function CantCreateValidatorWithIntFormat() {
//        $validator = new DateStringFormatValidator(null,123);
//        $this->assertFalse($validator instanceof DateStringFormatValidator,"created with an int");
//    }
//    public function CantCreateValidatorWithBoolFormat() {
//        $validatorTrue = new DateStringFormatValidator(null,true);
//        $this->assertFalse($validatorTrue instanceof DateStringFormatValidator);
//        $validatorFalse = new DateStringFormatValidator(null,false);
//        $this->assertFalse($validatorFalse instanceof DateStringFormatValidator);
//    }
//    public function CanCreateValidatorWithString() {
//        $validator = new DateStringFormatValidator(new DateTime(),"string");
//        $this->assertTrue($validator instanceof DateStringFormatValidator);
//    }
//
//    public function testValidatorCreatesDate() {
//        $validator = new DateStringFormatValidator(new DateTime(),'D/M/Y');
//
//    }
//
//    public function testValidatorOnlyTakesValidDateFormat() {
//        $validatorJam = new DateStringFormatValidator(new DateTime(),'jam');
//        $validatorRandom = new DateStringFormatValidator(new DateTime(),random_bytes(12));
//        $validatorDDMM = new DateStringFormatValidator(new DateTime(),'D/M/Y');
//        $this->assertFalse($validatorJam instanceof DateStringFormatValidator,'created with jam');
//        $this->assertFalse($validatorRandom instanceof DateStringFormatValidator,'created with randomBytes');
//        $this->assertTrue($validatorDDMM instanceof DateStringFormatValidator,'failed with DMY');
//
//
//
//    }


}
