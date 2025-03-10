<?php
require 'config.php'; // Fichier de connexion à la base de données

// Récupérer la liste des documents
try {
    $stmt = $pdo->query("SELECT documents.id, filename, file_path, employees.first_name, employees.last_name, uploaded_at FROM documents LEFT JOIN employees ON documents.uploaded_by = employees.id ORDER BY uploaded_at DESC");
    $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Documents</title>
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
    <div class="container mt-5">
        <h2 class="mb-4">Liste des Documents</h2>
        <a href="add_document.php" class="btn btn-primary mb-3">Ajouter un Document</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du fichier</th>
                    <th>Ajouté par</th>
                    <th>Date d'upload</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $doc) : ?>
                    <tr>
                        <td><?= htmlspecialchars($doc['id']) ?></td>
                        <td><a href="<?= htmlspecialchars($doc['file_path']) ?>" target="_blank"> <?= htmlspecialchars($doc['filename']) ?> </a></td>
                        <td><?= htmlspecialchars($doc['first_name'] . ' ' . $doc['last_name']) ?></td>
                        <td><?= htmlspecialchars($doc['uploaded_at']) ?></td>
                        <td>
                            <a href="modifier_document.php?id=<?= $doc['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="supprimer_document.php?id=<?= $doc['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

