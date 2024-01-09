<?php
    include "includes/config.php";
$sql = "DELETE FROM books where book_id={$_GET['id']}"; //sql query for deleting
$conn->query($sql); //executing sql query

header("Location:http://localhost/BookStore/admin/index.php?succesfullyDeleted");
?>
