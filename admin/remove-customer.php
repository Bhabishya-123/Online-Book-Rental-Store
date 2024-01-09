<?php
    include "includes/config.php";
$sql = "DELETE FROM customer where customer_id={$_GET['id']}"; //sql query for deleting
$conn->query($sql); //executing sql query

header("Location:http://localhost/BookStore/admin/customer.php?succesfullyDeleted");
?>
