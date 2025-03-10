<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartTech - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #0073e6, #00c6ff);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .btn-custom {
            width: 200px;
            padding: 12px;
            font-size: 18px;
            margin: 10px;
            border-radius: 25px;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Bienvenue sur la plateforme SmartTech</h1>
        <div>
            <a href="clients.php" class="btn btn-light btn-custom">Gestion Clients</a>
            <a href="employees.php" class="btn btn-light btn-custom">Gestion Employés</a>
            <a href="documents.php" class="btn btn-light btn-custom">Gestion Documents</a>
        </div>
    </div>
</body>
</html>
