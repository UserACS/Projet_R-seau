
<?php
include 'config.php';

// Activer le mode erreur pour voir les problèmes SQL
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérifier si un ID est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID du client manquant.");
}

$id = $_GET['id'];

// Récupérer les informations actuelles du client
$sql = "SELECT * FROM clients WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si le client existe
if (!$client) {
    die("Client introuvable.");
}

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"]; // Correction du champ "address"

    try {
        $sql = "UPDATE clients SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $phone, $address, $id]);

        // Redirection vers la liste des clients après modification
        header("Location: clients.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage(); // Affiche l'erreur SQL
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Modifier un Client</h2>
        <form method="post">
            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($client['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($client['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Téléphone</label>
                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($client['phone']) ?>">
            </div>
            <div class="mb-3">
                <label>Adresse</label>
                <textarea name="address" class="form-control"><?= htmlspecialchars($client['address']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="clients.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
