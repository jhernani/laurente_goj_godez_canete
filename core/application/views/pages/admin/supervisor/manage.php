<div class="container main"> <!-- content start -->
	<div class="col-xs-4">
    	<div class="profile">
        	<img src="<?php echo assets_url() . $path ?>" class="img-thumbnail img-responsive">
        </div>
    </div>
    <div class="col-xs-8">
    	<div class="page-header">
          <h1><?php echo $name ?></h1>
        </div>
		<div class="row">
			<div class="list-group-item">User Details</div>
			<table class="table">
				<tr>
					<td><b>Student ID</b></td>
					<td><?php echo $ismis_id ?></td>
				</tr>
				<tr>
					<td><b>Course</b></td>
					<td><?php echo $course ?></td>
				</tr>
				<tr>
					<td><b>Year</b></td>
					<td><?php echo $yr_lvl ?></td>
				</tr>
				<tr>
					<td><b>Birth Date</b></td>
					<td><?php echo $bdate ?></td>
				</tr>
				<tr>
					<td><b>ender</b></td>
					<td><?php echo $gender ?></td>
				</tr>
				<tr>
					<td><b>E-mail Address</b></td>
					<td><?php echo $email ?></td>
				</tr>
				<tr>
					<td><b>Contact Number</b></td>
					<td><?php echo $contact ?></td>
				</tr>
				<tr>
					<td><b>Guardian</b></td>
					<td><?php echo $guardian ?></td>
				</tr>
			</table>
		</div>
		<div class="row">
			<div class="list-group-item">Reservation Details</div>
			<table class="table">
				<tr>
					<td><b>Room</b></td>
					<td><?php echo $room ?></td>
				</tr>
				<tr>
					<td><b>Reserved on</b></td>
					<td><?php echo $reserve_date ?></td>
				</tr>
				<tr>
					<td><b>Expires on</b></td>
					<td><?php echo $expire_date ?></td>
				</tr>
			</table>
		</div>
    </div>
</div> <!-- content end -->
<?php
	if($status == '0')
	{
?>
<nav class="navbar navbar-default navbar-fixed-bottom" >
	<div class="container">
		<ul class="nav navbar-nav navbar-right">
			<form class="navbar-form navbar-left" action="<?php echo base_url()."index.php/reservation/manage_reservation" ?>" method="POST"">
				<div class="hide">
					<input type="text" value="<?php echo $room_id ?>" name="room_id">
					<input type="text" value="<?php echo $u_id ?>" name="u_id">
				</div>
				<div class="form-group">
					<select class="form-control" name="act">
						<option value="0">Select Action</option>
						<option value="1">Deny</option>
						<option value="2">Accept</option>
					</select>
				</div>
				<button class="btn btn-success" type="submit">Submit</button>
			</form>
		</ul>
	</div>
</nav>
<?php
	}