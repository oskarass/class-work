<?php

require_once ('functions/form/core.php');
require_once ('functions/form/validators.php');
require_once ('functions/html.php');
require_once ('functions/file.php');


var_dump($_COOKIE);
function form_success(&$form, $input) {
    $form['message'] = 'Form success';
    unset($input['pass_repeat']);
    $file = 'data/db.txt';
    $array = file_to_array($file);
    $array[] = $input;
    array_to_file($array, $file);
    $user_id = $_COOKIE['user_id'] ?? uniqid();
    setcookie('user_id', $user_id, time() + 3600, '/');
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
                'validate_is_space',
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
$decoded_array = file_to_array($file);

?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php if(!isset($_COOKIE['user_id'])) :?>
            <?php require('templates/form.tpl.php'); ?>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <td>Username</td>
                    <td>Password</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($decoded_array as $input_data => $row): ?>
                <tr>
                    <?php foreach($row as $value): ?>
                        <td><?php print $value; ?></td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
