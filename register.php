<?php

require('bootloader.php');

require_once ('functions/form/validators.php');

function form_success(&$form, $input) {
    $array = file_to_array(DB_FILE);
    $array[] = $input;
    array_to_file($array, DB_FILE);

    $_COOKIE['user_id'] = $_COOKIE['user_id'] ?? uniqid();
    setcookie('user_id', $_COOKIE['user_id'], time() + 3600, '/');
}

function form_fail(&$form, $input) {
    $form['message'] = 'Form failed';
}

$form = [
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ],
    'attr' => [
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'login-form',
    ],
    'validators' => [
        'validate_fields_match' => [
            'password', 'pass_repeat'
        ],
    ],
    'fields' => [
        'name' => [
            'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'label' => 'Username',
            'type' => 'select',
            'validators' => [
                'validate_field_not_empty',
                'validate_username',
                'validate_string_length' => [
                    'min' => 6,
                    'max' => 20,
                ]
            ],
            'option' => [
                'option_one',
                'option_two',
            ],
            'value' => '',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Username',
                    'class' => 'form-control',
                ]
            ]
        ],
        'password' => [
            'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'label' => 'Password',
            'type' => 'password',
            'validators' => [
                'validate_password',
            ],
            'option' => [
                'option_one',
                'option_two',
            ],
            'value' => '',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Password',
                    'class' => 'form-control',
                ]
            ]
        ],
        'pass_repeat' => [
            'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'label' => 'Repeat password',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
            ],
            'option' => [
                'option_one',
                'option_two',
            ],
            'value' => '',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Repeat password',
                    'class' => 'form-control',
                ]
            ]
        ]
    ],
    'buttons' => [
        'save' => [
            'title' => 'Ar as normalus?',
            'extra' => [
                'attr' => [
                    'class' => 'btn btn-success save-btn',
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

$file = 'data/db.txt';
$decoded_array = file_to_array(DB_FILE);

$h1 = 'Registracija sekminga';
$show_form = isset($_COOKIE['user_id']) ? true : false;

$table = !$show_form ? prepare_table(file_to_array(DB_FILE)) : null;

?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <?php if ($show_form): ?>
            <h1><?php print $h1; ?></h1>
        <?php else: ?>
            <?php require('templates/form.tpl.php'); ?>
        <?php endif; ?>
    </body>
</html>
