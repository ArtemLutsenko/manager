<?php
class FilterArraysBehavior extends CModelBehavior
{
    public function filterArrays($value)
    {
        is_array($value) && $value = null;
        return $value;
    }

    public function beforeValidate($event)
    {
        $validator = new CFilterValidator();
        $validator->attributes = array_keys($this->owner->attributes);
        $validator->filter = array($this, 'filterArrays');
        $this->owner->validatorList->add($validator);
    }
}