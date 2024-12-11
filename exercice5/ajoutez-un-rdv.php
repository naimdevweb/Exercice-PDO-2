<?php

require_once '../utils/connect-db.php';
$patient = "SELECT lastname, id 
FROM patients;
";


try {
    $stmt = $pdo->query($patient);
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch patient details

} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}

if (
    isset(
        $_POST['idPatient'],
        $_POST['dateRendezvous'],
        $_POST['heureRendezvous']
       
    )
) {
    if (
        !empty($_POST['idPatient']) &&
        !empty($_POST['dateRendezvous']) &&
        !empty($_POST['heureRendezvous']) 
        
    ) {
        
        
        $patientId = htmlspecialchars(trim($_POST['idPatient']));
        $dateRendezvous = htmlspecialchars(trim($_POST['dateRendezvous']));
        $heureRendezvous = htmlspecialchars(trim($_POST['heureRendezvous']));
       
       
        $sql = "INSERT INTO appointments (idPatients, dateHour)
                VALUES (:idPatients, :dateHour)";

        try {
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':idPatients' => $patientId, 
                ':dateHour' => $dateRendezvous . ' ' . $heureRendezvous, 
            ]);

            echo "<p>Rendez-vous ajouté avec succès !</p>";
        } catch (PDOException $error) {
            echo "Erreur lors de la requête : " . $error->getMessage();
        }
    } else {
        echo "<p>Veuillez remplir tous les champs du formulaire.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Rendez-vous</title>
    <style>
        /* Style de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Style du formulaire */
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 15px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Lien vers la page index.php */
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 1.1rem;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Ajouter un Rendez-vous</h1>

    <form method="POST" action="">
    <label for="idPatient">Nom du patient</label>
        <select name="idPatient" id="idPatient">
    <?php
    foreach ($patients as $patient) {
        echo '<option value="' . $patient["id"] . '">' . $patient["lastname"] . '</option>';
    }
    ?>
</select>

        <label for="dateRendezvous">Date du Rendez-vous</label>
        <input type="date" id="dateRendezvous" name="dateRendezvous" required>

        <label for="heureRendezvous">Heure du Rendez-vous</label>
        <input type="time" id="heureRendezvous" name="heureRendezvous" required>


        <input type="submit" value="Ajouter Rendez-vous">
    </form>

   
</body>
</html>
