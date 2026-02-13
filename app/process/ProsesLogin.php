<?php

$username = 'admin';
$password = 'admin123';

$userPost = $_POST['username'];
$passPost = $_POST['password'];

if ($userPost == $username && $passPost == $password) {
    session_regenerate_id(true);
    $_SESSION['role'] = 'admin';

    header('Location: /admin/dashboard');
}
