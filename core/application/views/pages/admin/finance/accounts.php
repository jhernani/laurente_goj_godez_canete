<div class="container main"> <!-- content start -->
	<div class="row">
		<div class="col-xs-6">
			<h3>Filters</h3>
			<form class="form" action="<?php echo base_url()."index.php/admin/acctg/accounts" ?>" method="POST">
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
					<div class="col-xs-3">
						<div class="form-group">
							<label class="control-label">Account Status</label>
							<select class="form-control" name="status">
								<option value="1">Active</option>
								<option value="0">Inactive</option>
								<option value="2">All</option>
							</select>						
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-xs-8">
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" name="key" placeholder="Name">
								<span class="input-group-btn">
									<button class="btn btn-success" type="submit">Search</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<h3>Account Lists</h3>
		<table class="table table-responsive table-bordered">
			<tr>
				<td><b>Student ID</b></td>
				<td><b>Name</b></td>
				<td><b>Gender</b></td>
				<td><b>Course/Year</b></td>
				<td colspan="2"><b>Room</b></td>
			</tr>
		<?php
			if($total == 0)
			{
				echo "<tr>";
				echo "<td colspan='6'> No results found. </td>";
				echo "</tr>";
			}
			else
			{
				foreach($users->result() as $row)
				{
					echo "<tr>";
					echo "<td>" . $row->ISMIS_ID . "</td>";
					echo "<td>" . $row->LNAME . ", " . $row->FNAME . " " . $row->MNAME ."</td>";
					echo "<td>" . $row->GENDER . "</td>";
					echo "<td>" . $row->C_ABBR . " " . $row->YEAR . "</td>";
					echo "<td>" . $row->BLG_NAME . " Room " . $row->ROOM_NO . "</td>";
					echo "<td><a href=" . base_url() . "index.php/admin/acctg/payment/" . $row->INFO_ID . "> View" . "</a></td>";
					echo "</tr>";
				}
			}
		?>
		</table>
		<div class="row text-center">
			<?php echo $pagination ?>
		</div>
	</div>
</div> <!-- content end -->
    