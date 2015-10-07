<div class="container main"> <!-- content start -->
	<div class="row">
		<div class="col-xs-6">
			<h3>Filters</h3>
			<form class="form" action="<?php echo base_url()."index.php/admin/acctg/report" ?>" method="POST">
				<div class="row">
					<div class="col-xs-4">
						<label class="control-label">From</label>
						<input class="form-control" type="date" name="start">
					</div>
					<div class="col-xs-4">
						<label class="control-label">To</label>
						<input class="form-control" type="date" name="end">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-xs-3">
						<div class="form-group">
							<label class="control-label">Building</label>
							<select class="form-control" name="blg">
								<option value="">All buildings</option>
							<?php
								foreach($blg->result() as $row)
								{
									echo "<option value=" . $row->BLG_ID . " >" . $row->BLG_NAME . "</option>";
								}
							?>
							</select>						
						</div>				
					</div>
					<div class="col-xs-3">
						<div class="form-group">
							<label class="control-label">Course</label>
							<select class="form-control" name="course">
								<option value="">All course</option>
							<?php
								foreach($course->result() as $row)
								{
									echo "<option value=" . $row->C_ID . " >" . $row->C_ABBR . "</option>";
								}
							?>
							</select>						
						</div>				
					</div>
					<div class="col-xs-3">
						<div class="form-group">
							<label class="control-label">Gender</label>
							<select class="form-control" name="gender">
								<option value="">All gender</option>
								<option value="M">Male</option>
								<option value="F">Female</option>
							</select>						
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-xs-8">					
						<button class="btn btn-success" type="submit">Search</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<h3>Result</h3>
		<?php
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$blg = $this->input->post('blg');
			$course = $this->input->post('course');
			$gender = $this->input->post('gender');
			$key = $this->input->post('key');
		?>
		<form action="<?php echo base_url()."index.php/admin/acctg/print_report" ?>" method="POST">
			<div class="hide">
				<input type="text" name="start" value="<?php echo $start ?>">
				<input type="text" name="end" value="<?php echo $end ?>">
				<input type="text" name="blg" value="<?php echo $blg ?>">
				<input type="text" name="course" value="<?php echo $course ?>">
				<input type="text" name="gender" value="<?php echo $gender ?>">
			</div>
			<button class="btn btn-success">Print</button>
		</form>
		<br>
		<table class="table table-responsive table-bordered">
			<tr>
				<td><b>Student ID</b></td>
				<td><b>Name</b></td>
				<td><b>Gender</b></td>
				<td><b>Course/Year</b></td>
				<td><b>Amount Paid</b></td>
			</tr>
		<?php
			if($total == 0)
			{
				echo "<tr>";
				echo "<td colspan='5'> No results found. </td>";
				echo "</tr>";
			}
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$total = 0.00;
			
			foreach($account->result() as $row)
			{			
				$query = $this->sys->user_details($row->ACC_ID);
				$user = $query->row();
				$ismis = $user->ISMIS_ID;
				$gender = $user->GENDER;
				$name = $user->LNAME . ", " . $user->FNAME . " " . $user->MNAME;	
				
				$course = $this->sys->get_course_abbr($user->C_ID);
				$amount = $this->sys->get_amount_total($row->ACC_ID, $start, $end);
				$total += $amount;
					
				echo "<tr>";
				echo "<td>" . $ismis . "</td>";
				echo "<td>" . $name . "</td>";
				echo "<td>" . $gender . "</td>";
				echo "<td>" . $course . " " . $user->YEAR . "</td>";
				echo "<td>PHP " . number_format($amount, 2) . "</td>";
				echo "</tr>";
			}
		?>
			<tr>
				<td colspan="3"></td>
				<td><b>Total</b></td>
				<td><b>PHP <?php echo number_format($total, 2) ?></b></td>
			</tr>
		</table>
	</div>
</div> <!-- content end -->
    