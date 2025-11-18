<?php
    include "connect.php";
    $id = $_GET['updateid'];

    if (isset($_POST['submit_button'])){

        $petOwnerID = $_POST['petOwnerID'];
        $petOwnerFName = $_POST['petOwnerFName'];
        $petOwnerLName = $_POST['petOwnerLName'];
        $petOwnerBDate = $_POST['petOwnerBDate'];
        $petOwnerTelNo = $_POST['petOwnerTelNo'];

        $result = mysqli_query($connect,"UPDATE petowner SET petOwnerID='$petOwnerID', petOwnerFName='$petOwnerFName', petOwnerLName='$petOwnerLName', petOwnerBDate='$petOwnerBDate', petOwnerTelNo='$petOwnerTelNo' where petOwnerID=$id");
        header("location:petowner.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
</head>
<body>
    <?php

        $result = mysqli_query($connect, "Select * from petowner where petOwnerID = $id");
        $row = mysqli_fetch_assoc($result);

        echo'
            <form method = "post">
                <label for = "petOwnerID">Pet Owner ID</label>
                <input value ='.$row['petOwnerID'].' type= "text" id="petOwnerID" name="petOwnerID" required><br><br>

                <label for = "petOwnerFName">First Name</label>
                <input value ='.$row['petOwnerFName'].' type= "text" id="petOwnerFName" name="petOwnerFName" required><br><br>

                <label for = "petOwnerLName">Last Name</label>
                <input value ='.$row['petOwnerLName'].' type= "text" id="petOwnerLName" name="petOwnerLName" required><br><br>

                <label for = "petOwnerBDate">Birth Date</label>
                <input value ='.$row['petOwnerBDate'].' type= "text" id="petOwnerBDate" name="petOwnerBDate" required><br><br>

                <label for = "petOwnerTelNo">Number</label>
                <input value ='.$row['petOwnerTelNo'].' type= "text" id="petOwnerTelNo" name="petOwnerTelNo" required><br><br>

                <button type = "submit" name = "submit_button">SUBMIT</button><br><br>
        
            ';

    
    ?>
</body>
</html>
