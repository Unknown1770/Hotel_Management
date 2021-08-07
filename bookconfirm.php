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
	$link = @mysqli_connect("localhost","root","enormousviju1770","resorts") or die ("Error: Unable to connect: ".mysqli_connect_error()) ;
	$missingid = '<p><strong>Please enter the Room No</strong></p>';
	$missingname = '<p><strong>Please enter Your UserName</strong></p>';
	$errors = '';
	
	//checking name
	if(empty($_POST["roomno"])){
		$errors .= $missingid;
	}else{
		$roomno = filter_var($_POST["roomno"], FILTER_SANITIZE_STRING);   
	}
	
	//checking name
	if(empty($_POST["name"])){
		$errors .= $missingname;
	}else{
		$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);   
	}
	
		
		
	//CHECKING FOR ANY ERRORS
    if($errors){
		$resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
		echo $resultMessage;
		exit;
	}
		
	$cin = date('Y-m-d', strtotime($_POST['cin']));
	$cout = date('Y-m-d', strtotime($_POST['cout']));
		

	// CONVERTING TOTAL DAYS
	$date1=date_create($cin);
	$date2=date_create($cout);
	$diff=date_diff($date1,$date2);
	$day = $diff->format("%a");
	$price = $day * 1500 + 600;
		
		
	$sql = "select * from rooms where roomno ='$roomno' ";
	if ($res = mysqli_query($link,$sql)){
		if(mysqli_num_rows($res)>0){
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
		    $roomno = $row["roomno"];	
		    $sl = $row["sl"];	
		    $type = $row["type"];	
			$status = $row["status"];
		
		mysqli_free_result($res);
		}else{
			echo "<p> It returns an empty result set</p>";
		}
	}else{
		echo "<p> Unable to execute: $sql. " . mysqli_error($link). "</p>";
	}
	
	
	//preparing the queries to put it into bookings table
	$roomno = mysqli_real_escape_string($link, $roomno);
	$name = mysqli_real_escape_string($link, $name);
	
		
	$query = "update rooms set status = 'confirmed', uname='$name', checkin='$cin', checkout='$cout',price='$price' where roomno ='$roomno' ";
		
	$success = $link->query($query);
	if (!$success){
		die("Couldnt enter data: ".$link->error);
	}
	
	
	$link->close();
    
?>


<!-- Navigation -->
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
                        <a href="clientlogin.php">Admin</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Users</a>
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
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Room Booked Succesfully.</h1>
        </div>
    </div>

    <h2 class="text-center"> Thank you For booking with us. </h2>
 

    <div class="container">
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">Your Booking Details</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>UserName: </strong> <?php echo $name; ?></h4>
                <br>
				<h4> <strong>Room Number:</strong> <?php echo $roomno; ?></h4>
                <br>
                <h4> <strong>Room Type:</strong> <?php echo $type; ?></h4>
                <br>
				<h4> <strong>Room Status:</strong> <?php echo "Confirmed"; ?></h4>
                <br>
				<h4> <strong>Total Cost:</strong> <?php echo $price ."/- + Taxes " ; ?></h4>
				<br>
            </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6 style="text-align:red;">Warning! <strong>Do not reload this page</strong> or the above display will be lost. </h6>
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