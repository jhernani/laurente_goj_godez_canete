<div class="container main"> <!-- content start -->
	<div class="col-xs-4">
		<h3>Show Rooms</h3>
		<form class="form" action="<?php echo base_url() . 'index.php/admin/sys/dormitory' ?>" method="POST">
			<div class="form-group">
				<div class="input-group">
					<select class="form-control" name="blg">
					<?php
						foreach($blg->result() as $row)
						{
							echo "<option value=" . $row->BLG_ID . " >" . $row->BLG_NAME . "</option>";
						}
					?>	
					</select>
					<span class="input-group-btn">
						<button class="btn btn-success" type="submit">Submit</button>
					</span>
				</div>
			</div>
		</form>
		<h3>Add Room</h3>
		<form class="form" action="<?php echo base_url() . 'index.php/admin/sys/add_room' ?>" method="POST">
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">
						<label class="control-label">Building</label>
						<select class="form-control" name="blg">
						<?php
							foreach($blg->result() as $row)
							{
								echo "<option value=" . $row->BLG_ID . " >" . $row->BLG_NAME . "</option>";
							}
						?>	
						</select>
					</div>
				</div>
				<div class="col-xs-6">
					<label class="control-label">Type</label>
					<select class="form-control" name="type">
						<option value="0">Standard</option>
						<option value="1">Premium</option>
					</select>					
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<label class="control-label">Capacity</label>
					<select class="form-control" name="cap">
						<option value="1">Room for 1</option>
						<option value="2">Room for 2</option>
						<option value="4">Room for 4</option>
						<option value="6">Room for 6</option>
					</select>					
				</div>
				<div class="col-xs-6">
					<label class="control-label">Gender</label>
					<select class="form-control" name="gender">
						<option value="M">Male</option>
						<option value="F">Female</option>
					</select>					
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-xs-6">
					<button class="btn btn-success" type="submit">Add</button>					
				</div>
			</div>
		</form>
	</div>
	<div class="col-xs-8">
		<h3>List of Rooms</h3>
		<table class="table table-bordered">
			<tr>
				<td><b>Building</b></td>
				<td><b>Room no.</b></td>
				<td><b>Type</b></td>
				<td><b>Gender</b></td>
				<td><b>Capacity</b></td>
			</tr>
			<?php
				foreach($room->result() as $row)
				{
					echo "<tr>";
					echo "<td>" . $row->BLG_NAME . "</td>";
					echo "<td>" . $row->ROOM_NO . "</td>";
					if($row->TYPE == '0')
					{
						echo "<td>Standard</td>";
					}
					else
					{
						echo "<td>Premium</td>";
					}
					if($row->GENDER == 'M')
					{
						echo "<td>Male</td>";
					}
					else
					{
						echo "<td>Female</td>";
					}
					echo "<td>Room for " . $row->CAP . "</td>";
					echo "</tr>";
				}
			?>
		</table>
	</div>
</div> <!-- content end -->
    