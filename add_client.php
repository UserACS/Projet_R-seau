
<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $adress = $_POST["address"];

    $sql = "INSERT INTO clients (name, email, phone, address) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $phone, $adress]);

    header("Location: clients.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Ajouter un Client</h2>
        <form method="post">
            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Téléphone</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label>Adresse</label>
		<textarea name="address" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Ajouter</button>
            <a href="clients.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>




