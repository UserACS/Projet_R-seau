<?php
include 'config.php';

// Récupérer tous les employés
$stmt = $pdo->query("SELECT * FROM employees ORDER BY created_at DESC");
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Employés</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #ADD8E6; #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            background: white;
            padding: 20px;
            margin-top: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #0056b3;
            font-weight: bold;
        }
        .table {
            margin-top: 20px;
        }
        .table th {
            background-color: #0056b3;
            color: white;
            text-align: center;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-primary {
            background-color: #0056b3;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-warning:hover, .btn-danger:hover {
            opacity: 0.8;
        }
    </style>

</head>
<body>
    <div class="container">
        <h2 class="mt-4">Liste des Employés</h2>
        <a href="add_employee.php" class="btn btn-primary mb-3">Ajouter un Employé</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Poste</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $emp) : ?>
                    <tr>
                        <td><?= $emp['id'] ?></td>
                        <td><?= $emp['first_name'] . " " . $emp['last_name'] ?></td>
                        <td><?= $emp['email'] ?></td>
                        <td><?= $emp['phone'] ?></td>
                        <td><?= $emp['job_title'] ?></td>
                        <td>
                            <a href="edit_employee.php?id=<?= $emp['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="delete_employee.php?id=<?= $emp['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
