<?php
    include "connect.php";

    if (isset($_POST['submit_button'])){

        $petOwnerID = $_POST['petOwnerID'];
        $petOwnerFName = $_POST['petOwnerFName'];
        $petOwnerLName = $_POST['petOwnerLName'];
        $petOwnerBDate = $_POST['petOwnerBDate'];
        $petOwnerTelNo = $_POST['petOwnerTelNo'];

        $result = mysqli_query($connect,"INSERT INTO petowner(petOwnerID,petOwnerFName,petOwnerLName,petOwnerBDate,petOwnerTelNo)VALUES('$petOwnerID', '$petOwnerFName','$petOwnerLName','$petOwnerBDate', '$petOwnerTelNo' )");
        

    }

    if(isset($_GET['delete_operation'])){
        echo"Deleted successfully!";
    }


    if(isset($_POST['search_button'])){
        $search = $_POST['search'];
        header("location:petowner.php?querysearch=$search");
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinarian</title>
</head>

<body>
    <a href="index.php">Back To Menu</a><br><br>
    <h1>Veterinarian </h1><br><br>
    <form method = 'post'>
        <label for = "petOwnerID">Pet Owner ID</label>
        <input type= "text" id="petOwnerID" name="petOwnerID" required><br><br>

        <label for = "petOwnerFName">First Name</label>
        <input type= "text" id="petOwnerFName" name="petOwnerFName" required><br><br>

        <label for = "petOwnerLName">Last Name</label>
        <input type= "text" id="petOwnerLName" name="petOwnerLName" required><br><br>

        <label for = "petOwnerBDate">Birth Date</label>
        <input type= "text" id="petOwnerBDate" name="petOwnerBDate" required><br><br>

        <label for = "petOwnerTelNo">Number</label>
        <input type= "text" id="petOwnerTelNo" name="petOwnerTelNo" required><br><br>

        <button type = "submit" name = "submit_button">SUBMIT</button><br><br>


    </form>
    <h2>Owner List</h2>
    <form method="post">
        <input type="text" name="search" required>
        <button type="submit" name="search_button">Search</button><br><br>
    </form>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Owner ID</th>
                <th>FirstName</th>
                <th>Lastname</th>
                <th>Birth Date</th>
                <th>Number</th>
                <th>Action</th> 

             </tr>       
        </thead>
        <tbody>
            <?php

                if(isset($_GET['querysearch'])){
                    $querysearch = $_GET['querysearch'];
                    $result = mysqli_query($connect,"Select * from petowner where petOwnerID LIKE '%$querysearch%' or petOwnerFName LIKE '%$querysearch%' or petOwnerLName LIKE '%$querysearch%' or petOwnerBDate LIKE '%$querysearch%'or petOwnerTelNo LIKE '%$querysearch%'");
                }
                else{
                    $result = mysqli_query($connect,"Select * from petowner");
                }
                while($row= mysqli_fetch_assoc($result)){
                    echo'
                        <tr>
                            <td>'.$row['petOwnerID'].'</td>
                            <td>'.$row['petOwnerFName'].'</td>
                            <td>'.$row['petOwnerLName'].'</td>
                            <td>'.$row['petOwnerBDate'].'</td>
                            <td>'.$row['petOwnerTelNo'].'</td>
                            <td> 
                                <button><a href="petownerupdate.php?updateid='.$row['petOwnerID'].'">Update</a></button>
                                <button><a href="petownerdelete.php?deleteid='.$row['petOwnerID'].'">Delete</a></button>
                            </td>
                        </tr>
                    ';

                }

 
            ?>
    
</body>
</html>


