<div class="container main"> <!-- content start -->
	<div class="col-xs-4">
    	<div class="profile">
        	<img src="<?php echo assets_url() . $path ?>" class="img-thumbnail img-responsive">
        </div>
    </div>
    <div class="col-xs-8">
		<div class="row">
			<div class="list-group-item">Assessment </div>
			<table class="table table-bordered">
				<tr>
					<td>Period</td>
					<td colspan='2'><?php echo date('F d, Y', strtotime($start)) . " - " . date('F d, Y', strtotime($end)) ?></td>
				</tr>
				<?php
					foreach($over_due->result() as $row)
					{
						$value = $this->sys->get_due_total($u_id, $row->DUE_DATE);
						echo "<tr>";
						echo "<td>";
						echo date('F d, Y', strtotime($row->DUE_START)) . " - " . date('F d, Y', strtotime($row->DUE_DATE));
						echo "</td>";
						echo "<td>";
						echo "PHP " . number_format($value, 2);
						echo "</td>";
						echo "<td>";
							echo "<form class='form' action=" . base_url() . "index.php/fee/history method='POST'>";
							echo "<div class='hide'>";
							echo "<input type='text' name='due_date' value=" . $row->DUE_DATE . ">";
							echo "<input type='text' name='u_id' value=" . $u_id . ">";
							echo "</div>";
							echo "<button class='btn btn-link btn-block' type='submit'>Details</button>";
							echo "</form>";
						echo "</td>";
						echo "</tr>";
					}
					foreach($fee->result() as $row)
					{
						echo "<tr>";
						echo "<td>";
						echo $row->FEE_NAME;
						echo "</td>";
						echo "<td colspan='2'>";
						echo "PHP " . number_format($row->VALUE, 2);
						echo "</td>";
						echo "</tr>";	
					}
				?>
				<tr>
				<td><b>Total</b></td>
				<td colspan="2"><b>PHP <?php echo number_format($total, 2) ?></b></td>
				</tr>
			</table>
		</div>
		<div class="row">
			<div class="col-xs-2">
				<form action="<?php echo base_url()."index.php/user/print_assessment" ?>" method="POST">
					<button class="btn btn-success" type="submit">Print</button>
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="list-group-item">History</div>
			<table class="table table-bordered">
				<tr>
					<td>Period</td>
					<td>Status</td>
					<td>Balance</td>
					<td></td>
				</tr>
			<?php
				foreach ($due->result() as $row)
				{	
					$this->db->select_sum('VALUE');
					$this->db->where('ACC', $u_id);
					$this->db->where('DUE_DATE', $row->DUE_DATE);
					$this->db->join('FEE', 'FEE.FEE_ID = PAYABLE.FEE_ID');
					$query = $this->db->get('PAYABLE');
					$payable_row = $query->row();
					$balance =  $payable_row->VALUE;				
					
					echo "<tr>";
					echo "<td>";
					echo date('F d, Y', strtotime($row->DUE_START)) . " - " . date('F d, Y', strtotime($row->DUE_DATE));
					echo "</td>";	
					echo "<td>";
						switch($row->DUE_STATUS)
						{
							case '0': echo "On Due";
								break;
							case '1': echo "Paid";
								break;
							case '2': echo "Overdue";
								break;
						}
					echo "</td>";
					echo "<td>";
					echo "PHP " . number_format($balance, 2);
					echo "</td>";
					echo "<td>";
						if($row->DUE_STATUS != '0')
						{
							echo "<form class='form' action=" . base_url() . "index.php/fee/history method='POST'>";
							echo "<div class='hide'>";
							echo "<input type='text' name='due_date' value=" . $row->DUE_DATE . ">";
							echo "<input type='text' name='u_id' value=" . $u_id . ">";
							echo "</div>";
							echo "<button class='btn btn-link btn-block' type='submit'>Details</button>";
							echo "</form>";
						}
					echo "</td>";
					echo "</tr>";
				}
			?>
			</table>
		</div>
    </div>
</div> <!-- content end -->
    