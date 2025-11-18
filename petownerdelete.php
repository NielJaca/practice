<?php
include "connect.php";
$id = $_GET['deleteid'];

$result = mysqli_query($connect,"DELETE FROM petowner where petOwnerID = $id");

header("location:petowner.php?delete_operation=success");
?>