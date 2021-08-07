<!DOCTYPE html>
<html>

<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>

<body>

<?php
    $missingUsername = '<p><strong>Please enter a username!</strong></p>';
    $missingRoom = '<p><strong>Please enter a Room Type!</strong></p>';
	$errors = '';
	if(empty($_POST["uname"])){
		$errors .= $missingUsername;
	}else{
		$uname = filter_var($_POST["uname"], FILTER_SANITIZE_STRING);   
	}
	
	if(empty($_POST["br"])){
		$errors .= $missingRoom;
	}else{
		$bedroom = filter_var($_POST["br"], FILTER_SANITIZE_STRING);   
	}
	
	//CHECKING FOR ANY ERRORS
    if($errors){
		$resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
		echo $errors;
		exit;
	}
	
	$cin = date('Y-m-d', strtotime($_POST['cin']));
	$cout = date('Y-m-d', strtotime($_POST['cout']));
	
	$link = @mysqli_connect("localhost","root","enormousviju1770","resorts") or die ("Error: Unable to connect: ".mysqli_connect_error()) ;
	
	$today = date("Y-m-d");	
	
	$query = "update rooms set checkin = '', checkout='',price='0',uname='', status='pending' where $today >checkout ";
	$success = $link->query($query);
	if (!$success){
		die("Couldnt enter data: ".$link->error);
	}
?>

<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   RESORT MANAGEMENT </a>
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
                <li> <a href="addroom.php">Book Rooms</a></li>
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
	
	<?php
			
		$sql = "select sl,roomno,type from rooms where status = 'pending' AND type ='$bedroom' ";
		if ($res = mysqli_query($link,$sql)){
			if(mysqli_num_rows($res)>0){
	?>
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Rooms Available</h1>
        </div>
    </div>
    <div class="container">
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <?php
						
							echo "<table class='table table-hover table-striped table-condensed table-bordered'>
								  <tr>
								  <th>Sl No</th>
								  <th>Room No.</th>
								  <th>Room Type</th>
								  <th> Room Price</th>
								  <th> Book Now</th>
								  
							";
							while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
								echo "<tr>";
								echo "<td>" . $row["sl"] . "</td>";
								echo "<td>" . $row["roomno"] . "</td>";
								echo "<td>" . $row["type"] . "</td>";
								echo "<td>" . "<p> Rs 1500/- </p>" . "</td>";
								echo "<td>" . "<p> <a href='booknow.php'>Book Now</a> </p>" . "</td>";
							}
							echo "</table>";
							mysqli_free_result($res);
													   

				?>
						
			</div>
			<div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
				<h6>NOTE:  <strong>Please Note Down the Room No. </strong> for booking the Rooms.</h6>
				</div>
			</div>
		</div>
	
	
	
	<?php }else { ?>
			<!-- Navigation -->
		
				<div class="container">
				<div class="jumbotron">
					<h1 class="text-center" style="color: red;"><span class="glyphicon glyphicon-remove-circle"></span> No Rooms Found</h1>
				</div>
			</div>
			<br>
			<h2 class="text-center"> Thank you for Booking with us. </h2></br>
			  <div class="container">
				<h5 class="text-center">Sorry, Currently there is no Room available for you :( </h5>
				<h5 class="text-center"><strong><a href="addroom.php"> Search Another Room With different type? </strong> </a> .</h5>
			 </div>
				<!-- Collect the nav links, forms, and other content for toggling -->
	
	
	</body>
	<?php } ?>
		
	
		<?php } ?>	
<footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h5>© RIDE SHARE</h5>
            </div>
        </div>
    </div>
</footer>

</html>