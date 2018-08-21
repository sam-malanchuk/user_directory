<?php
session_start();
require('header.php');
include 'logininfo.php'; 

if (password_verify($sessionpassword1, $_SESSION["password"])) {
$lname = $_POST["lname"];
$fname = $_POST["fname"];
$bday = $_POST["bday"];
$id = $_POST["id"];
$tmessages = $_POST["tmessages"];
$choir = $_POST["choir"];
$street = $_POST["streetname"];
$zipcode = $_POST["zipcode"];
$city = $_POST["city"];
$baptism = $_POST["baptism"];
$tel = preg_replace(array('/[^0-9-_\.]/', '/-/'), '', $_POST["tel"]);
if ($bday == "") { $my_date = "0000-00-00"; } else { $my_date = date('Y-m-d', strtotime($bday)); }

//MySQL Database Connect
include 'datalogin.php'; 

$conn->set_charset("utf8");
$sql = "UPDATE youth_dir SET lname = '$lname', fname = '$fname', tel = '$tel', bday = '$my_date', tmessages = '$tmessages', baptism = '$baptism', choir = '$choir', zipcode = '$zipcode', city = '$city', street = '$street' WHERE ID = $id";

if ($conn->query($sql) === TRUE) {
	header( 'Location: dir.php?m=update' ) ;
} else {	header( 'Location: dir.php?m=error' ) ;
    echo "Error updating record: " . $conn->error;}
$conn->close();
?>
<div class="container">
	<div class="row">
	<div class="col-md-12">
	<a href="edit.php?r=<?php echo $id; ?>" class="btn btn-info btn-lg">
	<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back			</a>
	<a href="index.php?m=lo" class="btn btn-danger btn-lg">
	<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout			</a>
	</div>
	</div>
	</div>
<?php
} elseif (password_verify($sessionpassword2, $_SESSION["password"])) {
	header( 'Location: dir.php?m=access' ) ;
	} else {	header( 'Location: index.php?m=x' ) ;}
?>