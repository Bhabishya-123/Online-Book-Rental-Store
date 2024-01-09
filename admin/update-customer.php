<?php 
    include_once('./includes/navbar.php');
    include_once('./includes/restriction.php');

    //this will provide previous user value before updating 
    include "includes/config.php";
    $sql = "SELECT * FROM customer where customer_id={$_GET['id']}";
    $result = $conn->query($sql);
    // output data of each row
    $row = $result->fetch_assoc();
    $_SESSION['previous_name'] = $row['customer_name'];
    $_SESSION['previous_phone'] = $row['customer_phone'];
    $_SESSION['previous_address'] = $row['customer_address'];
    $_SESSION['previous_role'] = $row['customer_role'];
    $_SESSION['previous_email'] = $row['customer_email'];
    $_SESSION['previous_password'] = $row['customer_pwd'];
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
 <h4 class='adm-h4'>Edit Customer Here</h4>

 <div class="update">
 <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
    <label for="">Name</label> <input style="width:100%;text-align:center" type="text" name='name' value="<?php echo $_SESSION['previous_name'] ?>"><br> 
    <label for="">Email</label> <input style="width:100%;text-align:center" type="email" name='email' value="<?php echo $_SESSION['previous_email'] ?>"><br> 
    <label for="">Phone</label> <input style="width:100%;text-align:center" type="number" name='phone' value="<?php echo $_SESSION['previous_phone'] ?>" ><br> 
    <label for="">Address</label> <input style="width:100%;text-align:center" type="text" name='address' value="<?php echo $_SESSION['previous_address'] ?>" ><br> 
    <label for="">Password</label> <input style="width:100%;text-align:center" type="text" name='pwd' value="<?php echo $_SESSION['previous_password'] ?>" ><br> 
  <label for="">Role</label>
    <select style='width:60%;margin-bottom:10px'  id="role_update" name="role">
  <?php 
       if($_SESSION['previous_role']=='admin'){
           ?>
            <option value="admin" selected>Admin</option>
            <option value="normal">Normal</option>
     <?php  } else{?> 
            <option value="admin">Admin</option>
            <option value="normal" selected>Normal</option>
            <?php } ?>
</select>
 <br>
<input class="update-btn" type="submit" value='Update' name="update"></input>
</form>
 </div>




<?php
   if(isset($_POST['update'])){
    //below sql will update user details inside sql table when update is clicked
    include "includes/config.php";
    $sql1 = "UPDATE customer 
             SET  customer_name= '{$_POST['name']}' ,
                  customer_phone= '{$_POST['phone']}' ,
                  customer_address= '{$_POST['address']}' ,
                  customer_email= '{$_POST['email']}' ,
                  customer_pwd= '{$_POST['pwd']}' ,
                  customer_role= '{$_POST['role']}' 
                  
             WHERE customer_id={$_GET['id']} ";
    $conn->query($sql1);   
    
    $conn->close();
    header("Location:http://localhost/BookStore/admin/customer.php?succesfullyUpdated");
   }
?>