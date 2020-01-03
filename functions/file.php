<?php

function array_to_file($array, $file)
{
    $file = 'data/db.txt';
    $string = json_encode(($array));
    $bits_written = file_put_contents($file, $string);
    if ($bits_written !== false) {
        return true;
    } else {
        return false;
    }
}

function file_to_array($file) {
    $file = 'data/db.txt';
    if(file_exists($file)) {
        $content = file_get_contents($file);
        $array = json_decode($content, true);
        return $array;
    } else {
        return false;
    }
}