<?php

namespace App\Providers;

use Illuminate\Validation\Validator;

class MyValidator extends Validator {

    public function validateDateOverlap($attribute, $value, $parameters)
    {
        if ($value > $this->getValue($parameters[0]) || $this->getValue($parameters[1]) < $this->getValue($parameters[2]))
        	return true;
        return false;
    }

}