
<?php 
    include_once('./includes/navbar.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['role']))){
      header("Location:login.php?unauthorizedAccess");
    }
 ?>
 <?php
   if(isset($_POST['update'])){
    //below sql will update user details inside sql table when update is clicked
    include "includes/config.php";
    $sql1 = "UPDATE rentorders 
             SET  returned_status='{$_POST['status']}'
             WHERE cid={$_POST['cid']} AND bid={$_POST['bid']} AND quantity={$_POST['quant']} AND return_date='{$_POST['r_date']}' ";
    $sql2 = "UPDATE return_request 
             SET  returned_status='{$_POST['status']}'
             WHERE customer_id={$_POST['cid']} AND book_id={$_POST['bid']} AND quantity={$_POST['quant']} AND return_date='{$_POST['r_date']}' ";
    $conn->query($sql1);   
    $conn->query($sql2);   
    $conn->close();
    header("Location:http://localhost/BookStore/admin/return.php?succesfullyUpdated");
   }
?>

<h4 class='adm-h4'>Book Return Request</h4>
<br>

<?php
  include "includes/config.php";
     
        /* define how much data to show in a page from database*/
        $limit = 4;
        if(isset($_GET['page'])){
          $page = $_GET['page'];
          switch($page){
            case 1: $sn = 0; break;
            case 2: $sn = 4;break;
            case 3: $sn = 8; break;
            case 4: $sn = 12; break;
            case 5: $sn = 16; break;
            case 6: $sn = 20; break;
          }
        }else{
          $page = 1;
          switch($page){
            case 1: $sn = 0; break;
            case 2: $sn = 4;break;
            case 3: $sn = 8; break;
            case 4: $sn = 12; break;
            case 5: $sn = 16; break;
            case 6: $sn = 20; break;
          }
        }
        //define from which row to start extracting data from database
        $offset = ($page - 1) * $limit;

$sql = "SELECT * FROM return_request WHERE returned_status='pending' LIMIT {$offset},{$limit} ";
$result = $conn->query($sql);
if ($result->num_rows > 0) { ?>
    
    <div class="table-cont">
    <table>
    <tr>
    <th class="short">S.N</th>
    <th class="large">Customer Id</th>
    <th class="medium">Book Id</th>
    <th class="medium">Quantity</th>
    <th class="medium">Return Date</th>
    <th class="medium">Requested Date</th>
    <th class="short">Returned Status</th>

    </tr>
<?php 
// output data of each row
while($row = $result->fetch_assoc()) {
    $sn = $sn+1;
?>
<tr>
    <td><?php echo $sn ?></td>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
    <td><input type="text" name='cid' value='<?php echo $row["customer_id"] ?>' readonly style='outline:none;border:none;width:100%;background:none;text-align:center'></td>
    <td><input type="text" name='bid' value='<?php echo $row["book_id"] ?>' readonly style='outline:none;border:none;width:100%;background:none;text-align:center'></td>
    <td><input type="text" name='quant' value='<?php echo $row["quantity"] ?>' readonly style='outline:none;border:none;width:100%;background:none;text-align:center'></td>
    <td><input type="text" name='r_date' value='<?php echo $row["return_date"] ?>' readonly style='outline:none;border:none;width:100%;background:none;text-align:center'></td>
    <td><?php echo $row["requested_date"] ?></td>
    <td>
    <div class="update">
    <select id="status_update" name="status">
  <?php 
       if($row['returned_status']=='pending'){
           ?>
            <option value="pending" selected>Pending</option>
            <option value="returned">Returned</option>
     <?php  } else{?> 
                       <option value="pending">Pending</option>
            <option value="returned" selected>Returned</option>
            <?php } ?>
</select>
<input class="update-btn" type="submit" value='Update' name="update" style='margin-top:4px'></input>
</form>
 </div>
    </td>
</tr>
<?php }}else { echo "<p style='text-align:center'>0 results</p>"; }
             $conn->close(); 
             ?>

</table>
</div>

<!--Pagination-->
<?php
                include "includes/config.php"; 
               // Pagination btn using php with active effects 

                $sql1 = "SELECT * FROM return_request WHERE returned_status='pending'";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                if(mysqli_num_rows($result1) > 0){

                  $total_orders = mysqli_num_rows($result1);
                  $total_page = ceil($total_orders / $limit);

                  echo "<div class='pagination'>";
          
                  for($i=1; $i<=$total_page; $i++){

                    //important this is for active effects that denote in which page you are in current position
                    if($page==$i){
                      $active = "active";
                    }else{
                      $active = "";
                    }

                        echo "<a href='return.php?page={$i}' class='{$active}'>".$i."</a>";
                  }
            
                }
                echo "</div>";
                  ?>
<br>


