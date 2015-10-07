<div class="container main"> <!-- content start -->
	<div class="col-xs-4">
    	<div class="list-group-item">Active Fees</div>
		<table class="table table-hover">
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Value</td>
		</tr>
		<?php
			foreach($active_fee->result() as $row)
			{
				echo "<tr>";
				echo "<td>" . $row->FEE_ID . "</td>";
				echo "<td>" . $row->FEE_NAME . "</td>";
				echo "<td>" . $row->VALUE . "</td>";
				echo "</tr>";
			}
		?>
		</table>
    </div>
    <div class="col-xs-8">
		<div class="row">
			<div class="list-group-item">Fee List</div>
			<table class="table">
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Value</td>
				<td>Status</td>
				<td>Activate/Deactivate</td>
				<td>Change</td>
			</tr>
			<?php
				foreach($all_fee->result() as $row)
				{
					echo "<tr>";
					echo "<td>" . $row->FEE_ID . "</td>";
					echo "<td>" . $row->FEE_NAME . "</td>";
					echo "<td>" . $row->VALUE . "</td>";
					if($row->ACTIVE == '1')
						echo "<td> Active </td>";
					else
						echo "<td> Inactive </td>";
					echo "<td>";
					echo "<form action=". base_url() . "index.php/fee/toggle_fee" . " method='POST'>";					
					if($row->ACTIVE == "1")
					{
						echo "<button class='btn btn-danger' value=" . $row->FEE_ID . " name='fee_id' type='submit'> Deactivate </button>";
					}
					else
					{
						echo "<button class='btn btn-success' value=" . $row->FEE_ID . " name='fee_id' type='submit'> Activate </button>";
					}
					echo "</form>";
					echo "</td>";
					echo "<form action=". base_url() . "index.php/admin/acctg/change_fee" . " method='POST'>";
					echo "<td>";
					echo "<input class='form-control' type='text' name='price' placeholder='New price'>";
					echo "</td>";
					echo "<td>";
					echo "<button class='btn btn-success' value=" . $row->FEE_ID . " name='fee_id' type='submit'> Change </button>";
					echo "</td>";
					echo "</form>";
					echo "</tr>";
				}
			?>
			</table>
		</div>
    </div>
</div> <!-- content end -->
    