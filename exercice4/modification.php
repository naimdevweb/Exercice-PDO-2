
<?php
require_once '../utils/connect-db.php';

// Vérifie si l'ID du patient est passé dans l'URL
if (isset($_GET['lIdDuPatient'])) {
    $id = $_GET['lIdDuPatient'];

    // Récupérer les informations du patient actuel
    $sql = "SELECT id, lastName, firstName, phone, mail, birthdate FROM patients WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si le formulaire est soumis, mettre à jour les informations du patient
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupérer les données du formulaire
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $phone = $_POST['phone'];
        $mail = $_POST['mail'];
        $birthdate = $_POST['birthdate'];

        // Mettre à jour les informations du patient dans la base de données
        $updateSql = "UPDATE patients SET lastName = ?, firstName = ?, phone = ?, mail = ?, birthdate = ? WHERE id = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$lastName, $firstName, $phone, $mail, $birthdate, $id]);

    
        echo '<div class="message success">Les informations du patient ont été mises à jour avec succès.</div>';
      }
      } else {
      
      echo '<div class="message error">ID du patient non fourni.</div>';
      }
      ?>
       




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Patient</title>
    <style>
       .message {
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            text-align: center;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .submit-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .submit-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>



<div class="container">

    <h1>Modifier les informations du patient</h1>
    <form method="POST">
        <div class="form-group">
            <label for="lastName">Nom :</label>
            <input type="text" id="lastName" name="lastName" placeholder="Entrez le nom" required>
        </div>

        <div class="form-group">
            <label for="firstName">Prénom :</label>
            <input type="text" id="firstName" name="firstName" placeholder="Entrez le prénom" required>
        </div>

        <div class="form-group">
            <label for="phone">Téléphone :</label>
            <input type="text" id="phone" name="phone" placeholder="Entrez le téléphone" required>
        </div>

        <div class="form-group">
            <label for="mail">Email :</label>
            <input type="email" id="mail" name="mail" placeholder="Entrez l'email" required>
        </div>

        <div class="form-group">
            <label for="birthdate">Date de naissance :</label>
            <input type="date" id="birthdate" name="birthdate" required>
        </div>

        <button type="submit" class="submit-btn">Mettre à jour</button>
    </form>
</div>

</body>
</html>
