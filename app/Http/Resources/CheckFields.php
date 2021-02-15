<?php


namespace App\Http\Resources;


trait CheckFields
{
    protected $requested_fields = [];
    protected $param_name = '';

    protected function setParamName($param_name)
    {
        $this->param_name = $param_name;
    }

    protected function checkField(string $field_name)
    {
        if(!request()->get($this->param_name))
        {
            return true;
        }

        return in_array($field_name, $this->getRequestedFields());
    }

    protected function getRequestedFields()
    {
        if(!empty($this->requested_fields))
        {
            return $this->requested_fields;
        }

        $this->requested_fields = explode(',', request()->get($this->param_name));
        return $this->requested_fields;
    }
}
