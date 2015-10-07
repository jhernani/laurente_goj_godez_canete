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
			<div class="list-group-item">User Information</div>
			<table class="table">
			<?php
			if($p_course == '1')
			{
			?>
				<tr>
					<td><b>Course</b></td>
					<td><?php echo $course ?></td>
				</tr>
				<tr>
					<td><b>Year</b></td>
					<td><?php echo $yr_lvl ?></td>
				</tr>
			<?php
			}
			if($p_bdate == '1')
			{
			?>
				<tr>
					<td><b>Birth Date</b></td>
					<td><?php echo $bdate ?></td>
				</tr>
			<?php
			}
			if($p_gender == '1')
			{
			?>
				<tr>
					<td><b>Gender</b></td>
					<td><?php echo $gender ?></td>
				</tr>
			<?php
			}
			if($p_email == '1')
			{
			?>
				<tr>
					<td><b>E-mail</b></td>
					<td><?php echo $email ?></td>
				</tr>
			<?php
			}
			?>
			</table>
		</div>
		<div class="row">
			<div class="list-group-item">Dormitory Information</div>
			<table class="table">
				<tr>
					<td><b>Started On</b></td>
					<td><?php echo $start_date ?></td>
				</tr>
				<tr>
					<td><b>Room</b></td>
					<td><?php echo $room ?></td>
				</tr>
			</table>
		</div>
    </div>
</div> <!-- content end -->
    