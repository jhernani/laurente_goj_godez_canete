<div class="container main"> <!-- content start -->
	<div class="col-xs-4">
    	<div class="profile">
        	<img src="<?php echo assets_url() . $path ?>" class="img-thumbnail img-responsive">
        </div>
    </div>
    <div class="col-xs-8">
    	<div class="page-header">
          <h1><?php echo $room ?></h1>
        </div>
		<div class="row">
        	<div class="list-group">
				<div class="list-group-item">Room Details</div>
            	<div class="col-xs-8">
             		<table class="table">
						<tr>
                     		<td>Started On</td>
                    		<td><?php echo $start_date ?></td>
                     	</tr>
						<tr>
                     		<td>Room Type</td>
                    		<td><?php echo $room_type ?></td>
                     	</tr>
            			<tr>
                    		<td>Population</td>
                       		<td><?php echo  $population . "/" . $cap ?></td>
                      	</tr>		
        	        </table>
					<p>Students occupying this room are: </p>
					<?php
						foreach($roommates->result() as $row)
						{
							if($row->INFO_ID == $this->session->userdata('u_id'))
							{
								echo "<p><a href=" . base_url() . "profile/view/" . $row->INFO_ID . ">";
									echo "You";
								echo "</a></p>";
							}
							else
							{
								echo "<p><a href=" . base_url() . "profile/view/" . $row->INFO_ID . ">";
									echo $row->FNAME . " " . $row->MNAME . " " . $row->LNAME;
								echo "</a></p>";
							}	
						}
					?>
                </div>
            </div>
        </div> 		
    </div>
</div> <!-- content end -->
    