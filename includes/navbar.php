<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}        include 'config.php';
//it is used to get number of carts item 
if(isset($_SESSION['id'])){
    $sql44 ="SELECT * FROM  carts WHERE uid='{$_SESSION['id']}';";
    $result44 = $conn->query($sql44);
    $_SESSION['cartNum']=mysqli_num_rows($result44);
    }
    ?>
<head>
<script src="https://use.fontawesome.com/be1ba39dfe.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.php">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
      integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
    /* Set the width of the side navigation to 250px */
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
</head>
<nav class="navbar">
<div class="nav-main">
    <li><a href="./index.php">Home</a></li>
    <li><a href="./products.php?type=new">Products</a></li>

    <?php
        if(isset($_GET['id'])){
            $_SESSION['book_id'] = $_GET['id'];
            }
    //if session_id is set i.e user has loggedin than only show this list
       if((isset($_SESSION['id']))){?>
    <li><a href="./profile.php">My Account</a></li>
    <?php
}?>
    <li><a href="./About.php">About</a></li>

    <?php
       if(!(isset($_SESSION['id']))){?>
           <li><a href="./Register.php">Create Account</a></li>
    <li><a href="./login.php">Login</a></li>
    <?php
}?>

<?php if((isset($_SESSION['id']))){?>
	 <li class='cartList' style="position:relative;text-align:center;width:40px;top:3px"><a href="cart.php"  style="padding-right:0"><span id="cart" style="color:yellow"></span><img style="width:25px;height:18px;position:relative" src="./images/cart.png" alt="shop-cart">
	 <div class="badge" id="cartNum" >
<?php echo $_SESSION['cartNum'] ?>
</div>
<?php
}?>
    <?php
       if((isset($_SESSION['id']))){?>
    <li><a href="./logout.php">Logout</a></li>
    <?php
}?>

</div>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <li><a href="./index.php">Home</a></li>
    <li><a href="./products.php?type=new">Products</a></li>

    <?php
        if(isset($_GET['id'])){
            $_SESSION['book_id'] = $_GET['id'];
            }
    //if session_id is set i.e user has loggedin than only show this list
       if((isset($_SESSION['id']))){?>
    <li><a href="./profile.php">My Account</a></li>
    <?php
}?>
    <li><a href="./About.php">About</a></li>

    <?php
       if(!(isset($_SESSION['id']))){?>
           <li><a href="./Register.php">Create Account</a></li>
    <li><a href="./login.php">Login</a></li>
    <?php
}?>

<?php if((isset($_SESSION['id']))){?>
	 <li class='cartList' style="position:relative;text-align:center;width:40px;top:3px"><a href="cart.php"  style="padding-right:0"><span id="cart" style="color:yellow"></span><img style="width:25px;height:18px;position:relative" src="./images/cart.png" alt="shop-cart">
	 <div class="badge" id="cartNum" >
<?php echo $_SESSION['cartNum'] ?>
</div>
<?php
}?>
    <?php
       if((isset($_SESSION['id']))){?>
    <li><a href="./logout.php">Logout</a></li>
    <?php
}?>

  </div>
  <span class='bars' style="" onclick="openNav()">&#9776;</span>
</nav>
