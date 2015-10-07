<div class="container main"> <!-- content start -->
	<div class="col-xs-4">
		<div class="row">
			<div class="profile">
				<img src="<?php echo assets_url() . $path ?>" class="img-thumbnail img-responsive">				
			<?php
				if($status == '1')
				{
			?>
				<br>
				<br>
				<form class="form" action="<?php echo base_url()."index.php/admin/supv/checkout" ?>" method="POST">
					<div class="hide">
						<input type="text" value="<?php echo $u_id ?>" name="u_id">
					</div>
					<button class="btn btn-danger btn-block" type="submit">Check Out</button>
				</form>
			<?php
				}
			?>
			</div>
		</div>
		<div class="row">
				
		</div>
    </div>
    <div class="col-xs-8">
    	<div class="page-header">
          <h1><?php echo $name ?></h1>
        </div>
		<div class="row">
			<div class="list-group-item">Student Information</div>
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
					<td><b>Gender</b></td>
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
			<div class="list-group-item">Room Information</div>
			<table class="table">
				<tr>
					<td><b>Started On</b></td>
					<td><?php echo $start_date ?></td>
				</tr>
				<tr>
					<td><b>Left On</b></td>
					<td><?php echo $end_date ?></td>
				</tr>
				<tr>
					<td><b>Room</b></td>
					<td><?php echo $room ?></td>
				</tr>
			</table>
		</div>
	<?php
	if($status == '1')
	{
	?>	
		<div class="row">
			<h2>List of Additional Fees</h2>
			<form class="form" action="<?php echo base_url()."index.php/admin/supv/payable" ?>" method="POST">
			<div class="hide">
				<input type="text" value="<?php echo $u_id ?>" name="u_id">
			</div>
			<?php
				foreach($fees->result() as $row)
				{
					$has_this_fee = false;
					$fee_id = $row->FEE_ID;
					$fee_name = $row->FEE_NAME;
					$value = $row->VALUE;
					
					foreach($user_fee->result() as $row)
					{
						if($row->FEE_ID == $fee_id)
						{
							$has_this_fee = true;
							break;
						}
					}
					echo "<div class='form-group'>";
					echo "<div class='checkbox'>";
					if($has_this_fee == true)
					{
						echo "<input type='checkbox' name=" . $fee_id . " checked>" . $fee_name . " PHP " . number_format($value, 2);
					}
					else
					{
						echo "<input type='checkbox' name=" . $fee_id . ">" . $fee_name . " PHP " . number_format($value, 2);
					}
					
					echo "</div>";
					echo "</div>";
				}
			?>
				<div class="form-group">
					<button class="btn btn-success" type="submit">Submit</button>
				</div>
			</form>	
		</div>
	<?php
	}
	?>
    </div>
</div> <!-- content end -->    