<?php
include 'config.php';

// Récupérer tous les employés
$stmt = $pdo->query("SELECT * FROM clients ORDER BY created_at DESC");
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container mt-5">
        <h2>Liste des Clients</h2>
        <a href="add_client.php" class="btn btn-primary mb-3">Ajouter un Client</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $cls) : ?>
                    <tr>
                        <td><?= $cls['id'] ?></td>
                        <td><?= $cls['name']?></td>
                        <td><?= $cls['email'] ?></td>
                        <td><?= $cls['phone'] ?></td>
                        <td><?= $cls['address'] ?></td>
                        <td>
                            <a href="modifier_client.php?id=<?= $cls['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="supprimer_client.php?id=<?= $cls['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a> 
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</body>
</html>

