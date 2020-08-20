<?php

namespace Core\Validators;

use Core\Validators\Custom_validator;

class RequiredValidator extends Custom_validator
{
    public function runValidation()
    {
        $value = $this->_model->{$this->field};
        $passes = (!empty($value));

        return $passes;
    }
}
