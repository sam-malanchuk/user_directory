<?php
$title="List";session_start();require('header.php'); 

if (isset($_POST["password"]) && !empty($_POST["password"])) {	$password = $_POST['password'];	$_SESSION["password"] = password_hash($password, PASSWORD_DEFAULT);}
$list = $_GET["list"];
$action = $_GET["action"];
$list_name = $_POST["list_name"];
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
			<a href="dir.php" class="btn btn-warning btn-lg top-buffer">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancel
			</a>
			<a class="btn btn-success btn-lg hidden-print top-buffer" onclick="document.getElementById('checklist_form').submit();">
				<span class="glyphicon glyphicon-list" aria-hidden="true"></span> Save List
			</a>
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
	<div class="col-md-12">
		<div class="alert alert-info" role="alert">Use the checkbox to select all the people for your list, then press submit.</div>
<?php

$sql = "SET character_set_results = 'utf8'";
$result = $conn->query($sql);
$sql = "SELECT * FROM youth_dir ORDER BY lname ASC";
$result = $conn->query($sql);
?>
<table class="table table-hover table-responsive">
  <thead>
    <tr>
<form action="listsave.php" method="post" id="checklist_form">
<?php if($action == "update") {?>
<input type="number" name="list_id" value="<?php echo $list ?>" hidden>
<?php } else { ?>
<input type="text" name="list_name" value="<?php echo $list_name ?>" hidden>
<?php } ?>
      <th class="list_checkmark">Add to List</th>
      <th>#</th>
      <th>Last Name <span class="glyphicon glyphicon-triangle-bottom"></span></th>
      <th>First Name</th>
      <th>Birthdate</th>
      <th>Phone Number</th>
      <th class="hidden-print">Baptism</th>
      <th>Youth Texts</th>
      <th>Choir</th>
      <th class="hidden-print">View</th>
<?php if (password_verify($sessionpassword1, $_SESSION["password"])) { ?>
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
      <td class="list_checkmark"><input type="checkbox" name="list_item[]" value="<?php echo $row["ID"] ?>"></td>
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
} else {
$rowid = 1;
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>
    <tr class="result_item">
      <td class="list_checkmark"><input type="checkbox" name="list_item[]" value="<?php echo $row["ID"] ?>"></td>
      <th scope="row"><?php echo $rowid ?></th>
      <td><?php echo $row["lname"] ?></td>
      <td><?php echo $row["fname"] ?></td>
      <td><?php if ($row["bday"] == "0000-00-00") { echo "<font color='red'>N/A</font>"; } else { echo date("M j", strtotime($row["bday"])); } ?></td>
      <td><?php if (preg_match('/(^|\D)\d{10}($|\D)/', $row["tel"])) { echo '('.substr($row["tel"], 0, 3).') '.substr($row["tel"], 3, 3).'-'.substr($row["tel"],6); } else { echo "<font color='red'>N/A</font>"; } ?></td>
      <td class="hidden-print"><?php if ($row["baptism"] == "1") { echo "Baptized"; } else { echo "Not Baptized"; } ?></td>
      <td><?php if ($row["tmessages"] == "1") { echo "Receive Texts"; } else { echo "No Texts"; } ?></td>
      <td><?php if ($row["choir"] == "1") { echo "Choir Member"; } else { ?>Non-Member<?php } ?></td>
	  <td class="hidden-print"><a href="view.php?r=<?php echo $row["ID"] ?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> View</a></td>
    </tr>
<?php
$rowid++;
    }
} else {
    echo "0 results";
}

}
if($action == "update") {
$sql = "SET character_set_results = 'utf8'";
$result = $conn->query($sql);
$sql = "SELECT table_values FROM table_views WHERE id ='$list'";
$result = $conn->query($sql);

 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$table_values = $row["table_values"];
	}
} else {
	header( 'Location: lists.php?action=error' ) ;
}	
?>
<script>
  var table_values = <?php echo json_encode($table_values); ?>;
//  alert(table_values);
var myarray = table_values.split(', ');

for(var i = 0; i < myarray.length; i++)
{
	$('input[value=' + myarray[i] + ']').click(); 
}
</script>
<?php
}

$conn->close();
?>
  </tbody>
</table>
			<a class="btn btn-success btn-lg hidden-print" onclick="document.getElementById('checklist_form').submit();">
				<span class="glyphicon glyphicon-list" aria-hidden="true"></span> Save List
			</a>
			</form>
		</div>
	</div>
</div>

<?php require('footer.php'); 

} else {
	header( 'Location: index.php?m=x' ) ;
}
?>
