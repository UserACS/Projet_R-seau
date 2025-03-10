<?php
$host = "localhost";
$dbname = "smarttech_db";
$username = "admin_user"; // Remplace par ton utilisateur MySQL si différent
$password = "passer"; // Ajoute ton mot de passe MySQL si nécessaire

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
