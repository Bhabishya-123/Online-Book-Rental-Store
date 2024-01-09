<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
     *{
        margin:0;padding:0;
      }
.navbar{
  display: flex;
  background-color:rgb(60, 124, 197);
  position: fixed;
  top:0;
  width: 100%;
  font-size: 20px;
}

.nav-right{
  text-align: right;
  float:right;
}

.nav-right li {
    display: inline;
    float: left;
    padding-left: 15px;
  }

  .nav-right li a {
    display: block;
    padding: 8px;
    text-decoration: none;
    color:white;
  }

  .nav-right  li ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
  }

  .nav-right li a:hover {
    background-color: rgb(31, 199, 106);
  }

  .nav-right .active {
    background-color: #04AA6D;
  }


html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  margin-bottom: 16px;
  padding: 0 8px;
  display:flex;
justify-content:center;

}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
  width: 400px;
  height: 400px;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-color: #474e5d;
  color: white;
}

.container {
  padding: 0 16px;
  display: flex;
  flex-direction:column;
  gap:5px
}

.container::after, .row::after {
  content: "";
  clear: both;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}
.row{
display:flex;
justify-content:center;
align-items:center;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}
</style>
<title>
  About Us
</title>
</head>
<body>

    <?php include_once './includes/navbar.php'?>
<div class="about-section">
  <h1>About Us </h1>
  <p>Book Zone provides easy interface to its customer for purchasing books online.</p>
  <p>For any query leave a comment in the Home page comment section. You can also send us email and call us 
      on Week days. 
      <br>Thankyou for your patience and hope you had a great shopping here.
  </p>
</div>

<h2 style="text-align:center">Our Team</h2>
<div class="row">
    <div class="card">
      <center><img src="./images/p1.jfif" alt="Jane" style="width:100% height=300px"></center>
      <div class="container">
      <center> <h2>Himanshu</h2></center>
       <center> <p class="title">Art Director</p></center>
        
        <p>“Two things are infinite: the universe and human stupidity; and I'm not sure about the universe.”</p>
        <center><p>Abc@example.com</p></center>
        <p><button class="button">Contact</button></p>
      </div>
  </div>

    <div class="card">
        <center><img src="./images/p2.jfif" alt="Jane" style="width:100% height=300px"></center>
      <div class="container">
       <center> <h2>Abc</h2></center>
       <center> <p class="title">Art Director</p></center>
        
        <p>“Two things are infinite: the universe and human stupidity; and I'm not sure about the universe.”</p>
        <center><p>Abc@example.com</p></center>
        <p><button class="button">Contact</button></p>
      </div>
  </div>
  

</div>

</body>
</html>
