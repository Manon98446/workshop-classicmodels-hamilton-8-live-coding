<?php
declare(strict_types=1);

require 'public/controllers/AuthController.php';

session_start();

try {
    $authController = new AuthController();

    if (empty($_POST)) {
        $authController->showRegistrationForm();
    } else {
        $authController->register($_POST['username'], $_POST['email'], $_POST['password']);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

