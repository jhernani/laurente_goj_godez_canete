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
                <li class="dropdown">
        			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage</a>
        			<ul class="dropdown-menu">
                    	<li><a href="<?php echo base_url()."index.php/admin/supv/reservation" ?>">Manage Reservations</a></li>
                        <li><a href="<?php echo base_url()."index.php/admin/supv/users" ?>">User List</a></li>
					</ul>
      			</li>
            	<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th"></span></a>
        			<ul class="dropdown-menu">
						<li><a href="<?php echo base_url()."index.php/admin/settings" ?>">Settings</a></li>
						<li class="divider"></li>
                        <li><a href="<?php echo base_url()."index.php/auth/signout" ?>">Sign Out</a></li>
					</ul>
				</li> 
   			</ul>
   		</div>
	</div>
</header>