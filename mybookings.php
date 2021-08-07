<!DOCTYPE html>
<html>
	<?php 
		session_start();
		require 'connection.php';
		$conn = Connect();
	?>
	<head>
		<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
		<link rel="stylesheet" href="assets/w3css/w3.css">
		<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
		<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
	</head>
	<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<!-- Navigation -->
		<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
						<i class="fa fa-bars"></i>
						</button>
					<a class="navbar-brand page-scroll" href="index.php">
					   RIDE SHARE </a>
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
				  <li> <a href="bookhall.php">Book Halls</a></li>
				  <li> <a href="addroom.php"> Book Rooms</a></li>
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

		$login_customer = $_SESSION['login_customer']; 
		$user = $_SESSION['login_customer']; 
		$link = @mysqli_connect("localhost","root","enormousviju1770","resorts") or die ("Error: Unable to connect: ".mysqli_connect_error()) ;
		$sql = "SELECT * from rooms where uname='$user' " ;
		if ($res = mysqli_query($link,$sql)){
			if(mysqli_num_rows($res)>0){

	?>


	<div class="container">
		  <div class="jumbotron">
			<h1 class="text-center" style="color: green;" >Room Bookings</h1>
			</br>
	<?php
				$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$sql1 = "Select * from rooms where uname = '$user' ";
				$res1 = mysqli_query($link, $sql1);
				echo "<table class='table table-hover table-striped table-condensed table-bordered'>
									  <tr>
									  <th>Sl No.</th>
									  <th>Room No</th>
									  <th>Room Type</th>
									  <th>Check In</th>
									  <th>Check Out</th>
									  <th>Status</th>
									  <th>Total Price</th>																  
								";
								$x=1	;
								while($row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC)){
									echo "<tr>";
									echo "<td>" . $x++ . "</td>";
									echo "<td>" . $row1["roomno"] . "</td>";
									echo "<td>" . $row1["type"] . "</td>";
									echo "<td>" . $row1["checkin"] . "</td>";
									echo "<td>" . $row1["checkout"] . "</td>";
									echo "<td>" . $row1["status"] . "</td>";
									echo "<td>" . $row1["price"] . "</td>";																	
								}
								echo "</table>";
								mysqli_free_result($res);		
		
	?>

				
			</br>
			
			</div>
		</div>

			<?php } else { 
				?>
			<div class="container">
			  <div class="jumbotron">
				<h1>No booked Rooms </h1>
				<p> <a href="addroom.php">Book a Room Now </a> </p>
			  </div>
			</div>
			<?php } ?>			
		<?php } ?>
		
		
		
		
		
		
		
		<?php 

		$sql = "SELECT * from halls where username='$user' " ;
		if ($res = mysqli_query($link,$sql)){
			if(mysqli_num_rows($res)>0){

	?>


	<div class="container">
		  <div class="jumbotron">
			<h1 class="text-center" style="color: green;" >Hall Bookings</h1>
			</br>

	<?php
				$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$sql1 = "Select * from halls where username = '$user' ";
				$res1 = mysqli_query($link, $sql1);
				echo "<table class='table table-hover table-striped table-condensed table-bordered'>
									  <tr>
									  <th>Sl No.</th>
									  <th>Hall No</th>
									  <th>Food Type</th>
									  <th>Event Date</th>
									  <th>Event Time</th>
									  <th>Status</th>
									  <th>Total Price</th>																  
								";
								$x=1	;
								while($row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC)){
									echo "<tr>";
									echo "<td>" . $x++ . "</td>";
									echo "<td>" . $row1["hallno"] . "</td>";
									echo "<td>" . $row1["ftype"] . "</td>";
									echo "<td>" . $row1["edate"] . "</td>";
									echo "<td>" . $row1["etime"] . "</td>";
									echo "<td>" . $row1["status"] . "</td>";
									echo "<td>" . $row1["price"] . "</td>";																	
								}
								echo "</table>";
								mysqli_free_result($res);		
		
	?>

				
			</br>
			
			</div>
		</div>

			<?php } else { 
				?>
			<div class="container">
			  <div class="jumbotron">
				<h1>No booked Rooms </h1>
				<p> <a href="addroom.php">Book a Room Now </a> </p>
			  </div>
			</div>
			<?php } ?>			
		<?php } ?>
		
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