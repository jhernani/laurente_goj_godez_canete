<div class="container main"> <!-- content start -->
	<div class="row">
		<form class="form" action="<?php echo base_url()."index.php/admin/supv/search/" ?>" method="GET">
			<div class="col-xs-6">
				<div class="input-group">
					<input type="text" class="form-control input-lg" name="key">
					<span class="input-group-btn">
						<button class="btn btn-success btn-lg" type="submit">Search</button>
					</span>
				</div>
			</div>
		</form>
	</div>
	<div class="row">
		<h3>Search Result</h3>
		<table class="table table-responsive table-bordered">
		<tr>
			<td>Reservation ID</td>
			<td>Name</td>
			<td>Gender</td>
			<td>Room</td>
			<td>Sent On</td>
			<td>Status</td>
			<td></td>
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
				foreach($query->result() as $row)
				{
					echo "<tr>";				
					echo "<td>" . $row->ACC . "</td>";
					echo "<td>" . $row->FNAME . " " . $row->MNAME . " " . $row->LNAME . "</td>";
					echo "<td>" . $row->GENDER . "</td>";
					echo "<td>" . $row->BLG_NAME . " Room " . $row->ROOM_NO . "</td>";
					echo "<td>" . date('F d, Y', strtotime($row->RESERVE_DATE)) . "</td>";
					
					$status = $row->STATUS;
					switch($status)
					{
						case '0': $status = "Pending";
								break;
						case '1': $status = "Expired";
								break;
					}
					
					echo "<td>" . $status . "</td>";
					echo "<td><a href=" . base_url() . "index.php/admin/supv/manage/". $row->ACC . " >View</td>";
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
    