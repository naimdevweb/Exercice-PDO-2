<?php
require_once '../utils/connect-db.php';

// Vérifie si l'ID du rendez-vous est passé dans l'URL
if (isset($_GET['lIdDuRdv'])) {
    $id = $_GET['lIdDuRdv'];

    // Récupérer les informations actuelles du rendez-vous
    $sql = "SELECT idPatients, dateHour FROM appointments WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si le formulaire est soumis, mettre à jour le rendez-vous
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupérer les données du formulaire
        $patientId = (int) $_POST['idPatients'];  // S'assurer que l'ID du patient est un entier
        $dateRendezvous = $_POST['dateHour'];  // Date au format 'YYYY-MM-DDTHH:MM'
// var_dump($patientId, $dateRendezvous, $id);
// die();
        

        // Mettre à jour le rendez-vous dans la base de données
        $updateSql = "UPDATE appointments SET idPatients = ?, dateHour = ? WHERE id = ?";
        $updateStmt = $pdo->prepare($updateSql);

        try {
            // Exécuter la mise à jour
            $updateStmt->execute([$patientId, $dateRendezvous, $id]);
            echo '<div class="message success">Le rendez-vous a été mis à jour avec succès.</div>';
        } catch (PDOException $e) {
            echo 'Erreur lors de la mise à jour : ' . $e->getMessage();
        }
    }
} else {
    echo '<div class="message error">ID du rendez-vous non fourni.</div>';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Rendez-vous</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"], input[type="datetime-local"] {
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .link {
            text-align: center;
            margin-top: 20px;
        }

        .link a {
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
        }

        .link a:hover {
            text-decoration: underline;
        }

        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Modifier le Rendez-vous</h1>

        <?php if (isset($appointment)): ?>
        <form method="POST">
            <label for="idPatients">ID du patient :</label>
            <input type="text" id="idPatients" name="idPatients" value="<?= htmlspecialchars($appointment['idPatients']) ?>" required>

            <label for="dateHour">Date et Heure :</label>
            <input type="datetime-local" id="dateHour" name="dateHour" value="<?= substr($appointment['dateHour'], 0, 16) ?>" required>

            <input type="submit" value="Sauvegarder les modifications">
        </form>
        <?php endif; ?>

        <div class="link">
            <a href="">Retour à la liste des rendez-vous</a>
        </div>
    </div>

</body>
</html>
