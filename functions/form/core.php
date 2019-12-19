<?php

function get_filtered_input($form)
{
    $filter_params = [];
    foreach ($form['fields'] as $field_name => $field) {
        if (isset($field['filter'])) {
            $filter_params[$field_name] = $field['filter'];
        } else {
            $filter_params[$field_name] = FILTER_SANITIZE_FULL_SPECIAL_CHARS;
        }
    }
    return filter_input_array(INPUT_POST, $filter_params);
}

function validate_form(&$form, $input)
{
    $success = true;
    foreach ($form['fields'] as $field_index => &$field) {
        $field_value = $input[$field_index];
        $field['value'] = $field_value;
        if (isset($field['validators'])) {
            foreach ($field['validators'] as $validator) {
                $is_valid = $validator($field_value, $field);
                if (!$is_valid) {
                    $success = false;
                    break;
                }
            }
        }
    }
    if(isset($form['callbacks'])) {
        $cb_index = $success ? 'success' : 'fail';
        $function = $form['callbacks'][$cb_index] ?? false;
        if ($function) {
            $function($form, $input);
        }
    }
    return $success;
}