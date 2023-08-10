<?php
declare(strict_types=1);

session_start();

try {
    // 1 - Connexion à la DB
    require_once 'public/db/Database.php';

    // 2 - Récupérer le produit
    $db = new Database();

    $stmt = $db->query(
        "SELECT * FROM products WHERE productCode = ?",
        [$_GET['productCode']]
    );
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($product)) {
        echo '404 - no product found';
        die;
    }

    // 3 - Afficher la page
    include 'public/views/layout/header.view.php';
    include 'public/views/product.view.php';
    include 'public/views/layout/footer.view.php';

} catch (Exception $e) {
    print_r($e->getMessage());
}


