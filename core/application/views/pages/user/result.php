<div class="container main"> <!-- content start -->
	<div class="col-xs-4">
    	<div class="profile">
        	<img src="<?php echo assets_url();?>profiles/profile-default.png" class="img-thumbnail img-responsive">
        </div>
    </div>
    <div class="col-xs-8">
    	<div class="page-header">
          <h1>Search room result</h1>
        </div>
        <div>
        	<p>These are the rooms available based on your request.</p>
            <div class="col-xs-10 well">
                <?php
					foreach ($query->result() as $row){
						echo "<a href=" . base_url() . "index.php/dorm/room/". $row->ROOM_ID . " class='list-group-item'>" . $row->BLG_NAME . " Room " . $row->ROOM_NO;
							if($row->GENDER == 'M')
								echo " Male Only";
							else
								echo " Female Only";
							echo "<span class='badge'>" . $row->POPULATION . "/" . $row->CAP . "</span>";
						echo "</a>";
					}
					echo "<div class='row text-center'>";
						echo $pagination;
					echo "</div>";
				?>
            </div>
        </div>
        
    </div>
</div> <!-- content end -->
    