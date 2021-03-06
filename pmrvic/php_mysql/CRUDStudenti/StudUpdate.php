<?php
require_once 'dbconnect.php';

// kada se ispunjena forma potvrdi (submita) 
if (isset($_POST['uredi'])) {
  $updated_at = (new DateTime())->format('Y-m-d H:i:s');
  $stmt = $conn->prepare("UPDATE `fakultet`.`stud` SET "
      . "  `imeStud`=?"
      . ", `prezStud`=?"
      . ", `pbrRod`=?"
      . ", `pbrStan`=?"
      . ", `datRodStud`=?"
      . ", `jmbgStud`=?"
      . ", `updated_at`=?  "
      . "WHERE  `mbrStud`=?");
  $stmt->bind_param("ssiisssi"
      , $_POST['imeStud']
      , $_POST['prezStud']
      , $_POST['pbrRod']
      , $_POST['pbrStan']
      , $_POST['datRodStud']
      , $_POST['jmbgStud']
      , $updated_at
      , $_POST['mbrStud']);

  if (false === $stmt) {
    die('prepare() failed: ' . $mysqli->error);
  }

  $validate = TRUE;

  if (strlen($_POST['imeStud']) < 3) {
    $validate = FALSE;
    echo "<span style='color:red'>Broj znakova imena mora biti veći od 3</span><hr>";
  }
  if (strlen($_POST['prezStud']) < 3) {
    $validate = FALSE;
    echo "<span style='color:red'>Broj znakova prezimena mora biti veći od 3</span><hr>";
  }
  if (isset($_POST['uredi'])&& filter_var($_POST['emailStud'], FILTER_VALIDATE_EMAIL)) {
    $validate = FALSE;
    echo "<span style='color:red'>(PHPvalidation:) Email adresa nije ispravna</span><hr>";
  }
  if ($validate == TRUE) {
    if ($stmt->execute()) {
      echo "Uspješno smo uredili studenta<br>";
    } else {
      echo "Dogodila se greška kod uređivanja<br>";
      echo "<span style='color:red'>" . $stmt->error . "</span><hr>";
    }
  }
}

// za ispis zadnjih 10 studenata
$query = "SELECT * FROM stud ORDER BY mbrStud DESC LIMIT 10";
$result = $conn->query($query);

// za ispis postanskih brojeva i mjesta
$query = "SELECT pbr, nazMjesto FROM mjesto ORDER BY nazMjesto ASC";
$resultMjesto = $conn->query($query);

// za popunjavanje forme
if (isset($_GET['mbrStud'])) {
  $query = "SELECT * FROM stud WHERE mbrStud ";
  $result1 = $conn->query($query);
  $stmt = $stmt = $conn->prepare("SELECT imeStud,prezStud,pbrRod,pbrStan,datRodStud,jmbgStud FROM stud WHERE mbrStud =?");
  $stmt->bind_param("i", $_GET['mbrStud']);
  $stmt->execute();
  $stmt->bind_result($imeStud, $prezStud, $pbrRod, $pbrStan, $datRodStud, $jmbgStud);
  $stmt->fetch();
}
?>
<!DOCTYPE html>
<!-- 
C-reate
R-ead
U-pdate
D-elete
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div><span></span>
            <form action="" method="post">
                <input type="hidden" name="mbrStud" value="<?php echo $_GET['mbrStud']; ?>">
                <table cellpadding="0">
                    <thead>
                        <tr>
                            <th colspan="2"> Uredi studenta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label for="imeStud">Ime studenta:</label></td>
                            <td><input type="text" name="imeStud" required="TRUE"  pattern=".{3,}" title="Ime studenta mora biti minimalno 3 znaka" value="<?= $imeStud ?>"></td> 
                        </tr>
                        <tr>
                            <td><label for="prezStud">Prezime studenta:</label></td>
                            <td><input type="text" name="prezStud" required="TRUE"  pattern=".{3,}" title="Prezime studenta mora biti minimalno 3 znaka" value="<?= $prezStud ?>"></td> 
                        </tr>
                         <tr>
                            <td><label for="emailStud">email studenta:</label></td>
                            <td><input type="email" name="emailStud" required="TRUE" title="Email adresa mora biti ispravna" value=""></td> 
                        </tr>
                        </tr>
                        <?php
      $data = array();
      while ($mjesto = $resultMjesto->fetch_assoc()) {
            $data[$mjesto['pbr']]=$mjesto['nazMjesto'];
      }
      $adresaPbrRod=$data[$pbrRod];
      $adresaPbrStan=$data[$pbrStan];
       
      ?>
                        <tr>
                            <td><label for="pbrRod">Adresa prebivališta:</label></td>
                            <td><select name="pbrRod">
                                    <option value="<?= $pbrRod ?>"><?= $adresaPbrRod ?></option>
<?php
mysqli_data_seek($resultMjesto, 0);   
      while ($mjesto = $resultMjesto->fetch_assoc()) {
printf("<option value='%d'>%s</option>",$mjesto['pbr'],$mjesto['nazMjesto'] );
      }
        ?>
                              
                                </select></td> 
                        </tr>                        
                        <tr>
                            <td><label for="pbrStan">Adresa stanovanja:</label></td>
                            <td><select name="pbrStan">
                                    <option value="<?= $pbrStan ?>"><?= $adresaPbrStan ?></option>
<?php
mysqli_data_seek($resultMjesto, 0);      
while ($mjesto = $resultMjesto->fetch_assoc()) {
printf("<option value='%d'>%s</option>",$mjesto['pbr'],$mjesto['nazMjesto'] );
      }
        ?>
                                </select></td> 
                        </tr>                         
                        <tr>
                            <td><label for="datRodStud">Datum rođenja:</label></td>
                            <td><input type="date" name="datRodStud"  value="<?php echo substr($datRodStud, 0, 10) ?>"></td> 
                        </tr> 
                        <tr>
                            <td><label for="jmbgStud">JMBG:</label></td>
                            <td><input type="text" required  pattern=".{13}" title="JMBG mora imati 13 znamenaka" name="jmbgStud"  value="<?= $jmbgStud ?>"></td> 
                        </tr>   
                        <tr><td colspan="2"><input type="submit" name="uredi" value="Uredi studenta"></td></tr>
                    </tbody>


                </table>



            </form>

            <h3>Student sa najvise polozenih ispita</h3>
            <a href="studShow.php?mbrStud=1173">Gordan Boršić</a>
            
            <ul>
                <?php
                while ($stud = $result->fetch_assoc()) {

                  echo "<li>"
                  . $stud['mbrStud']
                  . " ,"
                  . $stud['imeStud']
                  . " ,"
                  . $stud['datRodStud']
                  . " prebivalište:"
                  . $stud['pbrRod']
                  . " studira u:"
                  . $stud['pbrStan']
                  . " JMBG:"
                  . $stud['jmbgStud']
                  . "&nbsp;<a href='?mbrStud=" . $stud['mbrStud'] . "'>edit</a>" 
                  . "&nbsp;<a href='studShow.php?mbrStud=" . $stud['mbrStud'] . "'>show</a>"    
                  . "&nbsp;<form name='del_".$stud['mbrStud']."' style='display: inline-block' action='studDelete.php' method='post'>"
                  . "<input type='hidden' name='deleted' value='TRUE'>"
                  . "<input type='hidden' name='mbrStud' value='".$stud['mbrStud']."'>"
                   . "&nbsp;<a href='#' onClick='document.forms[\"del_".$stud['mbrStud']."\"].submit();'>delete</a>"   
                      . "</form>"
                      . "</li>";
                }
                ?>
            </ul>







        </div>
    </body>
</html>
