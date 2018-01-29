<?php
require_once 'dbconnect.php';

if(isset($_GET['mbrStud'])){
  $stmt = $conn->prepare("
    SELECT 
    imeStud
    ,prezStud
    ,pbrRod
    ,pbrStan
    ,datRodStud
    ,jmbgStud
    ,nazPred
    ,datIspit 
     FROM stud INNER JOIN ispit ON stud.mbrStud=ispit.`mbrStud`
INNER JOIN pred ON ispit.`sifPred`=pred.`sifPred` 
WHERE ocjena > 1 AND stud.mbrStud =?");
  $stmt->bind_param("i", $_GET['mbrStud']);
    if (false === $stmt) {
    die('prepare() failed: ' . $mysqli->error);
  }
  $stmt->execute();
  $stmt->bind_result($imeStud, $prezStud, $pbrRod, $pbrStan, $datRodStud, $jmbgStud,$nazPred,$datIspit);
 
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
            <div>
                <?php 
                 while($stmt->fetch()){
                   echo $imeStud." ".$prezStud;
                 }
                ?>
                
                <h1><?= $imeStud." ".$prezStud?></h1>
                Adresa: <?= $pbrRod?><br>
                Stanuje u : <?= $pbrStan?>
                Položio je:
                <?php 
                echo $nazPred." ".$datIspit;
                
                ?>
                
        </div>
    </body>
</html>


