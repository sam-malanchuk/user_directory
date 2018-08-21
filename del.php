<?php
session_start();
require('header.php'); include 'logininfo.php'; 
if (password_verify($sessionpassword1, $_SESSION["password"])) {

$record = $_GET["r"];

//MySQL Database Connect
include 'datalogin.php'; 

$conn->set_charset("utf8");
$sql = "SELECT lname, fname FROM youth_dir WHERE ID = $record";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$lname = $row["lname"];
	$fname = $row["fname"];
    }
} else {
	header( 'Location: dir.php?m=errordelete' ) ;
}
$conn->close();
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="dir.php" class="btn btn-info btn-lg top-buffer">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back
			</a>
			<a href="index.php?m=lo" class="btn btn-danger btn-lg top-buffer">
				<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout
			</a>
		</div>
		<div class="col-md-12 top-buffer">
			<div class="jumbotron">
			<p>Are you sure you would like to delete record <b>#<?php echo $record; ?></b>: <b><?php echo $lname; ?>, <?php echo $fname; ?></b>?</p>
			<a href="dir.php" class="btn btn-info btn-lg">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancel
			</a>
			<a href="delete.php?r=<?php echo $record ?>" class="btn btn-danger btn-lg">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
			</a>
			</div>
		</div>
	</div>
</div>
<?php

} elseif (password_verify($sessionpassword2, $_SESSION["password"])) {
	header( 'Location: dir.php?m=access' ) ;
} else {
	header( 'Location: index.php?m=x' ) ;
}

?>
