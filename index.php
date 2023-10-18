<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="./css/bootstrap.css">
	
    <script src="./js/bootstrap.js"></script>

</head>
<?php
include('mysql.php');
?>

<?php
if(isset($_POST['torles'])){
    $dwho=$_POST['kit'];

    $sql = "DELETE FROM buko WHERE `buko`.`ID` = '$dwho'";

    $stmt = $conn->prepare($sql);
//$stmt->bind_param("s", $valueToInsert); // "s" represents a string type
if ($stmt->execute()) {
//    echo "Törlés sikeres";
} else {
    echo "Error: " . $stmt->error;
}
}

?>




<body>
<div class=container>
 <a href="index.php">index</a>   
<?php
    if(isset($_POST['felvetel'])){
        $csapat = $_POST["textbox_value1"];
        $datum = $_POST["textbox_value2"];
        $buko = $_POST["textbox_value3"];
        //echo($datum."<br>");
        $sqlDatetime = date("Y-m-d H:i:s", strtotime($datum));
        //$datum = date("Y-m-d H:i:s", strtotime(str_replace('.', ' ', $datum)));


        $sql = "INSERT INTO `buko` (`id`, `csapat`, `Datum`, `buko`) 
        VALUES (NULL, '$csapat', '$sqlDatetime', '$buko');";

       $stmt = $conn->prepare($sql);
        //$stmt->bind_param("s", $valueToInsert); // "s" represents a string type
        if ($stmt->execute()) {
            echo "Data inserted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    }


    if(isset($_POST['modosit']))
    {
        $kit=$_POST['kit'];
        $csapat=$_POST['csapat'];
        $idopont=$_POST['idopont'];
        $penz=$_POST['penz'];
        $szorzo=$_POST['szorzo'];
        $tet=$_POST['tet'];

        if($szorzo>0){
        $ujtet=ceil($penz/$szorzo*100);
        $sql = "UPDATE `buko` SET `befizet` = '$ujtet' WHERE `buko`.`ID` = $kit; "; 
        echo($ujtet);}else{
            $penz=$penz+$tet;
            $sql="UPDATE `buko` SET `buko` = '$penz', `befizet` = '0' WHERE `buko`.`ID` = $kit;
            ";
        }

        $stmt = $conn->prepare($sql);
        //$stmt->bind_param("s", $valueToInsert); // "s" represents a string type
        if ($stmt->execute()) {
  //          echo "Data inserted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }



       
    }
    
    
?>
    
   <form method="post">
   Csapat:<input type="text" name="textbox_value1" placeholder="Enter a value" /></br>
   Dátum:<input type="text" name="textbox_value2" placeholder="Enter a value" /></br>   
   Bukó:<input type="text" name="textbox_value3" placeholder="Enter a value" /></br>
   <input type="submit" value="Felvétel" name="felvetel"/>

</form>

    <?php
    $sql = "SELECT * FROM `BUKO` ";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        echo "<table>"; 
        while ($row = $result->fetch_array()) {
            echo "<tr><form method=post><td>" . $row[0] . "</td><td><input type=text name=csapat value='" . $row[1] . "'></td><td><input type=text name=idopont value='" . $row[2] . "'></td><td><input type=text name=penz value=" . $row[3] . "></td><td><input type=text name=szorzo value=" . $row[4] . "></td><td><input type=text name=tet value=" . $row[5] . "></td><td><input type=hidden name=kit value=" . $row[0] . "><input type=submit value=modosit name=modosit></td></form><td><form method=post><input type=hidden name=kit value=" . $row[0] . "><input type=submit name=torles value=torles></form></td></tr>";
        }
    
        echo "</table>";
    } else {
        echo "No records found.";
    }


    ?>
</div>
</body>
</html>