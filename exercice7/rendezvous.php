<?php
require_once '../utils/connect-db.php';
$id = $_GET["lIdDuRdv"];

// Récupération du rendez-vous
$sql = "SELECT idPatients, dateHour, id FROM appointments WHERE id = '{$id}';";
try {
    $stmt = $pdo->query($sql);
    $users = $stmt->fetch(PDO::FETCH_ASSOC); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat
} catch (PDOException $error) {
    echo "Erreur lors de la requête : " . $error->getMessage();
}

// Récupération des patients
$patient = "SELECT lastname, id FROM patients;";
try {
    $stmt = $pdo->query($patient);
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch patient details
} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Rendez-vous</title>

    <style>
        a {
            text-decoration: none; 
            color: white; 
            background-color: #007bff; 
            padding: 15px 30px; 
            border-radius: 5px; 
            font-size: 18px; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
            transition: background-color 0.3s, transform 0.3s; 
        }

        a:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }
    </style>
</head>
<body>

    <h1>Information sur le patient :</h1>

    <ol>
        <li>ID du patient : <?= $users['idPatients'] ?></li>
        <li>Heure et date du rdv : <?= $users['dateHour'] ?></li>
    </ol>

    <a href="../exercice8/modifrdv.php?lIdDuRdv=<?= $users['id'] ?>">Modifier le rdv</a>

    <div class="container">
        <h1>Modifier le Rendez-vous</h1>

        <!-- Formulaire de modification du rendez-vous -->
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $users['idPatients'] ?>">

            <!-- Liste des patients -->
            <label for="patient">Choisir le patient :</label>
            <select name="patient" id="patient" required>
                <?php
                // Boucle pour afficher les patients dans un menu déroulant
                foreach ($patients as $patient) {
                    echo '<option value="' . $patient["id"] . '">' . htmlspecialchars($patient["lastname"]) . '</option>';
                }
                ?>
            </select><br>

            <!-- Champ pour la date et l'heure -->
            <label for="dateHour">Date et Heure :</label>
            <input type="datetime-local" id="dateHour" name="dateHour" value="<?= $users['dateHour'] ?>" required><br> 

            <input type="submit" value="Sauvegarder les modifications">
        </form>
    </div>

</body>
</html>
