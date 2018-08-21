<?php
$title="Login";
session_start();
$_SESSION = array();
session_destroy();

require('header.php'); 

$m = $_GET['m'];
?>

<div class="container">
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<h1>Login</h1>
<?php
if ($m == "x") {
?><div class="alert alert-danger" role="alert">Oops.. That's incorrect.</div><?php
} else if ($m == "lo") {
?><div class="alert alert-success" role="alert">You have logged out!</div><?php
} else if ($m == "access") {
?><div class="alert alert-danger" role="alert">You do not have access!</div><?php
} else if ($m == "edit") {
?><div class="alert alert-danger" role="alert">Oops.. Please log in first!</div><?php
}	
?>
			<form action="dir.php" method="post">
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" autofocus>
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>
</div>

<?php require('footer.php'); ?>
