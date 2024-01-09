<?php 
    include_once('./includes/navbar.php');
    include_once('./includes/restriction.php');

    //this will provide previous user value before updating 
    include "includes/config.php";
    $sql = "SELECT * FROM books where book_id={$_GET['id']}";
    $result = $conn->query($sql);
    // output data of each row
    $row = $result->fetch_assoc();
    $_SESSION['previous_title'] = $row['book_title'];
    $_SESSION['previous_desc'] = $row['book_desc'];
    $_SESSION['previous_catag'] = $row['book_catag'];
    $_SESSION['previous_price'] = $row['book_price'];
    $conn->close();
 ?>
 <head>
     <style>
         .update{
            width:40%;
             position:absolute;
             top:14%;             left:29%;
             background-color:rgb(60, 124, 197);
             box-shadow:2px 2px 3px 2px skyblue;
             font-size:20px;
             font-weight:bold;
             text-align:center;
         }
    
     

     </style>
 </head>

 <h4 class='adm-h4'>Edit Book Here</h4>
 <div class="update">
 <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
    <label for="">Name</label> <input style="width:100%;text-align:center" type="text" name='title' value="<?php echo $_SESSION['previous_title'] ?>"><br> 
    <label for="">Description</label> <textarea style="width:100%;text-align:center" name="desc" > <?php echo $_SESSION['previous_desc'] ?></textarea><br> 
    <label for="">Category</label> <input style="width:100%;text-align:center" type="text" name='catag' value="<?php echo $_SESSION['previous_catag'] ?>" ><br> 
    <label for="">Price</label>   <input style="width:100%;text-align:center"  type="number" name='price' value="<?php echo $_SESSION['previous_price'] ?>"><br> 
 <br>
<input   style="width:100px;" type="submit" value='Update' name="update"></input>
</form>
 </div>




<?php
   if(isset($_POST['update'])){
    //below sql will update user details inside sql table when update is clicked
    include "includes/config.php";
    $sql1 = "UPDATE books
               SET book_catag= '{$_POST['catag']}' ,
                  book_title= '{$_POST['title']}' ,
                  book_price= '{$_POST['price']}' ,
                  book_desc= '{$_POST['desc']}' 
               
             WHERE book_id={$_GET['id']} ";
    $conn->query($sql1);   
    
    $conn->close();
    header("Location:http://localhost/BookStore/admin/index.php?succesfullyUpdated");
   }
?>