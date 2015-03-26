<?php

//PHP EXAMPLES FROM GitHub by Roma Lapin



// Удаление записей в таблице
if (!empty($_GET['id'])) {
    $stmt = $pdo->prepare(
        "DELETE FROM products WHERE id = :id"
    );
    $stmt->execute([
        ':id' => $_GET['id']
    ]);
}
header("Location: index.php");