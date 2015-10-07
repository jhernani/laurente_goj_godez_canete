<div class="container main"> <!-- content start -->
	<div class="row">
		<div class="col-xs-6">
			<h3>Filters</h3>
			<form class="form" action="<?php echo base_url()."index.php/admin/acctg/report" ?>" method="POST">
				<div class="row">
					<div class="col-xs-4">
						<label class="control-label">From</label>
						<input class="form-control" type="date" name="start">
						<?php echo form_error('start') ?>
					</div>
					<div class="col-xs-4">
						<label class="control-label">To</label>
						<input class="form-control" type="date" name="end">
						<?php echo form_error('end') ?>
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
		<table class="table table-responsive table-bordered">
			<tr>
				<td><b>Student ID</b></td>
				<td><b>Name</b></td>
				<td><b>Gender</b></td>
				<td><b>Course/Year</b></td>
				<td><b>Amount Paid</b></td>
			</tr>
		</table>
	</div>
</div> <!-- content end -->
    