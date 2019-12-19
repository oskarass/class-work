<?php

require_once ('functions/form/core.php');
require_once ('functions/form/validators.php');
require_once ('functions/html.php');

function form_success(&$form, $input) {
    $x = $input['x'];
    $y = $input['y'];
    $sum = $x + $y;
    var_dump($sum);
}

function form_fail(&$form, $input) {
    var_dump('Klaida');
}

$form = [
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ],
    'attr' => [
//        'action' => 'index.php',
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'login-form',
    ],
    'fields' => [
        'x' => [
            'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'label' => 'X value',
            'type' => 'select',
            'validators' => [
                'validate_field_not_empty',
                'validate_is_number'
            ],
            'option' => [
                'option_one',
                'option_two',
            ],
            'value' => '',
            'extra' => [
                'attr' => [
                    'placeholder' => 'number',
                ]
            ]
        ],
        'y' => [
            'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'label' => 'Y value',
            'type' => 'select',
            'validators' => [
                'validate_field_not_empty',
                'validate_is_number'
            ],
            'option' => [
                'option_one',
                'option_two',
            ],
            'value' => '',
            'extra' => [
                'attr' => [
                    'placeholder' => 'number',
                ]
            ]
        ]
    ],
    'buttons' => [
        'save' => [
            'title' => 'Submit',
            'extra' => [
                'attr' => [
                    'class' => 'save-btn',
                ]
            ]
        ]
    ],
];

if (!empty($_POST)) {
    $safe_input = get_filtered_input($form);
    $success = validate_form($form, $safe_input);
} else {
    $success = false;
}

?>

<html>
    <body>
        <?php if($success): ?>
            <h1>ZJBS</h1>
        <?php endif; ?>
        <?php require('templates/form.tpl.php'); ?>

    </body>
</html>