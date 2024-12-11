<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .footer {
            margin-top: 30px;
            font-size: 0.9rem;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Bienvenue sur la page d'accueil</h1>
        <p>Vous pouvez ajouter de nouveaux patients dans notre base de données en utilisant le lien ci-dessous.</p>
        <a href="ajout-patient.php" class="btn">Ajouter un patient</a>

        <div class="footer">
            <p>© 2024 Système de gestion des patients</p>
        </div>
    </div>

</body>
</html>
