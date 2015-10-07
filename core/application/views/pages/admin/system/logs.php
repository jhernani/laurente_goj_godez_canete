<div class="container main"> <!-- content start -->
	<div class="col-xs-4">
    	<form class="form" action="<?php echo base_url()."index.php/admin/sys/adminlogs" ?>" method="POST">
			<h4>Log Type<h4>
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">	
						<select class="form-control" name="type">
							<option value="All">All</option>
							<?php
								foreach ($log_type->result() as $row){
									echo "<option value='" . $row->ACTV . "' >";
									echo $row->ACTV;
									echo "</option>";
								}
							?>
						</select>   
					</div> 
				</div>
			</div>
			<h4>Administrator<h4>
			<div class="row">
				<div class="col-xs-10">
					<div class="form-group">
						<div class="input-group">
							<select class="form-control" name="admin">
								<option value="All">All</option>
								<?php
									foreach ($admin_list->result() as $row){
										echo "<option value=" . $row->ACC_ID . ">";
										echo $row->FNAME . " " . $row->MNAME . " " . $row->LNAME;
										switch($row->ADMIN_TYPE){
											case '1': echo " [Supervisor]";
												break;
											case '2': echo " [Finance]";
												break;
											case '3': echo " [System Admin]";
												break;	
										}
										echo "</option>";
									}
								?>
							</select>
							<span class="input-group-btn">
								<button class="btn btn-success" type="submit">Go!</button>
							</span>    
						</div>      
						<?php echo form_error('admin')?>
					</div> 
				</div>
			</div>
        </form>
    </div>
    <div class="col-xs-8">
        <div class="row">
			<?php
				$admin = $this->input->post('admin');
				$type = $this->input->post('type');
			?>
			<form action="<?php echo base_url()."index.php/admin/sys/print_logs" ?>" method="POST">
				<div class="hide">
					<input type="text" name="admin" value="<?php echo $admin ?>">
					<input type="text" name="type" value="<?php echo $type ?>">
				</div>
				<button class="btn btn-success">Print</button>
			</form>
			<br>
        	<p>List of activities</p>
			<table class="table table-bordered">
				<tr>
					<td><b>Administrator</b></td>
					<td><b>Activity</b></td>
					<td><b>Date</b></td>
				</tr>           
            	<?php
				foreach ($logs->result() as $row){
				?>
					<tr>
						<td><?php echo $row->LNAME . ", " . $row->FNAME ?></td>
						<td><?php echo $row->ACTV ?></td>
						<td><?php echo date('F d, Y g:i A', strtotime($row->ACTV_DATE)) ?></td>
					</tr>
                <?php	
				}
				?>               
			</table>
        </div>   
    </div>
</div> <!-- content end -->
    