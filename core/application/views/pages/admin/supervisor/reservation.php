<div class="container main"> <!-- content start -->
	<div class="row">
		<h3>Filters</h3>
		<div class="col-xs-6">
			<form class="form" action="<?php echo base_url()."index.php/admin/supv/reservation/" ?>" method="POST">
				<div class="row">
					<div class="col-xs-4">
						<div class="form-group">
							<label class="control-label">Building</label>
							<select class="form-control" name="blg">
								<option value="0">All buildings</option>
							<?php
								foreach($blg->result() as $row)
								{
									echo "<option value=" . $row->BLG_ID . " >" . $row->BLG_NAME . "</option>";
								}
							?>
							</select>						
						</div>				
					</div>
					<div class="col-xs-4">
						<div class="form-group">
							<label class="control-label">Status</label>
							<select class="form-control" name="status">
								<option value="4">All</option>
								<option value="0">Pending</option>
								<option value="2">Denied</option>
								<option value="3">Expired</option>
							</select>						
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-xs-8">
						<div class="input-group">
							<input type="text" class="form-control" name="key" placeholder="Name">
							<span class="input-group-btn">
								<button class="btn btn-success" type="submit">Search</button>
							</span>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<h3>Reservation list</h3>
		<table class="table table-responsive table-bordered">
		<tr>
			<td>Reservation ID</td>
			<td>Name</td>
			<td>Gender</td>
			<td>Room</td>
			<td>Reserved On</td>
			<td colspan="2">Status</td>
		</tr>
		<?php
			foreach($query->result() as $row)
			{
				echo "<tr>";				
				echo "<td>" . $row->ACC . "</td>";
				echo "<td>" . $row->LNAME . ", " . $row->FNAME . " " . $row->MNAME . "</td>";
				echo "<td>" . $row->GENDER . "</td>";
				echo "<td>" . $row->BLG_NAME . " Room " . $row->ROOM_NO . "</td>";
				echo "<td>" . date('F d, Y', strtotime($row->RESERVE_DATE)) . "</td>";
				
				$status = $row->RESERVE_STATUS;
				switch($status)
				{
					case '0': $status = "Pending";
							break;
					case '1': $status = "Accepted";
							break;
					case '2': $status = "Denied";
							break;
					case '3': $status = "Expired";
							break;
				}
				
				echo "<td>" . $status . "</td>";
				echo "<td><a href=" . base_url() . "index.php/admin/supv/manage/". $row->ACC . " >View</td>";
				echo "</tr>";
			}
		?>
		</table>
		<div class="row text-center">
			<?php echo $pagination ?>
		</div>
	</div>
</div> <!-- content end -->
    