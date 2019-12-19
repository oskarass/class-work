<?php

function validate_field_not_empty($field_input, &$field)
{
    if (empty($field_input)) {
        $field['error'] = "Laukelis tuscias";
        return false;
    }
    return true;
}

function validate_is_number($field_value, &$field)
{
    if (!is_numeric($field_value)) {
        $field['error'] = 'Laukelis privalo buti skaicius';
        return false;
    }
    return true;
}


