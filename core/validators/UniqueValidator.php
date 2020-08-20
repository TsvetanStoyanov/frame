<?php

namespace Core\Validators;

use Core\Validators\Custom_validator;

class UniqueValidator extends Custom_validator
{
    public function runValidation()
    {
        $field = (is_array($this->field)) ? $this->field[0] : $this->field;
        $value = $this->_model->{$field};

        $contidions = ["{$field} = ?"];
        $bind = ["$value"];

        // check updating record
        if (!empty($this->_model->id)) {
            $contidions[] = "id != ?";
            $bind[] = $this->_model->id;
        }

        // this allows you to chek multiple fields for uique
        if (is_array($this->field)) {
            array_unshift($this->field);

            foreach ($this->field as $adds) {
                $contidions[] = "{$adds} = ?";
                $bind[] = $this->_model->{$adds};
            }
        }
        $queryParams = ['conditions' => $contidions, 'bind' => $bind];
        $other = $this->_model->find_first($queryParams);
        return (!$other);
    }
}
