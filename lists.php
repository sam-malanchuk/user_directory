<?php
$title="Lists";
session_start();
require('header.php'); 
include 'logininfo.php'; 
$action = $_GET['action'];
$listid = $_GET['list'];


if (password_verify($sessionpassword1, $_SESSION["password"]) || password_verify($sessionpassword2, $_SESSION["password"])) {
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="index.php?m=lo" class="btn btn-danger btn-lg top-buffer">
				<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout
			</a>
<?php if($action == "new") { ?>
			<a href="lists.php" class="btn btn-info btn-lg top-buffer">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back
			</a>
<?php } else { ?>
			<a href="dir.php" class="btn btn-info btn-lg top-buffer">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back
			</a>
			<a href="lists.php?action=new" class="btn btn-warning btn-lg top-buffer">
				<span class="glyphicon glyphicon-list" aria-hidden="true"></span> New List
			</a>
<?php } ?>
		</div>
	</div>
<div class="row top-buffer">
	<div class="col-md-12">
<?php
if ($action == "added") {
?><div class="alert alert-success" role="alert">The list was updated!</div><?php
} else if ($action == "error") {
?><div class="alert alert-danger" role="alert">There was some issue!</div>
<?php } ?>
	</div>		
</div>		
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
<?php
//MySQL Database Connect
include 'datalogin.php'; 

if($action == "new") {
?>
<div class="alert alert-warning" role="alert">Some special characters are restricted.</div>
<form action="listselect.php" method="post">
	<div class="form-group">
	<label for="name">List Name:</label>
		<input type="text" class="form-control" name="list_name" placeholder="Example: Sams List for Choir" onkeypress="return blockSpecialChar(event)" autocomplete="off" autofocus>
	</div>
	<button type="submit" class="btn btn-default">Add people to list</button>
</form>
    <script type="text/javascript">
        function blockSpecialChar(e) {
            var k = e.keyCode;
            return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8  || (k >= 48 && k <= 57) || k == 32 || k == 45);
        }
    </script>
<?php
} else {
?><div class="panel panel-default top-buffer">
  <div class="panel-heading">
    <h3 class="panel-title text-center"><strong>Views List</strong></h3>
  </div>
  <div class="panel-body">
	<p>To view click the table view name.</p>
  </div>
<table class="table table-responsive">
	<thead>
		<tr><td><strong>List Name</strong></td><td><strong>Update</strong></td><td><strong>Delete</strong></td></tr>
	</thead>
	<tbody><?php

if ($action == "delete") {
// sql to delete a record
$sql = "DELETE FROM table_views WHERE id='$listid'";
$result = $conn->query($sql);
}
$sql = "SET character_set_results = 'utf8'";
$result = $conn->query($sql);
$sql = "SELECT * FROM table_views";
$result = $conn->query($sql);

 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$name = $row["name"];
	$id = $row["id"];
	$table_values = $row["table_values"];
	?><tr><td><a href="dir.php?list=<?php echo $id ?>&m=uselist"><?php echo $name ?></a></td><td><a href="listselect.php?list=<?php echo $id ?>&action=update">Update</a></td><td><a onclick="return confirm_alert(this);" href="lists.php?list=<?php echo $id ?>&action=delete">Delete</a></td></tr><?php
	}
} else {
?><?php
}
$conn->close();
?>
	</tbody>
</table>
</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function confirm_alert(node) {
    return confirm("You are about to delete the list forever.");
}
</script>
<?php
}
} elseif (password_verify($sessionpassword2, $_SESSION["password"])) {
	header( 'Location: dir.php?m=access' ) ;
} else {
	header( 'Location: index.php?m=edit' ) ;
}
?>
