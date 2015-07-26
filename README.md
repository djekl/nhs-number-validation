NHS Number Validation
========

[![Build Status](https://travis-ci.org/djekl/nhs-number-validation.svg)](https://travis-ci.org/djekl/nhs-number-validation)
[![Total Downloads](https://poser.pugx.org/djekl/nhs-number-validation/d/total.svg)](https://packagist.org/packages/djekl/nhs-number-validation)
[![Version](https://poser.pugx.org/djekl/nhs-number-validation/version.svg)](https://packagist.org/packages/djekl/nhs-number-validation)
[![License](https://poser.pugx.org/djekl/nhs-number-validation/license.svg)](https://packagist.org/packages/djekl/nhs-number-validation)

A simple PHP class to validate a NHS Number and return a correctly formatted version.

## Requirements
 - PHP >= 5.3.3

## Example

```php
<?php

// include the autoloader
include __DIR__ . '/vendor/autoload.php';

// setup our validator
$nhsValidator = new \djekl\NHSNumberValidation\Validator;

// start with our test NHS number (usually taken via user input)
$nhs_no = '401 023 2137';

try {
    $valid_nhs_no = $nhsValidator->valdate($nhs_no);
} catch (\djekl\NHSNumberValidation\InvalidNumberException $e) {
    die($e->getMessage() . PHP_EOL);
}

if (!empty($valid_nhs_no)) {
    print "YAY! {$valid_nhs_no} is a valid NHS Number\r\n";
}
```
