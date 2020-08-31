<?php


$email = $_POST['email'];
$password = $_POST['password'];

$users = [];

if (file_exists('users.json')) {
    $users = json_decode(file_get_contents('users.json') ,true);
}

$salt = getRandomSalt();

$users[] = [
    'email' => $email,
    'salt' => $salt,
    'password' => md5($salt . $password . $salt)
];

file_put_contents('users.json', json_encode($users));