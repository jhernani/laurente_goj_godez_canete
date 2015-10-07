<header class="navbar-inverse crass-nav" role="banner">
   	<div class="container">
   		<div class="navbar-header">
   			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
       			<span class="icon-bar"></span>
           		<span class="icon-bar"></span>
           		<span class="icon-bar"></span>
       		</button>
            <a class="navbar-brand" href="<?php echo base_url()."index.php/main"?>">CRASS</a>
       	</div>  
   		<div class="collapse navbar-collapse" id="nav">
   			<ul class="nav navbar-nav">
         			
       		</ul>      
			<ul class="nav navbar-nav navbar-right">
            	<li><a href="<?php echo base_url()."index.php/user/profile" ?>">Profile</a></li>
                <li class="dropdown">
        			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dormitory</span></a>
        			<ul class="dropdown-menu">
						<li><a href="<?php echo base_url()."index.php/dorm" ?>">Search Room</a></li>
						<?php
							if($has_room == TRUE){
								echo "<li><a href=" . base_url(). "index.php/dorm/myroom" . ">My Room</a></li>";
								echo "<li><a href=" . base_url(). "index.php/user/assessment" . ">Assessment</a></li>";
								}
							if($has_reservation == TRUE)
								echo "<li><a href=" . base_url(). "index.php/dorm/myreservation" . ">My Reservation</a></li>";
						?>
                        
					</ul>
      			</li>
            	<li class="dropdown">
        			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th"></span></a>
        			<ul class="dropdown-menu">
						<li><a href="<?php echo base_url()."index.php/user/settings" ?>">User Settings</a></li>
						<li><a href="<?php echo base_url()."index.php/user/privacy" ?>">Privacy Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url()."index.php/auth/signout" ?>">Sign Out</a></li>
					</ul>
      			</li> 
   			</ul>
   		</div>
	</div>
</header>