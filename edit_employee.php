<?php
include 'config.php';

// Activer le mode erreur pour voir les problèmes SQL
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérifier si un ID est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de l'employé manquant.");
}

$id = $_GET['id'];

// Récupérer les informations actuelles du client
$sql = "SELECT * FROM employees WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si le client existe
if (!$employee) {
    die("Employé introuvable.");
}

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $job_title = $_POST["job_title"]; 

    try {
        $sql = "UPDATE employees SET first_name = ?, last_name = ?, email = ?, phone = ?, job_title = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$first_name, $last_name, $email, $phone, $job_title, $id]);

        // Redirection vers la liste des clients après modification
        header("Location: employees.php");
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
    <title>Modifier un Employé</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Modifier un Employé</h2>
        <form method="post">
            <div class="mb-3">
                <label>Prénom</label>
                <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($employee['first_name']) ?>" required>
            </div>
	    <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($employee['last_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($employee['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Téléphone</label>
                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($employee['phone']) ?>">
            </div>
            <div class="mb-3">
                <label>Poste</label>
                <input name="job_title" class="form-control" value="<?= htmlspecialchars($employee['job_title']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="employees.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>

