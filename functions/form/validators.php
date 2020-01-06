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

function validate_is_space($field_value, &$field) {
    if ($field_value == trim($field_value) && strpos($field_value, ' ') !== false) {
        return true;
    } else {
        $field['error'] = "Field must have a space";
        return false;
    }
}

function validate_field_range($field_value, &$field, $params) {
    if($field_value >= $params['min'] && $field_value <= $params['max']) {
        return true;
    } else {
        $field['error'] = "Age must be between 18 and 100";
        return false;
    }
}

function validate_string_length($field_value, &$field, $params) {
    if(strlen($field_value) > $params['min'] && strlen($field_value) < $params['max']) {
        return true;
    } else {
        $field['error'] = "Your name must be between 5 and 20 symbols";
        return false;
    }
}

function validate_password($field_value, &$field) {
    if(strlen($field_value) > 5) {
        return true;
    } else {
        $field['error'] = "Password must be at least 6 symbols";
        return false;
    }
}

function validate_fields_match($field_value, &$field, $params) {
    foreach ($params as $field_index){
        $compare = $compare ?? $field_value[$field_index];
        if($field_value[$field_index] !== $compare){
            $field['error'] = 'Passwords do not match!';
            return false;
        }
    }
    return true;
}

function validate_username($field_value, &$field) {
    $array = file_to_array(DB_FILE);
    foreach($array as $key => $value) {
        if($value['name'] === $field_value) {
            $field['error'] = 'User already exists!';
            return false;
        }
    }
    return true;
}