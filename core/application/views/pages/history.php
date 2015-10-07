<div class="container main"> <!-- content start -->
	<div class="col-xs-4">
    	<div class="profile">
        	<img src="<?php echo assets_url() . $path ?>" class="img-thumbnail img-responsive">
        </div>
    </div>
    <div class="col-xs-8">
		<div class="row">
			<div class="list-group-item">Assessment </div>
			<table class="table">
				<tr>
					<td>Period</td>
					<td><?php echo date('F d, Y', strtotime($start)) . " - " . date('F d, Y', strtotime($end)) ?></td>
				</tr>
				<?php
					foreach ($fee->result() as $row)
					{
						echo "<tr>";
						echo "<td>";
						echo $row->FEE_NAME;
						echo "</td>";
						echo "<td>";
						echo "PHP " . $row->VALUE;
						echo "</td>";
						echo "</tr>";
					}
				?>
				<tr>
				<td><b>Total</b></td>
				<td><b><?php echo "PHP " . number_format($total, 2) ?></b></td>
				</tr>
			</table>
		</div>
    </div>
</div> <!-- content end -->
    