<?php 
    include_once('./includes/navbar.php');
    include_once('./includes/restriction.php');

    //this will provide previous user value before updating 
    include "includes/config.php";
    $sql = "SELECT * FROM rentOrders where id={$_GET['id']}";
    $result = $conn->query($sql);
    // output data of each row
    $row = $result->fetch_assoc();
    $_SESSION['delivered_status'] = $row['delivered_status'];
    $conn->close();
 ?>
 <head>
     <style>
         .update{
            width:40%;
            position:absolute;
             top:14%;
             left:29%;
             background-color:rgb(60, 124, 197);
             box-shadow:2px 2px 3px 2px skyblue;
             font-size:20px;
             font-weight:bold;
             text-align:center;
         }
         
     </style>
 </head>
 <h4 class='adm-h4'>Edit Return Here</h4>
 <div class="update">
<form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
    <label for="">Returned Status</label>
    <select id="status_update" name="status">
  <?php 
       if($_SESSION['delivered_status']=='pending'){
           ?>
            <option value="pending" selected>Pending</option>
            <option value="delivered">Delivered</option>
     <?php  } else{?> 
                       <option value="pending">Pending</option>
            <option value="delivered" selected>Delivered</option>
            <?php } ?>
</select>
 <br> <br> <br> <br>
<input class="update-btn" type="submit" value='Update' name="update"></input>
</form>
 </div>




<?php
   if(isset($_POST['update'])){
    //below sql will update user details inside sql table when update is clicked
    include "includes/config.php";
    $sql1 = "UPDATE rentorders 
             SET  delivered_status='{$_POST['status']}'
             WHERE id={$_GET['id']} ";
    $conn->query($sql1);   
    
    $conn->close();
    header("Location:http://localhost/BookStore/admin/order.php?succesfullyUpdated");
   }
?>