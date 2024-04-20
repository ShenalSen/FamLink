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
<h2>Register a New Family</h2><br/>

<form action="RegisterFamily.php" method="GET">
    Registration Number: <input type="text" name="Reg_No" placeholder="Registration Number" required><br/><br/>
    Zone: <input type="text" name="Zone" placeholder="Zone" required><br/><br/>
    Address: <input type="text" name="Address" placeholder="Address" required><br/><br/>
    Telephone Numbers: <input type="text" name="Telephone_Nos" placeholder="Telephone Numbers" required><br/><br/>
    <input type="submit" name="create" value="Create"><br/><br/>
</form>

<a href="AddFamilyMembers.php">Add Family Memebers</a><br/><br/><br/>
<a href="index.php">Main Menu</a><br/><br/>

<?php
    $pdo = new PDO('sqlite:DB.sqlite');
    
    if (isset($_GET['create'])) {
        
        try{
            $regNo = $_GET['Reg_No'];
            $zone = $_GET['Zone'];
            $address = $_GET['Address'];
            $telephone = $_GET['Telephone_Nos'];
            if($regNo == ""){
                throw new Exception("Registration NumberCannot be null");
            }

            //$sql = "INSERT INTO Family(Reg_No, Zone, Address, Telephone_Nos) VALUES('$regNo', '$zone', '$address', '$telephone');";
            $sql = $pdo->prepare('INSERT INTO Family(Reg_No, Zone, Address, Telephone_Nos) VALUES(?,?,?,?);');
            $sql->execute([$regNo, $zone, $address, $telephone]);
            //$pdo->exec($sql);
            echo("Data Added Successfully");

        }
        catch(Exception $e){
            echo("Something Went Wrong!<br/>Did not add the Data<br/>Check Registration Number Already Exists");
            
        }  
        $pdo=null;
    }
?>

</center>
</body>
</html>