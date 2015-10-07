<div class="container main"> <!-- content start -->
	<div class="col-xs-4">
    	<div class="profile">
        	<img src="<?php echo assets_url() . $path ?>" class="img-thumbnail img-responsive">
        </div>
    </div>
    <div class="col-xs-8">
    	<div class="page-header">
          <h1>My Reservation</h1>
        </div>
        <div class="row">
			<div class="list-group-item">Reservation Details</div>
			<table class="table">
				<tr>
					<td>Room</td>
					<td><?php echo $room ?></td>
				</tr>
				<tr>
					<td>Sent On</td>
					<td><?php echo $reserve_date ?></td>
				</tr>
				<tr>
					<td>Expires On</td>
					<td><?php echo $expire_date ?></td>
				</tr>
				<tr>
					<td>Status</td>
					<td><?php echo $status ?></td>
				</tr>
			</table>
		</div>
		<?php
		if($status == 'Expired' || $status == 'Pending')
		{
		?>
		<div class="row">
			<div class="col-xs-2">
				<form class="form" action="<?php echo base_url() .'index.php/reservation/cancel_reservation'?>" method="POST">
					<div class="form-group">
						<div class="row">
							<div class="col-xs-2">
								<button class="btn btn-success btn-lg" name='room_id' value="<?php echo $room_id ?>" type="submit">Cancel</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		<?php
		}
		?>
			<div class="col-xs-4">
				<form class="form" action="<?php echo base_url() .'index.php/dorm/pdf_print'?>" method="POST">
					<div class="form-group">
						<div class="row">
							<div class="col-xs-2">
								<button class="btn btn-success btn-lg" type="submit">Print</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
</div> <!-- content end -->
    