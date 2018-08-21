<?php
session_start();
require('header.php'); include 'logininfo.php'; 

if (password_verify($sessionpassword1, $_SESSION["password"])) {

$record = $_GET["r"];

//MySQL Database Connect
include 'datalogin.php'; 

$conn->set_charset("utf8");
$sql = "DELETE FROM youth_dir WHERE ID=$record";

if ($conn->query($sql) === TRUE) {
	header( 'Location: dir.php?m=updatedelete' ) ;
} else {
	header( 'Location: dir.php?m=errordelete' ) ;
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="edit.php?r=<?php echo $id; ?>" class="btn btn-info btn-lg top-buffer">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back
			</a>
			<a href="index.php?m=lo" class="btn btn-danger btn-lg top-buffer">
				<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout
			</a>
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
