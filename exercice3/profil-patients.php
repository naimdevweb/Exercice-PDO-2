<?php
require_once '../utils/connect-db.php';
$id = $_GET["lIdDuPatient"];
// echo $id;
$sql = "SELECT appointments.id, appointments.dateHour, patients.lastname, patients.firstname, patients.birthdate,
patients.phone, patients.mail
FROM appointments
INNER JOIN patients ON patients.id = appointments.idPatients
WHERE patients.id = {$id}";

if (
    !isset(
        $_POST['firstName'],
        $_POST['lastName'],
        $_POST['birthdate'],
        $_POST['phone'],
        $_POST['mail'],
        $_POST['dateHour']
    )
) {
    echo ("Aucun rdv na etait pris pour ce patients");
    return;
}

try {
    $stmt = $pdo->query($sql);
    $users = $stmt->fetch(PDO::FETCH_ASSOC); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat
} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
<h1>Information sur le patient :</h1>

<?php
// foreach ($users as $user) {
?>
<ol>
    <li>Nom du patient : <?= $users['lastname'] ?> </li>
    <li>Prénom du patient : <?= $users['firstname'] ?> </li>
    <li>Date de naissance : <?= $users['birthdate'] ?> </li>
    <li>Téléphone : <?= $users['phone'] ?> </li>
    <li>Email : <?= $users['mail'] ?> </li>
    <li>Heure et date du rendez-vous : <?= $users['dateHour'] ?> </li>
</ol>


<br>

<?php 

?>


    </ol>
   

</body>
</html>