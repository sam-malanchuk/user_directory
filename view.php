<?php
$title="View";
session_start();
require('header.php'); 
include 'logininfo.php'; 
$record = $_GET['r'];

if (password_verify($sessionpassword1, $_SESSION["password"])) {
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
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
<?php
//MySQL Database Connect
include 'datalogin.php'; 

$sql = "SET character_set_results = 'utf8'";
$result = $conn->query($sql);
$sql = "SELECT * FROM youth_dir WHERE ID = $record";
$result = $conn->query($sql);

 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$id = $row["ID"];
	$lname = $row["lname"];
	$fname = $row["fname"];
	$tel = $row["tel"];
	$tmessages = $row["tmessages"];
	$baptism = $row["baptism"];
	$choir = $row["choir"];
	$bday = $row["bday"];
	$zipcode = $row["zipcode"];
	$city = $row["city"];
	$street = $row["street"];    }
} else {
?><div class="alert alert-danger" role="alert">The record requested doesn't exist.  Go Back</div><?php
}
$conn->close();
?>

<div class="panel panel-default top-buffer">
  <div class="panel-heading">
    <h3 class="panel-title text-center"><strong><?php echo $fname . " " . $lname ?></strong></h3>
  </div>
<table class="table table-responsive">
	<tbody>
		<tr>
			<td class="text-center" colspan="2"><strong>Personal</strong></td>
		</tr>
		<tr>
			<td>Birthdate:</td>
			<td><?php if ($bday == "0000-00-00") { echo "<font color='red'>N/A</font>"; } else { echo date("M j", strtotime($bday)); } ?></td>
		</tr>
		<tr>
			<td>Phone:</td>
			<td><?php if (preg_match('/(^|\D)\d{10}($|\D)/', $tel)) { echo '('.substr($tel, 0, 3).') '.substr($tel, 3, 3).'-'.substr($tel,6); } else { echo "<font color='red'>N/A</font>"; } ?></td>
		</tr>
		<tr>
			<td>Baptized:</td>
			<td><?php if ($baptism == "1") { echo "Yes"; } else { echo "No"; } ?></td>
		</tr>
		<tr>
			<td>Youth Messages:</td>
			<td><?php if ($tmessages == "1") { echo "Yes"; } else { echo "No"; } ?></td>
		</tr>
		<tr>
			<td>Youth Choir:</td>
			<td><?php if ($choir == "1") { echo "Yes"; } else { echo "No"; } ?></td>
		</tr>
		<tr>
			<td class="text-center" colspan="2"><strong>Address</strong></td>
		</tr>
		<tr>
			<td>Street:</td>
			<td><?php if ($street == "") { echo "<font color='red'>N/A</font>"; } else { echo $street; } ?></td>
		</tr>
		<tr>
			<td>City:</td>
			<td><?php if ($city == "") { echo "<font color='red'>N/A</font>"; } else { echo $city; } ?></td>
		</tr>
		<tr>
			<td>Zip Code:</td>
			<td><?php if ($zipcode == "0") { echo "<font color='red'>N/A</font>"; } else { echo $zipcode; } ?></td>
		</tr>
	</tbody>
</table>
</div>


		</div>
	</div>
</div>
<?php
} elseif (password_verify($sessionpassword2, $_SESSION["password"])) {
	header( 'Location: dir.php?m=access' ) ;
} else {
	header( 'Location: index.php?m=edit' ) ;
}
?>
