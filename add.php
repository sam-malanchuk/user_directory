<?php
$title="New Record";
session_start();
require('header.php'); 
include 'logininfo.php'; 

if (password_verify($sessionpassword1, $_SESSION["password"])) {
$_SESSION["password"] = password_hash($sessionpassword1, PASSWORD_DEFAULT);
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
		<div class="col-md-3">
		</div>
		<div class="col-md-6 top-buffer">
<form action="addrecord.php" method="post">
<div class="input-group form-group">
  <span class="input-group-addon">First Name</span>
  <input type="text" class="form-control" name="fname" required>
		<span class="input-group-addon">
			<span class="glyphicon glyphicon-user">
			</span>
		</span>
</div>
<div class="input-group form-group">
  <span class="input-group-addon">Last Name</span>
  <input type="text" class="form-control" name="lname" required>
</div>
<div class="form-group">
	<div class='input-group date' id='datetimepicker10'>
		<span class="input-group-addon">Birthdate</span>
		<input type='text' class="form-control" name="bday">
		<span class="input-group-addon">
			<span class="glyphicon glyphicon-calendar">
			</span>
		</span>
	</div>
</div>
<div class="input-group form-group">
  <span class="input-group-addon">Phone</span>
  <input type="tel" class="input-medium bfh-phone form-control" data-format="(ddd) ddd-dddd" name="tel" autocomplete="off">
		<span class="input-group-addon">
			<span class="glyphicon glyphicon-earphone">
			</span>
		</span>
</div>
    <div class="form-group row">
      <div class="col-sm-10">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" value="1" name="baptism"> Baptized
          </label>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-10">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" value="1" name="tmessages"> Receive Youth Messages
          </label>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-10">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" value="1" name="choir"> Member of Youth Choir
          </label>
        </div>
      </div>
    </div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker10').datetimepicker({
            viewMode: 'months',
            format: 'MM/DD'
        });
    });
</script>
<h4>Address:</h4>
<div class="input-group form-group">
  <span class="input-group-addon">Street</span>
  <input type="text" class="input-medium form-control" name="streetname" placeholder="1234 Streetname Dr.">
		<span class="input-group-addon">
			<span class="glyphicon glyphicon-map-marker">
			</span>
		</span>
</div>
<div class="form-group row">
<div class="col-sm-7">
<div class="input-group form-group">
  <span class="input-group-addon">City</span>
  <input type="text" class="input-medium form-control" name="city" placeholder="City Name">
</div>
</div>
<div class="col-sm-5">
<div class="input-group form-group">
  <span class="input-group-addon">Zip Code</span>
  <input type="text" class="input-medium form-control" name="zipcode" placeholder="12345">
</div>
</div>
</div>
<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-floppy-disk"></span> Add Record</button>
</form>
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
