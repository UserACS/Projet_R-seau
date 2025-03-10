<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $job_title = $_POST["job_title"];

    $sql = "INSERT INTO employees (first_name, last_name, email, phone, job_title) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$first_name, $last_name, $email, $phone, $job_title]);

    header("Location: employees.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Employé</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Ajouter un Employé</h2>
        <form method="post">
            <div class="mb-3">
                <label>Prénom</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="last_name" class="form-control" required>
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
                <label>Poste</label>
                <input type="text" name="job_title" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Ajouter</button>
            <a href="employees.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
