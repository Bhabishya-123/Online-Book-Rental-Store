
<?php 
    include_once('./includes/navbar.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['role']))){
      header("Location:login.php?unauthorizedAccess");
    }
 ?>

<h4 class='adm-h4'>Book Rent Order</h4>
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

$sql = "SELECT * FROM rentOrders WHERE returned_status='pending' LIMIT {$offset},{$limit}";
$result = $conn->query($sql);
if ($result->num_rows > 0) { ?>
    
    <div class="table-cont">
    <table>
    <tr>
    <th class="short">S.N</th>
    <th class="large">Customer-Id</th>
    <th class="medium">Book_Id</th>
    <th class="medium">Quantity</th>
    <th class="medium">Each Price</th>
    <th class="medium">Date</th>
    <th class="medium">Return Date</th>
    <th class="medium">Deliver Status</th>
    <th class="medium">Return Status</th>
    <th class="short">Action</th>

    </tr>
<?php 
// output data of each row
while($row = $result->fetch_assoc()) {
    $sn = $sn+1;
?>
<tr>
    <td><?php echo $sn ?></td>
    <td><?php echo $row["cid"] ?></td>
    <td><?php echo $row["bid"] ?></td>
    <td><?php echo $row["quantity"] ?></td>
    <td><?php echo $row["price"] ?></td>
    <td><?php echo $row["date"] ?></td>
    <td><?php echo $row["return_date"] ?></td>
    <td><?php echo $row["delivered_status"] ?></td>
    <td><?php echo $row["returned_status"] ?></td>
    <td><a class="fn_link" href="update-order.php?id=<?php echo $row["id"] ?>"><i class='fa fa-edit'></i></a></td>
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

                $sql1 = "SELECT * FROM rentorders WHERE returned_status='pending'";
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

                        echo "<a href='order.php?page={$i}' class='{$active}'>".$i."</a>";
                  }
            
                }
                echo "</div>";
                  ?>
<br>
