<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body><center>
<h1>St. Anthony's Church</h1><br/>
    <h2>Search By Registration Number</h2><br/>

<form action="SearchData.php" method="GET">
    <input type="text" name="Reg_No" placeholder="Registration Number">
    
    <input type="submit" name="search" value="Search"><br/><br/>
</form>



<?php
    $pdo = new PDO('sqlite:DB.sqlite');
    
    if (isset($_GET['search'])) {
        try{
            $item = $_GET['Reg_No'];
            //echo($item);
            $sql = $pdo->query("SELECT * FROM Family WHERE Reg_No='$item';");
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            if($result == null){
                throw new Exception();
            }
            echo("Registration Number: " . $result[0]['Reg_No']."<br/><br/>");
            echo("Zone: " . $result[0]['Zone']."<br/><br/>");
            echo("Address: " . $result[0]['Address']."<br/><br/>");
            echo("Telephone Numbers: " . $result[0]['Telephone_Nos']."<br/><br/><hr/><br/>");

            $sql2 = $pdo->query("SELECT * FROM Member WHERE Reg_No='$item';");
            $result2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result2 as $row) {
                echo ("Full Name: " . $row['Name'] 
                    . "<br/><br/>Relation: " . $row['Relation'] 
                    . "<br/><br/>Date Of Birth: " . $row['Date_Of_Birth'] 
                    . "<br/><br/>DATE OF BAPTISM: " . $row['Date_Of_Baptism']
                    . "<br/><br/>DATE OF HOLY COMMUNION: " . $row['Date_Of_Holy_Communion']
                    . "<br/><br/>DATE OF CONFORMATION: " . $row['Date_Of_Conformation']
                    . "<br/><br/>DATE OF MARRIAGE: " . $row['Date_Of_Marriage']
                    . "<br/><br/>STILL ALIVE or NOT: " . $row['Alive_Status'] . "<br/><br/><hr/><br/>"
                );
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
    $pdo=null;
?>

<a href="index.php">Main Menu</a><br/><br/>
</center>
</body>
</html>