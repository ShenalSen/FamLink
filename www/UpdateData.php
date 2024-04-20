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
    <h2>Update an Existing Family</h2><br/>

<form action="UpdateData.php" method="GET">
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
            echo('<form action="UpdateData.php" method="GET">');
            echo("Registration Number: " . ' <input type="text" name="Reg_No" readonly value='. $result[0]['Reg_No'] .'><br/>');
            echo("Zone: " . ' <input type="text" name="Zone" value='. implode("_", explode(" ", $result[0]['Zone'])) .'><br/>');
            echo("Address: " . ' <input type="text" name="Address" value='. implode("_", explode(" ", $result[0]['Address'])) .'><br/>');
            echo("Telephone Numbers: " . ' <input type="text" name="Telephone_Nos" placeholder="Telephone Numbers" value='. implode("_", explode(" ", $result[0]['Telephone_Nos'])) .'><br/>');
            echo('<input type="submit" name="update_t" value="Update"></form><br/><hr/><br/>');

            $sql2 = $pdo->query("SELECT * FROM Member WHERE Reg_No='$regNo';");
            $result2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result2 as $row) {
                echo('<form action="UpdateData.php" method="GET">');
                echo("Registration Number: " . ' <input type="text" name="Reg_No" readonly value='. $result[0]['Reg_No'] .'><br/>');
                $name = explode(" ",$row['Name']);
                echo ("Full Name: " . ' <input type="text" name="Name" readonly value=' . implode("_", $name) . ">"
                    . "<br/>Relation: " . $row['Relation'] 
                    . "<br/><br/>Date Of Birth: " . $row['Date_Of_Birth'] 
                    . "<br/><br/>DATE OF BAPTISM: " . $row['Date_Of_Baptism'] . ' <input type="date" name="Date_Of_Baptism" value=' . $row['Date_Of_Baptism'] . ">"
                    . "<br/>DATE OF HOLY COMMUNION: " . $row['Date_Of_Holy_Communion'] . ' <input type="date" name="Date_Of_Holy_Communion" value=' . $row['Date_Of_Holy_Communion'] . ">"
                    . "<br/>DATE OF CONFORMATION: " . $row['Date_Of_Conformation'] . ' <input type="date" name="Date_Of_Conformation" value=' . $row['Date_Of_Conformation'] . ">"
                    . "<br/>DATE OF MARRIAGE: " . $row['Date_Of_Marriage'] . ' <input type="date" name="Date_Of_Marriage" value='. $row['Date_Of_Marriage'] .'>'
                    . "<br/>STILL ALIVE or NOT: " . $row['Alive_Status'] . ' <select name="Alive_Status" required>
                                                                                <option value="" disabled selected>Select</option>
                                                                                <option value="YES">Alive</option>
                                                                                <option value="NO">Not Alive</option>
                                                                            </select>'
                    . "<br/>"
                );
                echo('<input type="submit" name="update" value="Update"></form><br/><hr/><br/>');
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

    if (isset($_GET['update_t'])) {
        $Telephone_Nos = $_GET['Telephone_Nos'];
        $regNo = $_GET['Reg_No'];
        $Zone = implode(" ", explode("_", $_GET['Zone']));
        $Address = implode(" ", explode("_", $_GET['Address']));
        $sql = $pdo->prepare('UPDATE Family SET Zone=?, Address=?, Telephone_Nos=? WHERE Reg_No=?;');
        $sql->execute([$Zone, $Address, $Telephone_Nos, $regNo]);
        echo("Data Updated Successfully<br/><br/>");
    }
    if (isset($_GET['update'])) {
        $regNo = $_GET['Reg_No'];
        $Name = implode(" ", explode("_", $_GET['Name']));
        $Date_Of_Marriage = $_GET['Date_Of_Marriage'];
        $Date_Of_Baptism = $_GET['Date_Of_Baptism'];
        $Date_Of_Holy_Communion = $_GET['Date_Of_Holy_Communion'];
        $Date_Of_Conformation = $_GET['Date_Of_Conformation'];
        $Alive_Status = $_GET['Alive_Status'];
        
        
        $sql = $pdo->prepare('UPDATE Member SET Date_Of_Baptism=?, Date_Of_Holy_Communion=?, Date_Of_Conformation=?, Date_Of_Marriage=?, Alive_Status=? WHERE Reg_No=? AND Name=?;');
        $sql->execute([$Date_Of_Baptism, $Date_Of_Holy_Communion, $Date_Of_Conformation, $Date_Of_Marriage, $Alive_Status, $regNo, $Name]);
        
        echo("Registration Number: ".$regNo."<br/>Name: ".$Name."<br/>Date_Of_Marriage: ".$Date_Of_Marriage."<br/>Alive_Status: ".$Alive_Status."</br>");
        echo("Data Updated Successfully<br/><br/>");
    }
    $pdo=null;
?>
<a href="index.php">Main Menu</a><br/><br/>
</center>
</body>
</html>