<!DOCTYPE html>
<html>

<?php 
    include('session_customer.php');
	if(!isset($_SESSION['login_customer'])){
		session_destroy();
		header("location: customerlogin.php");
	}
	$login_customer = $_SESSION['login_customer']; 
	$user = $_SESSION['login_customer']; 
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
    //defining errors 
	$missingname = '<p><strong>Please enter Your Name!</strong></p>';
	$missingphone = '<p><strong>Please enter Your Phone Number!</strong></p>';
	$missingguest = '<p><strong>Please enter Number of Guests!</strong></p>';
	$missingfood = '<p><strong>Please enter Food Type!</strong></p>';
	$missinghall = '<p><strong>Please Select a Hall!</strong></p>';
	$errors = '';
	
	//checking name
	if(empty($_POST["name"])){
		$errors .= $missingname;
	}else{
		$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);   
	}
	
	//checking phone number
	if(empty($_POST["phonenumber"])){
		$errors .= $missingphone;
	}else{
		$phonenumber = filter_var($_POST["phonenumber"], FILTER_SANITIZE_STRING);   
	}
	
	//checking Guest Number
	if(empty($_POST["guest"])){
		$errors .= $missingguest;
	}else{
		$guest = filter_var($_POST["guest"], FILTER_SANITIZE_STRING);   
	}
	
	//checking Food Type
	if(empty($_POST["food"])){
		$errors .= $missingfood;
	}else{
		$ftype = filter_var($_POST["food"], FILTER_SANITIZE_STRING);   
	}
	
	//checking Food Type
	if(empty($_POST["hallno"])){
		$errors .= $missinghall;
	}else{
		$hallno = filter_var($_POST["hallno"], FILTER_SANITIZE_STRING);   
	}
	
	
    $date = date('Y-m-d', strtotime($_POST['date']));
    $time = $_POST['time'];
	$price = ($guest * 150) + 600;
     
    //CHECKING FOR ANY ERRORS
    if($errors){
		$resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
		echo $resultMessage;
		exit;
	}	 
	
		
	
    // PREPARING THE QUERIES FOR INSERTING INTO TRIPS TABLE
    $name = mysqli_real_escape_string($conn, $name);
	$user = mysqli_real_escape_string($conn, $user);
	$phonenumber = mysqli_real_escape_string($conn, $phonenumber);
	$guest = mysqli_real_escape_string($conn, $guest);
	$ftype = mysqli_real_escape_string($conn, $ftype);
	$hallno = mysqli_real_escape_string($conn, $hallno);
	$price = mysqli_real_escape_string($conn, $price);
	
		
	$query = "update halls set status='confirmed',name='$name',username='$user',guest='$guest',pno='$phonenumber',price='$price',edate='$date', etime='$time',ftype='$ftype' where hallno ='$hallno' ";
		
	$success = $conn->query($query);
	if (!$success){
		die("Couldnt enter data: ".$conn->error);
	}

	$conn->close();	
	
?>
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
              <li> <a href="createtrip.php">Create Trip</a></li>
              <li> <a href="addtrip.php">Join Trip</a></li>
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
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Hall Booked Succesfully.</h1>
        </div>
    </div>
    <br>
 

    <div class="container">
        <h5 class="text-center">Please read the following information about your Booking.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">Your Hall has been created.</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
				<h4> <strong>Name: </strong> <?php echo $name; ?></h4>
                <br>
				<h4> <strong>Phone Number:</strong> <?php echo $phonenumber; ?></h4>
                <br>
                <h4> <strong>Number of Guests:</strong> <?php echo $guest; ?></h4>
                <br>
				<h4> <strong>Food Type:</strong> <?php echo $ftype; ?></h4>
                <br>
				<h4> <strong>Trip Date and Time:</strong> <?php echo $date ."    ".  $time  ; ?></h4>
                <br>
				<h4> <strong>Total Price:</strong> <?php echo $price ; ?></h4>
                <br>
                
                <?php     
                if($price <0 ){
                ?>
                     <h4> <strong>Total Price:</strong> ₹<?php echo $price; ?>/day</h4>
                

                <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>OOps Some Error came Up: </strong> </h4>
                
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h6>
        </div>
    </div>
</body>
<?php } else { ?>
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
              <li> <a href="createtrip.php">Create Trip</a></li>
              <li> <a href="mybookings.php">Join Trips</a></li>
			  <li> <a href="mybookings.php">My Bookings</a></li>
			  <li> <a href="details.php"> Car Details</a></li>
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
	</div>
	</div>
    
	
                <?php } ?>
</body>
<footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© RESORT MANAGEMENT</h5>
                </div>
            </div>
        </div>
    </footer>
</html>