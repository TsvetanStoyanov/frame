<?php

namespace Core\Validators;

use Core\Validators\Custom_validator;

class NumericValidator extends Custom_validator {

    public function runValidation()
    {
        $value = $this->_model->{$this->field};
        $pass = true;
        if (!empty($value)) {
            $pass = is_numeric($value);
        }
        return $pass;
    }
}