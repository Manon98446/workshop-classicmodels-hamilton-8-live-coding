<?php
declare(strict_types=1);

session_start();

try {
    // 1 - Connexion à la DB
    require_once 'public/db/Database.php';
    $db = new Database();

    // 2 - Requête SQL pour récupérer la liste des produits

    $stmt = $db->query(
        "SELECT * FROM products LIMIT 20"
    );
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 3 - Affichage de la liste des produits
    include 'public/views/layout/header.view.php';
    include 'public/views/index.view.php';
    include 'public/views/layout/footer.view.php';
} catch (Exception $e) {
    print_r($e->getMessage());
}
