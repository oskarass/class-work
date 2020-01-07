<?php

require('bootloader.php');

require_once ('functions/form/validators.php');

if(isset($_SESSION['username'])) {
    header('location:index.php');
}

function form_success(&$form, $input) {
    session_start();
    $_SESSION['username'] = $input['name'];
    $_SESSION['password'] = $input['password'];
    $_SESSION['user_id'] = $_SESSION['user_id'] ?? uniqid();
    header('location:index.php');
}

function form_fail(&$form, $input) {
    $form['message'] = 'Username or password do not match!';
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
        'validate_login'
    ],
    'fields' => [
        'name' => [
            'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'label' => 'Username',
            'type' => 'select',
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
                'validate_field_not_empty',
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
    ],
    'buttons' => [
        'save' => [
            'title' => 'Login',
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

$decoded_array = file_to_array(DB_FILE);

$show_form = isset($_SESSION['user_id']) ? true : false;

?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php if(!$show_form): ?>
            <?php require('templates/form.tpl.php'); ?>
        <?php endif; ?>
    </body>
</html>