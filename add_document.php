<?php
// Connexion à la base de données
include 'config.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $uploaded_by = 1; // Remplace par l'ID de l'utilisateur connecté (peut venir d'une session)
    $upload_dir = "uploads/"; // Dossier où les fichiers seront stockés

    // Vérifier et créer le dossier si nécessaire
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $filename = basename($_FILES["file"]["name"]);
    $file_path = $upload_dir . $filename;

    // Vérifier si le fichier est bien uploadé
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
        // Insérer dans la base de données
        $sql = "INSERT INTO documents (filename, file_path, uploaded_by) VALUES (:filename, :file_path, :uploaded_by)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":filename" => $filename,
            ":file_path" => $file_path,
            ":uploaded_by" => $uploaded_by
        ]);
        echo "Fichier uploadé et enregistré avec succès.";
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 450px;">
            <h2 class="text-center text-primary">Uploader un Document</h2>
            <?= $message; ?>
            <form action="add_document.php" method="POST" enctype="multipart/form-data" class="mt-3">
                <div class="mb-3">
                    <label class="form-label">Sélectionnez un fichier :</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Uploader</button>
                <a href="documents.php" class="btn btn-secondary w-100 mt-2">Retour</a>
            </form>
        </div>
    </div>
</body>
</html>
