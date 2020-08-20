<?php

namespace Core\Validators;

use Core\Validators\Custom_validator;

class MinValidator extends Custom_validator
{
    public function runValidation()
    {
        $value = $this->_model->{$this->field};

        $pass = (strlen($value) >= $this->rule);

        return $pass;
    }
}
