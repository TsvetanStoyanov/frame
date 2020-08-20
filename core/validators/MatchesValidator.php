<?php

namespace Core\Validators;

use Core\Validators\Custom_validator;

class MatchesValidator extends Custom_validator
{

    function runValidation()
    {
        $value = $this->_model->{$this->field};
        return $value == $this->rule;
    }
}
