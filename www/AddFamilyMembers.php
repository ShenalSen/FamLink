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
    <h2>Add Family Memebers</h2><br/>

<form action="AddFamilyMembers.php" method="GET">
    Registration Number: <input type="text" name="Reg_No" placeholder="Registration Number" value="" required><br/><br/>
    Full Name: <input type="text" name="Name" placeholder="Full Name" required><br/><br/>
    Relation: <select name="Relation" required>
        <option value="" disabled selected>Select Relation</option>
        <option value="FATHER [M]">FATHER [M]</option>
        <option value="MOTHER [F]">MOTHER [F]</option>
        <option value="SON [M]">SON [M]</option>
        <option value="DAUGHTER [F]">DAUGHTER [F]</option>
        <option value="GRAND FATHER [M]">GRAND FATHER [M]</option>
        <option value="GRAND MOTHER [F]">GRAND MOTHER [F]</option>
        <option value="OTHER [M]">OTHER [M]</option>
        <option value="OTHER [F]">OTHER [F]</option>
    </select><br/><br/>
    DATE OF BIRTH: <input type="date" name="BirthDay" placeholder="DATE OF BIRTH" required><br/><br/>
    DATE OF BAPTISM: <input type="date" name="BaptismDay" placeholder="DATE OF BAPTISM" ><br/><br/>
    DATE OF HOLY COMMUNION: <input type="date" name="HolyCommunionDay" placeholder="DATE OF HOLY COMMUNION" ><br/><br/>
    DATE OF CONFORMATION: <input type="date" name="ConformationDay" placeholder="DATE OF CONFORMATION" ><br/><br/>
    DATE OF MARRIAGE: <input type="date" name="MarriageDay" placeholder="DATE OF MARRIAGE"><br/><br/>
    Alive Status: <select name="AliveStatus" required>
        <option value="YES">Alive</option>
        <option value="NO">Not Alive</option>
    </select><br/><br/>
    <input type="submit" name="add" value="Add"><br/><br/>
</form>

<a href="index.php">Main Menu</a><br/><br/>


<?php
$pdo = new PDO('sqlite:DB.sqlite');
    if (isset($_GET['add'])) {
        try{
            $RegNo = $_GET['Reg_No'];
            $Name = $_GET['Name'];
            $Relation = $_GET['Relation'];
            $BirthDay = $_GET['BirthDay'];
            $BaptismDay = $_GET['BaptismDay'];
            $HolyCommunionDay = $_GET['HolyCommunionDay'];
            $ConformationDay = $_GET['ConformationDay'];
            $MarriageDay = $_GET['MarriageDay'];
            $AliveStatus = $_GET['AliveStatus'];

            if($RegNo == "" || $Name == ""){
                throw new Exception("Registration NumberCannot be null");
            }

            //$sql = "INSERT INTO Family(Reg_No, Zone, Address, Telephone_Nos) VALUES('$regNo', '$zone', '$address', '$telephone');";
            $sql = $pdo->prepare('INSERT INTO Member(Reg_No, Name, Relation, Date_Of_Birth, DATE_OF_BAPTISM, DATE_OF_HOLY_COMMUNION, DATE_OF_CONFORMATION, DATE_OF_MARRIAGE, Alive_Status) VALUES(?,?,?,?,?,?,?,?,?);');
            $sql->execute([$RegNo, $Name, $Relation, $BirthDay, $BaptismDay, $HolyCommunionDay, $ConformationDay, $MarriageDay, $AliveStatus]);
            //$pdo->exec($sql);
            echo("Data Added Successfully<br/><br/>");

        }
        catch(Exception $e){
            echo("Something Went Wrong!<br/>Did not add the Data<br/>Check Data<br/><br/>");
            
        }  
        $pdo=null;

    }
?>

</center>
</body>
</html>