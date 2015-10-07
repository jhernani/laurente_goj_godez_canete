<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="row clearfix">
				<div class="col-md-6 column">
					<br>
					<div class="carousel slide" id="carousel-886944">
						<ol class="carousel-indicators">
							<li class="active" data-slide-to="0" data-target="#carousel-886944">
							</li>
							<li data-slide-to="1" data-target="#carousel-886944">
							</li>
							<li data-slide-to="2" data-target="#carousel-886944">
							</li>
						</ol>
						<div class="carousel-inner">
							<div class="item active">
								<img alt="" src="<?php echo assets_url();?>img/bld_1.jpg" />
								<div class="carousel-caption">
									<h4>
										
									</h4>
									<p>
										
									</p>
								</div>
							</div>
							<div class="item">
								<img alt="" src="<?php echo assets_url();?>img/bld_2.jpg" />
								<div class="carousel-caption">
									<h4>
										
									</h4>
									<p>
										
									</p>
								</div>
							</div>
							<div class="item">
								<img alt="" src="<?php echo assets_url();?>img/bld_3.jpg" />
								<div class="carousel-caption">
									<h4>
										
									</h4>
									<p>
										
									</p>
								</div>
							</div>
						</div> <a class="left carousel-control" href="#carousel-886944" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-886944" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
					</div>
					<h1>Rates</h1>
					<strong>Non - aircon rooms with wall fans only</strong>
					<ol>
						


    <li>1 occupant Php 4,800.00</li>
    <li>2 occupants Php 3,600.00/per head</li>
    <li>4 occupants Php 1,800.00/per head</li>
    <li>6 occupants Php 1,600.00/per head</li>

					</ol>
					<strong>Aircon Rooms</strong>
					<ol>
	<li>1 Occupant Php 8,800.00</li>
    <li>2 Occupants Php 6,600.00/per head</li>
    <li>4 occupants Php 3,300.00/per head</li>
					</ol>
				</div>
				<div class="col-md-6 column">
					<?php
				foreach ($room->result() as $row)
				{
					echo "<div class='row'>";
						echo "<div class='col-xs-3'>";
							echo "<img src=" . assets_url() . "img/temp.png"  . " class='img-thumbnail img-responsive'>";
						echo "</div>";
						echo "<div class='col-xs-8'>";	
							echo "<h3> Room " . $row->ROOM_NO . "</h3>";
							echo "<table class='table'>";
							echo "<tr>";
								switch($row->TYPE)
								{
									case '0': echo "<td> Standard Room </td>";
											break;
									case '1': echo "<td> Premium Room </td>";
											break;
								}
								echo "<td> Room for " . $row->CAP ."</td>";
								echo "<td> Available Slots </td>";
								echo "<td>" . ($row->CAP - ($row->RESERVED + $row->POPULATION)) . "</td>";
							echo "</tr>";
							echo "</table>";
						echo "</div>";
						if($has_room == false && $has_reservation == false)
						{
							echo "<form class='form' action=" . base_url() . "reservation/reserve" . " method='POST'>";
								echo "<button type='submit' value=" . $row->ROOM_ID . " name='room_id' class='btn btn-success'>Reserve</button>";
							echo "</form>";
						}
					echo "</div>";
				}
			?>
			<div class="row text-center">
				<?php echo $pagination?>
			</div>
				</div>
			</div>
		</div>
	</div>
</div>