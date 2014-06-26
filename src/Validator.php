<?php
namespace CloudDataService\NHSNumberValidation;

class Validator
{
    public function validate($nhs_no = '')
    {
        // save the input number for the exception
        $input_nhs_no = $nhs_no;

        // stip all non alpha numeric
        $nhs_no = preg_replace("/[^0-9]/ui", "", $input_nhs_no);

        // check the length
        if (strlen($nhs_no) <> 10) {
            throw new InvalidNumberException("NHS number should be exactly 10 digits long ({$input_nhs_no})");
        }

        // explode the string into an array
        $nhs_no = str_split($nhs_no);

        // get our checksum val from the input
        $nhs_checksum = (int)array_pop($nhs_no);

        // set an empty checksum
        $checksum = 0;

        // now we have to do the math...
        foreach ($nhs_no as $key => $value) {
            $checksum += (int)$value * (10 - (int)$key);
        }

        // divide the checksum by 11
        $checksum = $checksum % 11;

        // remove 11 from the checksum
        $checksum = 11 - $checksum;

        // if the checksum is 10 then its invalid
        if ($checksum === 10) {
            throw new InvalidNumberException("Bad NHS number ({$input_nhs_no})");
        }

        // if the checksum is 11, then set it to 0
        if ($checksum === 11) {
            $checksum = 0;
        }

        // if the checksum matches the nhs_checksum then were valid
        if ($checksum <> $nhs_checksum) {
            throw new InvalidNumberException("Bad NHS number ({$input_nhs_no})");
        }

        // we have a valid NHS number (mathmatically)
        return preg_replace("/[^0-9]/ui", "", $input_nhs_no);
    }
}
