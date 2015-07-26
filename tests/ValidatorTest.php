<?php
namespace djekl\NHSNumberValidation\Test;

use djekl\NHSNumberValidation\Test\TestCase;
use djekl\NHSNumberValidation\Validator;
use djekl\NHSNumberValidation\InvalidNumberException;

class ValidatorTest extends TestCase
{
    public function testInit()
    {
        $validator = new Validator;

        $this->assertTrue(is_object($validator));
    }

    public function testHasFunction()
    {
        $validator = new Validator;

        $this->assertTrue(
            method_exists($validator, 'validate'),
            'Class does not have method validate'
        );
    }

    public function testValidateNoNumber()
    {
        $validator = new Validator;

        $this->assertTrue(is_object($validator));

        try {
            $valid = $validator->validate();
        } catch (InvalidNumberException $e) {
            return;
        }
    }

    public function testValidateNumberTooShort()
    {
        $validator = new Validator;

        $this->assertTrue(is_object($validator));

        try {
            $valid = $validator->validate(0123);
        } catch (InvalidNumberException $e) {
            return;
        }
    }

    public function testValidateNumberTooLong()
    {
        $validator = new Validator;

        $this->assertTrue(is_object($validator));

        try {
            $valid = $validator->validate(01234567890);
        } catch (InvalidNumberException $e) {
            return;
        }
    }

    public function testValidNumber()
    {
        $validator = new Validator;

        $this->assertTrue(is_object($validator));

        try {
            $valid = $validator->validate(4010232137);
        } catch (InvalidNumberException $e) {
            return false;
        }

        $this->assertEquals(4010232137, $valid);
    }

    public function testValidNumberWithBadChecksum()
    {
        $validator = new Validator;

        $this->assertTrue(is_object($validator));

        try {
            $valid = $validator->validate(4010232138);
        } catch (InvalidNumberException $e) {
            return false;
        }
    }

    public function testValidNumberWithBadChecksumEqualsTen()
    {
        $validator = new Validator;

        $this->assertTrue(is_object($validator));

        try {
            $valid = $validator->validate(1000000010);
        } catch (InvalidNumberException $e) {
            return false;
        }
    }

    public function testValidNumberWithBadChecksumEqualsEleven()
    {
        $validator = new Validator;

        $this->assertTrue(is_object($validator));

        try {
            $valid = $validator->validate(1000000060);
        } catch (InvalidNumberException $e) {
            return false;
        }
    }

    public function testValidNumberWithSpaces()
    {
        $validator = new Validator;

        $this->assertTrue(is_object($validator));

        try {
            $valid = $validator->validate("401 023 2137");
        } catch (InvalidNumberException $e) {
            return false;
        }

        $this->assertEquals(4010232137, $valid);
    }

    public function testValidNumberWithNonAlphaNumeric()
    {
        $validator = new Validator;

        $this->assertTrue(is_object($validator));

        try {
            $valid = $validator->validate("401-023-2137");
        } catch (InvalidNumberException $e) {
            return false;
        }

        $this->assertEquals(4010232137, $valid);
    }
}
