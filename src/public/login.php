<?php
declare(strict_types=1);

require_once 'public/db/Database.php';

session_start();

try {
    if (empty($_POST)) {
        // 1 - Afficher le formulaire
        include 'public/views/layout/header.view.php';
        include 'public/views/login.view.php';
        include 'public/views/layout/footer.view.php';
    } else {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            throw new Exception('Formulaire non complet');
        }

        $username = htmlspecialchars($_POST['username']);

        $db = new Database();
        $stmt = $db->query(
            "SELECT * FROM users WHERE username = ?",
            [$_POST['username']]
        );

        $user = $stmt->fetch();

        if (empty($user)) {
            throw new Exception('Mauvais nom d\'utilisateur');
        }

        if (password_verify($_POST['password'], $user['password']) === false) {
            throw new Exception('Mauvais mot de passe');
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $username,
            'email' => $user['email']
        ];

        // Redirect to home page
        http_response_code(302);
        header('location: index.php');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
