<?php 
    include_once('./includes/navbar.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['role']))){
        header("Location:login.php?unauthorizedAccess");
      }
 ?>
 <head>
     <style>
         .addcust{
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

 <h4 class='adm-h4'>Add Customer</h4>
 <div class="addcust">
  <!-- Form -->
  <form action="./save-customer.php" method="POST">
    <div><label for="fullname">Full Name</label></div>
    <input style='width:80%' type="text" id="fullname" name="name" required><br>
    
    <div><label for="email">Email</label></div>
    <input style='width:80%' type="email" id="email" name="email" required><br>
    
    <div><label for="address">Address</label></div>
    <input style='width:80%' type="text" id="address" name="address" required><br>
    
    <div><label for="mobile">Mobile Number</label></div>
    <input style='width:80%' type="tel" id="mobile" name="phone" required><br>
    
    <div><label for="password">Password</label></div>
    <input style='width:80%' type="password" id="password" name="pwd" required><br>
    <div><label for="password">Role</label></div>
    <select  style='width:50%;margin-bottom:10px' id="role_update" name="role">
  <?php 
       if($_SESSION['previous_role']=='admin'){
           ?>
            <option value="admin" selected>Admin</option>
            <option value="normal">Normal</option>
     <?php  } else{?> 
            <option value="admin">Admin</option>
            <option value="normal" selected>Normal</option>
            <?php } ?>
</select> <br>
    <input type='submit' value='Add' name='submit'></input>
  </form>
                  <!--/Form -->
 </div>




