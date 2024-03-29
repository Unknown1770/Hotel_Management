<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<title>Add Trip </title>
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
                   Book Room </a>
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
              <li> <a href="bookhall.php">Book Hall</a></li>
              <li> <a href="mybookings.php">My Bookings</a></li>
              <li> <a href="details.php"> My Details</a></li>
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
              
		
		<form role="form" action="search.php" method="POST">
		  <div class="modal-body">
		     <!--Sign up message from PHP file-->
			 <div id="signupmessage"></div>
			        					
					<div class="form-group">
						  <label for="uname" class="sr-only">uname:</label>
					      <input class="form-control" type="text" name="uname" id="uname" placeholder="User Name" maxlength="30">
					</div>
					
					<div class="form-group">
					  <label ><h5>Room Type:</h5></label>&nbsp;&nbsp;
					  <input type="radio" name="br" id="1br" value="1 Bedroom">
					  <label for="1br">1 Bedroom</label>
					  &nbsp;&nbsp;
					  <input type="radio" name="br" id="2br" value="2 Bedroom">
					  <label for="2br">2 Bedroom</label>
					</div>
					
					<div class="form-group">
						  <?php $today = date("Y-m-d") ?>
						  <label><h5>Check In Date:</h5></label>&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="date" name="cin" min="<?php echo($today);?>" required="">
							&nbsp;
							<br>
						  <?php $today = date("Y-m-d") ?>
						  <label><h5>Check Out Date:</h5></label>&nbsp;
							<input type="date" name="cout" min="<?php echo($today);?>" required="">
					</div>
				 </div>
						
			     <div class="modal-footer">
						<input class="btn green" name="create" type="submit" value="Search Rooms">
					    <button type="button" class="btn btn-default" data-dismiss="modal">
				     		  Cancel
						</button>
					  </div>
					  <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
							<h6><strong>Note:</strong> &nbsp;<span class="text-danger">Breakfast and Dinner is included in the Package</span>.</h6>
					  </div>
				  </div>
			     </div>
			 </form>	  
		
		
		
		
		
        
      </div>
      <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6><strong>Kindly Note:</strong>  <span class="text-danger">Please behave well with Others</span>.</h6>
        </div>
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