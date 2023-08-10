<?php
declare(strict_types=1);

require_once 'public/controllers/AuthController.php';

session_start();

try {
    $authController = new AuthController();
    if (empty($_POST)) {
        $authController->showLoginForm();
    } else {
        $authController->login($_POST['username'], $_POST['password']);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
