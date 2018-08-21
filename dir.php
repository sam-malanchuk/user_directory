<?php
$title="List";session_start();require('header.php'); 

if (isset($_POST["password"]) && !empty($_POST["password"])) {	$password = $_POST['password'];	$_SESSION["password"] = password_hash($password, PASSWORD_DEFAULT);}
$message = $_GET["m"];
$listnumber = $_GET["list"];
include 'logininfo.php'; 
if (password_verify($sessionpassword1, $_SESSION["password"]) || password_verify($sessionpassword2, $_SESSION["password"])) {

//MySQL Database Connect
include 'datalogin.php'; 
?>

<div class="container">
	<div class="row hidden-print">
		<div class="col-md-12">
			<a href="index.php?m=lo" class="btn btn-danger btn-lg top-buffer">
				<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout
			</a>
			<a href="dir.php" class="btn btn-info btn-lg top-buffer">
				<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Refresh
			</a>
			<a href="lists.php" class="btn btn-warning btn-lg top-buffer">
				<span class="glyphicon glyphicon-list" aria-hidden="true"></span> Lists
			</a>
<?php if ($message == "uselist") { ?>
			<a href="listselect.php?list=<?php echo $listnumber ?>&action=update" class="btn btn-warning btn-lg top-buffer">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit this List
			</a>
<?php } if (password_verify($sessionpassword1, $_SESSION["password"])) { ?>
			<a href="add.php" class="btn btn-success btn-lg top-buffer">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Record
			</a>
<?php } ?>
		</div>
	</div>
<div class="row top-buffer hidden-print">
  <div class="col-md-12">
		<div class="input-group">
			<span class="input-group-addon">Universal Search:</span>
			<input type="text" class="form-control" placeholder="Start Typing..." id="searchun">
		</div>
  </div>
</div>
<div class="row top-buffer">
<?php
if (password_verify($sessionpassword1, $_SESSION["password"])) {
?>
	<div class="col-md-12">
<?php
} else {
?>
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
<?php
}


if ($message == "update") {
?><div class="alert alert-success hidden-print" role="alert">The record was updated!</div><?php
} else if ($message == "updateadd") {
?><div class="alert alert-success hidden-print" role="alert">The record was added!</div><?php
} else if ($message == "errordelete") {
?><div class="alert alert-danger hidden-print" role="alert">Error deleting record!</div><?php
} else if ($message == "updatedelete") {
?><div class="alert alert-success hidden-print" role="alert">The record was deleted!</div><?php
} else if ($message == "access") {
?><div class="alert alert-danger hidden-print" role="alert">You do not have access to edit!</div><?php
} else if ($message == "erroradd") {
?><div class="alert alert-danger hidden-print" role="alert">Error adding record!</div><?php
} else if ($message == "error") {
?><div class="alert alert-danger hidden-print" role="alert">Error adding record!</div><?php
} else if ($message == "uselist") {
if (password_verify($sessionpassword1, $_SESSION["password"])) {
?><div class="alert alert-danger hidden-print" role="alert">Deleting someone will delete them from the database not the list! <b>Use list update function to remove people from a list.</b></div><?php
}}

if ($message == "uselist") {
$sql = "SELECT table_values FROM table_views WHERE id='$listnumber'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $table_values = $row["table_values"];
    }}
$sql = "SET character_set_results = 'utf8'";
$result = $conn->query($sql);
$sql = "SELECT * FROM youth_dir WHERE ID IN ($table_values) ORDER BY lname ASC";
$result = $conn->query($sql);
} else {
$sql = "SET character_set_results = 'utf8'";
$result = $conn->query($sql);
$sql = "SELECT * FROM youth_dir ORDER BY lname ASC";
$result = $conn->query($sql);
}
?>
<table class="table table-hover table-responsive">
  <thead>
    <tr>
      <th>#</th>
      <th>Last Name <span class="glyphicon glyphicon-triangle-bottom"></span></th>
      <th>First Name</th>
<?php if (password_verify($sessionpassword1, $_SESSION["password"])) { ?>
      <th>Birthdate</th>
      <th>Phone Number</th>
      <th class="hidden-print">Baptism</th>
      <th>Youth Texts</th>
      <th>Choir</th>
      <th class="hidden-print">View</th>
      <th class="hidden-print">Edit</th>
      <th class="hidden-print">Delete</th>
<?php } ?>
    </tr>
  </thead>
  <tbody>
<?php
if (password_verify($sessionpassword1, $_SESSION["password"])) {
$rowid = 1;
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>
    <tr class="result_item">
      <th scope="row"><?php echo $rowid ?></th>
      <td><?php echo $row["lname"] ?></td>
      <td><?php echo $row["fname"] ?></td>
      <td><?php if ($row["bday"] == "0000-00-00") { echo "<font color='red'>N/A</font>"; } else { echo date("M j", strtotime($row["bday"])); } ?></td>
      <td><?php if (preg_match('/(^|\D)\d{10}($|\D)/', $row["tel"])) { echo '('.substr($row["tel"], 0, 3).') '.substr($row["tel"], 3, 3).'-'.substr($row["tel"],6); } else { echo "<font color='red'>N/A</font>"; } ?></td>
      <td class="hidden-print"><?php if ($row["baptism"] == "1") { echo "Baptized"; } else { echo "Not Baptized"; } ?></td>
      <td><?php if ($row["tmessages"] == "1") { echo "Receive Texts"; } else { echo "No Texts"; } ?></td>
      <td><?php if ($row["choir"] == "1") { echo "Choir Member"; } else { ?>Non-Member<?php } ?></td>
	  <td class="hidden-print"><a href="view.php?r=<?php echo $row["ID"] ?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> View</a></td>
	  <td class="hidden-print"><a href="edit.php?r=<?php echo $row["ID"] ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a></td>
	  <td class="hidden-print"><a href="del.php?r=<?php echo $row["ID"] ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a></td>
    </tr>
<?php
$rowid++;
    }
} else {
    echo "0 results";
}
$conn->close();
} else {
$rowid = 1;
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>
    <tr class="result_item">
      <th scope="row"><?php echo $rowid ?></th>
      <td><?php echo $row["lname"] ?></td>
      <td><?php echo $row["fname"] ?></td>
    </tr>
<?php
$rowid++;
    }
} else {
    echo "0 results";
}
$conn->close();

}
?>
  </tbody>
</table>
			<a href="index.php?m=lo" class="btn btn-danger btn-lg hidden-print">
				<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout
			</a>
		</div>
	</div>
</div>

<?php require('footer.php'); 


} else {
	header( 'Location: index.php?m=x' ) ;
}
?>
