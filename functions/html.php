<?php

function html_attr($attr)
{
    $attributes = [];
    foreach ($attr as $attr_index => $attr_value) {
        $attribute = "$attr_index=\"$attr_value\"";
        $attributes[] = $attribute;
    }
    $attributes_string = implode(' ', $attributes);
    return $attributes_string;
}

function prepare_table($array)
{
    $db_table = [];

    if (!empty($array)) {

        foreach ($array as $values) {
            $compare = $compare ?? array_keys($values);
            if (array_keys($values) !== $compare) {
                return false;
            }
        }

        $db_table['thead'] = $compare;
        $db_table['tbody'] = $array;
    }

    return $db_table;
}