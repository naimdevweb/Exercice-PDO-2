<?php


require_once '../utils/connect-db.php';

// Vérification si les données sont envoyées via POST
if (
    isset($_POST['lastName'], $_POST['firstName'], $_POST['birthdate'], 
          $_POST['phone'], $_POST['mail'], $_POST['dateHour'])
) {
    // Sécurisation des données envoyées via POST
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $birthdate = htmlspecialchars(trim($_POST['birthdate']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $mail = htmlspecialchars(trim($_POST['mail']));
    $dateHour = htmlspecialchars(trim($_POST['dateHour']));

    
    if (DateTime::createFromFormat('Y-m-d', $birthdate) === false) {
        echo "<p>La date de naissance est invalide.</p>";
        exit;
    }

 
    if (DateTime::createFromFormat('Y-m-d\TH:i', $dateHour) === false) {
        echo "<p>La date ou l'heure du rendez-vous est invalide.</p>";
        exit;
    }
    

    try {
        // 1. Insérer le patient dans la table patients
        $sqlPatient = "INSERT INTO patients (lastName, firstName, birthdate, phone, mail)
                       VALUES (:lastName, :firstName, :birthdate, :phone, :mail)";
        $stmtPatient = $pdo->prepare($sqlPatient);
        $stmtPatient->execute([
            ':lastName' => $lastName,
            ':firstName' => $firstName,
            ':birthdate' => $birthdate,
            ':phone' => $phone,
            ':mail' => $mail
        ]);

        // Récupérer l'ID du patient inséré
        $patientId = $pdo->lastInsertId();

        // 2. Insérer le rendez-vous dans la table appointments en associant le patient via l'ID
        $sqlAppointment = "INSERT INTO appointments (idPatients, dateHour)
                           VALUES (:idPatients, :dateHour)";
        $stmtAppointment = $pdo->prepare($sqlAppointment);
        $stmtAppointment->execute([
            ':idPatients' => $patientId,
            ':dateHour' => $dateHour
        ]);

        echo "<p>Patient et rendez-vous ajoutés avec succès !</p>";

    } catch (PDOException $e) {
        // Gestion des erreurs SQL
        echo "<p>Erreur lors de la requête : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
} else {
    // Si les données ne sont pas envoyées via POST ou si un champ est manquant
    echo "<p>Formulaire incomplet. Assurez-vous que tous les champs sont remplis.</p>";
}
?>








