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