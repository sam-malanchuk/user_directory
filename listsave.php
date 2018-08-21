<?php
session_start();
require('header.php'); include 'logininfo.php'; 

if (password_verify($sessionpassword1, $_SESSION["password"]) || password_verify($sessionpassword2, $_SESSION["password"])) {

$record = $_GET["r"];
if (isset($_POST["list_name"]) && !empty($_POST["list_name"])) {
	$list_name = $_POST["list_name"];
}
if (isset($_POST["list_id"]) && !empty($_POST["list_id"])) {
	$list_id = $_POST["list_id"];
}

$list_item = $_POST['list_item'];

for($i=0; $i < count($list_item); $i++){
	if ($i == 0) {
    $list_item_comma .= $list_item[$i];
	} else {
    $list_item_comma .=  ", " . $list_item[$i];
	}
}

//MySQL Database Connect
if (empty($list_id) && empty($list_name)) {
	header( 'Location: lists.php' ) ;
} else {
include 'datalogin.php'; 

$conn->set_charset("utf8");
if(empty($list_id)) {
$sql = "INSERT INTO table_views (name, table_values) VALUES ('$list_name', '$list_item_comma')";
} else {
$sql = "UPDATE table_views SET table_values='$list_item_comma' WHERE id='$list_id'";
}	
	
if ($conn->query($sql) === TRUE) {
	header( 'Location: lists.php?action=added' ) ;
} else {
	header( 'Location: lists.php?action=error' ) ;
    echo "Error updating record: " . $conn->error;
}
$conn->close();
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
</div>
<?php

} else {
	header( 'Location: index.php?m=x' ) ;
}

?>
