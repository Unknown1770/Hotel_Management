<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<title>Book Hall </title>
<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>  
  <script type="text/javascript" src="assets/js/custom.js"></script> 
 <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body ng-app=""> 


      <!-- Navigation -->
     <!-- Navigation -->
     <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="createrip.php">
                   Book Hall</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="entercar.php">Add Car</a></li>
              <li> <a href="enterdriver.php"> Add Driver</a></li>
              <li> <a href="clientview.php">View</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            
            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Menu <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="addroom.php">Book Rooms</a></li>
              <li> <a href="mybookings.php">My Bookings</a></li>
              <li> <a href="details.php"> My details</a></li>
            </ul>
            </li>
          </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
            }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="clientlogin.php">Client</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <li>
                        <a href="#"> FAQ </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
<div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
              
		
		<form role="form" action="hallconfirm.php" method="POST">
		  <div class="modal-body">
		     <!--Sign up message from PHP file-->
			 <div id="signupmessage"></div>
			        
					<div class="form-group">
					  <label for="name" class="sr-only">name:</label>
					  <input class="form-control" type="text" name="name" id="name" placeholder="Name" maxlength="30">
					</div>
					
					<div class="form-group">
						  <label for="phonenumber" class="sr-only">Phone No.:</label>
						  <input class="form-control" type="text" name="phonenumber" id="phonenumber" placeholder="Mobile Number" maxlength="15">
					</div>
					
					<div class="form-group">
					  <label for="carno" class="sr-only">Number of Guests:</label>
					  <input class="form-control" type="text" name="guest" id="guest" placeholder="Number of Guests" maxlength="30">
					</div>
										
					<div class="form-group">
						  <label><h5>Select Food Type:</h5></label>&nbsp;&nbsp;&nbsp;
						  <label><input type="radio" name="food" id="regular" value="veg food">&nbsp;Veg Food</label>
						  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <label><input type="radio" name="food" id="oneday" value="nfood">&nbsp;Non-Veg Food</label>
					 </div>	
					
					 <div class="form-group">
						  <?php $today = date("Y-m-d") ?>
						  <label><h5>Date:</h5></label>&nbsp;&nbsp;&nbsp;
							<input type="date" name="date" min="<?php echo($today);?>" required="">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <label><h5>Time:</h5></label>&nbsp;&nbsp;&nbsp;
						  <input type="time" name="time" value="time" required="">
					</div>
					
					
					<div class="form-group">
						  <label><h5>Select a Hall:</h5></label>&nbsp;&nbsp;&nbsp;
						  <?php 
							$link = @mysqli_connect("localhost","root","enormousviju1770","resorts") or die ("Error: Unable to connect: ".mysqli_connect_error()) ;
							$today = date("Y-m-d");	
							$amount = 0;
	
							$query = "update halls set edate = '',price=$amount, username='', status='pending' where $today >edate ";
							$success = $link->query($query);
							if (!$success){
								die("Couldnt enter data: ".$link->error);
							}
							
							$sql = "select hallno from halls where status = 'pending'  ";
							if ($res = mysqli_query($link,$sql)){
								if(mysqli_num_rows($res)>0){
									   echo "<SELECT name = "."hallno"." >";
									while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
										
										echo "<OPTION>" . $row["hallno"] . "</OPTION>";
									}
									echo "</SELECT>";
								}
							}
						  ?>						  
					</div>
					 </div>						
						<div class="modal-footer">
						<input class="btn green" name="create" type="submit" value="Book Hall">
					    <button type="button" class="btn btn-default" data-dismiss="modal">
				     		  Cancel
						</button>
					  </div>
				  </div>
			    </div>
			  </div>
			 </form>	       
      </div>      
</body>
<footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>©RESORT MANAGEMENT</h5>
                </div>
            </div>
        </div>
    </footer>
</html>