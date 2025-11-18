//connect.php
<?php

    $connect = new mysqli("localhost", "root", "", "Clinic")

?>

// Create

<?php
    include "connection.php";

    if(isset($_POST['submit_button'])){
        $foodID = $_POST['foodID'];
        $foodName = $_POST['foodName'];
        $foodPrice = $_POST['foodPrice'];

        $result = mysqli_query($connect,"INSERT INTO food (foodID,foodName,foodPrice) VALUES ('$foodID','$foodName','$foodPrice')");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food</title>
</head>
<body>
        <a href="admin_dashboard.php">Back to Display</a>
        <h1>Add Food</h1>

        <form method ='post'>
            <label for ="foodID">Food ID:</label>
            <input type="text" id="foodID" name="foodID" placeholder="Enter Food ID:" required><br><br>

            <label for ="foodName"> Food Name:</label>
            <input type="text" id="foodName" name="foodName" placeholder="Enter FoodName:" required><br><br>

            <label for ="foodPrice"> Food Price:</label>
            <input type="text" id="foodPrice" name="foodPrice" placeholder="Enter Food Price:" required><br><br>
            
            <button type="submit"  name="submit_button">Add Food</button>
        </form>
</body>
</html>

// Display
<?php
 include "connection.php";

 if(isset($_POST['search_button'])){
    $search =$_POST['search'];

    header("location:admin_dashboard.php?querysearch=$search");
 }

 if(isset($_GET['delete_operation'])){
    echo "Deleted Successfully!";
 }

 if(isset($_GET['update_operation'])){
    echo "Updated Successfully!";
 }

 if(isset($_POST['logout_button'])){
    header("location:login.php");
    session_unset();

 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
        } table{
            margin: 20px auto;
            border-collapse: collapse;
        } th,td{
            padding: 10px;
            text-align: left;
        }
</style>    
<body>
    <a href="add_food.php">Add Food</a><br><br>
    <form method = 'post'>
        <input type="text" name="search" placeholder="Search" required>
        <button type="submit" name="search_button">Search</button>
    </form>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
    </thead>
    <tbody>
            <?php
                if(isset($_GET['querysearch'])){
                    $querysearch = $_GET['querysearch'];
                    $result = mysqli_query($connect,"SELECT * FROM food WHERE
                    foodName LIKE '%$querysearch%' or
                    foodPrice LIKE '%$querysearch%'
                    "); 
                } else{
                    $result = mysqli_query($connect,"SELECT * FROM food");
                } while ($row = mysqli_fetch_assoc($result)){
                    echo '
                            <tr>   
                                <td>'.$row['foodName'].'</td>
                                <td>'.$row['foodPrice'].'</td>
                                <td>
                                    <button><a href="delete_food.php?deleteid='.$row['foodID'].'">Delete</button>
                                    <button><a href="update_food.php?updateid='.$row['foodID'].'">Update</button>
                                </td>
                            </tr>
                    ';

                }
            ?>
            <form method='post'>
            <button type="submit" name="logout_button">Log Out</button>
            </form>
    </tbody>
    </table>    
</body>
</html>

//Display and Register
<?php
    include "connect.php";

    if (isset($_POST['submit_button'])){

        $petOwnerID = $_POST['petOwnerID'];
        $petOwnerFName = $_POST['petOwnerFName'];
        $petOwnerLName = $_POST['petOwnerLName'];
        $petOwnerBDate = $_POST['petOwnerBDate'];
        $petOwnerTelNo = $_POST['petOwnerTelNo'];

        $result = mysqli_query($connect,"INSERT INTO petowner(petOwnerID,petOwnerFName,petOwnerLName,petOwnerBDate,petOwnerTelNo)VALUES('$petOwnerID', '$petOwnerFName','$petOwnerLName','$petOwnerBDate', '$petOwnerTelNo' )");
        /* $checkQuery = mysqli_query($connect, "SELECT COUNT(*) as total FROM user");
        $row = mysqli_fetch_assoc($checkQuery);
        $totalUsers = $row['total'];
    
        $isAdmin = ($totalUsers == 0) ? 1 : 0;  */

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

// update.php
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

//delete.php
<?php
include "connect.php";
$id = $_GET['deleteid'];

$result = mysqli_query($connect,"DELETE FROM petowner where petOwnerID = $id");

header("location:petowner.php?delete_operation=success");
?>

// login.php
<?php
    session_start();
    include "connection.php";

    if(isset($_POST['login_button'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $result = mysqli_query($connect, "SELECT * FROM users WHERE username='$username' AND password='$password'");
        
        if(mysqli_num_rows($result) == 1){
            $_SESSION['username'] = $username;
            header("location: display_positions.php");
        } else {
            $error = "Invalid username or password!";
        }
    }

    if(isset($_SESSION['username'])){
        header("location: display_positions.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
    body{
        display: flex;
        flex-direction: column;
        align-items:center
    }
</style>
<body>
    <h1>Login</h1>

    <?php if(isset($error)){ echo $error; } ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><Br><Br>
        <center><button type="submit" name="login_button">Login</button></center>
    </form>
</body>
</html>

//login with routing 
    <?php
session_start();
$_SESSION = array();
include "connection.php";
if(isset($_POST['login_button'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
    
    if(mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['isAdmin'] = $user['isAdmin'];
        
        if($user['isAdmin'] == 1){
            header("location: admin_dashboard.php");
        } else {
            header("location: user_dashboard.php");
        }
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
if(isset($_SESSION['username'])){
    if($_SESSION['isAdmin'] == 1){
        header("location: admin_dashboard.php");
    } else {
        header("location: user_dashboard.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <h1>Log In Here!</h1>
    
    <?php if(isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter Username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" required><br><br>

        <button type="submit" name="login_button">Log In</button>
    </form>
</body>
</html>
        




