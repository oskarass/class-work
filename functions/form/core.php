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
            foreach ($field['validators'] as $index => $validator) {
                if (is_array($validator)) {
                    $is_valid = $index($field_value, $field, $validator);
                } else {
                    $is_valid = $validator($field_value, $field);
                }

                if (!$is_valid) {
                    $success = false;
                    break;
                }

            }
        }
    }

    foreach (($form['validators'] ?? []) as $validator_index => $validator) {
        $field_value = $input;
        if (is_array($validator)) {
            $function_name = $validator_index;
            $params = $validator;
            $is_valid = $function_name($field_value, $field, $params);
        } else {
            $is_valid = $validator($field_value, $field);
        }
        if (!$is_valid) {
            $success = false;
            break;
        }
    }

    if (isset($form['callbacks'])) {
        $cb_index = $success ? 'success' : 'fail';
        $function = $form['callbacks'][$cb_index] ?? false;
        if ($function) {
            $function($form, $input);
        }
    }

    return $success;

}

