<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <title>DATA</title>
</head>
<body>
<center>
    <h1>St. Anthony's Church</h1><br/>
    <h2>Get Zone's Families</h2><br/><br/>
    
    <form action="GetZoneFamilies.php" method="GET">
    <input type="text" name="Zone" placeholder="Zone">
    <input type="submit" name="get" value="Get"><br/><br/>
</form>


<?php
    $pdo = new PDO('sqlite:DB.sqlite');
    
    if (isset($_GET['get'])) {
        try{
            
            $item = $_GET['Zone'];

            $sql2 = $pdo->query("SELECT count(Reg_No) FROM Family WHERE UPPER(Zone) = UPPER('$item');");
            $result2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
            //print_r($result2[0]['count(Reg_No)']);
            $val = $result2[0]['count(Reg_No)'];
            echo("<h3>Zone: $item   &nbsp;&nbsp;&nbsp;   Count: '$val' <br/><br/><br/></h3>");
            $sql = $pdo->query("SELECT * FROM Family WHERE UPPER(Zone) = UPPER('$item');");
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            if($result == null){
                throw new Exception();
            }
            foreach ($result as $row){
                echo("Registration Number: " . $row['Reg_No']."<br/><br/>");
                echo("Address: " . $row['Address']."<br/><br/>");
                echo("Telephone Numbers: " . $row['Telephone_Nos']."<br/><br/><hr/><br/>");
            }
           
            
            
            
            // echo("<br/><br/><br/><br/><br/><br/><br/><br/><br/>");
            // print_r($result);
            // echo("<br/><br/>");
            // print_r($result2);
        }
        catch(Exception $e){
            echo("Please Check the Zone<br/><br/>");
        }
    }
    $pdo=null;
?>

<a href="index.php">Main Menu</a><br/><br/>

</center>
</body>
</html>