<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <title>DATA</title>
</head>
<body><center>
<h1>St. Anthony's Church</h1><br/>
<h2>Delete an Existing Family</h2><br/>

<form action="DeleteData.php" method="GET">
    <input type="text" name="Reg_No" placeholder="Registration Number">
    <input type="submit" name="get" value="Get"><br/><br/>
</form>




<?php
    $pdo = new PDO('sqlite:DB.sqlite');
    
    if (isset($_GET['get'])) {
        try{
            $regNo = $_GET['Reg_No'];
            //echo($regNo);
            $sql = $pdo->query("SELECT * FROM Family WHERE Reg_No='$regNo';");
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            if($result == null){
                throw new Exception();
            }
            echo('<form action="DeleteData.php" method="GET">');
            echo("Registration Number: " . ' <input type="text" name="Reg_No" readonly value='. $result[0]['Reg_No'] .'><br/>');
            echo("Zone: " . $result[0]['Zone']. '<br/>');
            echo("Address: " . $result[0]['Address'].'<br/>');
            echo("Telephone Numbers: " . $result[0]['Telephone_Nos'] .'<br/>');
            echo('<input type="submit" name="delete_t" value="Delete This Family"></form><br/><br/>');

            $sql2 = $pdo->query("SELECT * FROM Member WHERE Reg_No='$regNo';");
            $result2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result2 as $row) {
                echo('<form action="DeleteData.php" method="GET">');
                echo("Registration Number: " . ' <input type="text" name="Reg_No" readonly value='. $result[0]['Reg_No'] .'><br/>');
                $name = explode(" ",$row['Name']);
                echo ("Full Name: " . ' <input type="text" name="Name" readonly value=' . implode("_", $name) . ">"
                    . "<br/>Relation: " . $row['Relation'] 
                    . "<br/>Date Of Birth: " . $row['Date_Of_Birth'] 
                    . "<br/>DATE OF BAPTISM: " . $row['Date_Of_Baptism']
                    . "<br/>DATE OF HOLY COMMUNION: " . $row['Date_Of_Holy_Communion']
                    . "<br/>DATE OF CONFORMATION: " . $row['Date_Of_Conformation']
                    . "<br/>DATE OF MARRIAGE: " . $row['Date_Of_Marriage'] 
                    . "<br/>STILL ALIVE or NOT: " . $row['Alive_Status'] 
                    . "<br/>"
                );
                echo('<input type="submit" name="delete" value="Delete This Family Member"></form><br/><br/>');
            }
            
            // echo("<br/><br/><br/><br/><br/><br/><br/><br/><br/>");
            // print_r($result);
            // echo("<br/><br/>");
            // print_r($result2);
        }
        catch(Exception $e){
            echo("Please Check the Registration Number<br/><br/>");
        }
        
    }

    if (isset($_GET['delete_t'])) {
        
        $regNo = $_GET['Reg_No'];
        $sql = $pdo->prepare('DELETE FROM Family WHERE Reg_No=?;');
        $sql->execute([$regNo]);
        $sql2 = $pdo->prepare('DELETE FROM Member WHERE Reg_No=?;');
        $sql2->execute([$regNo]);
        echo("Data Deleted Successfully<br/><br/>");
    }
    if (isset($_GET['delete'])) {
        $regNo = $_GET['Reg_No'];
        $Name = implode(" ", explode("_", $_GET['Name']));
        
        $sql = $pdo->prepare('DELETE FROM Member WHERE Reg_No=? AND Name=?;');
        $sql->execute([$regNo, $Name]);
        
        echo("Registration Number: ".$regNo."<br/>Name: ".$Name."</br>");
        echo("Data Deleted Successfully<br/><br/>");
    }
    $pdo=null;
?>
<a href="index.php">Main Menu</a><br/><br/>
</center>
</body>
</html>