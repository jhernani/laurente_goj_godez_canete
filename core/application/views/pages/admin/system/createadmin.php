<div class="container main"> <!-- content start -->
    <div class="col-xs-6 col-xs-offset-3">
    	<div class="page-header">
    		<h1>Create Administrator Account</h1>
        </div>
		<form class="form" action="<?php echo base_url()."index.php/admin/sys/createadmin" ?>" method="POST">
        	<h3>Administrator Type</h3>
        	<div class="form-group">
          	  	<div class="row">
                	<div class="col-xs-6">
                        <label class="sr-only">Administrator</label>
                        <select class="form-control" name="admin_type">
                        <option value="0">Select</option>
                        <option value="1">Supervisor</option>
                        <option value="2">Finance</option>
                        <option value="3">System Administrator</option>
                	</select>
                    <?php echo form_error('type'); ?>
                    </div>
            	</div>
			</div>
           	<div class="form-group">
               	<div class="row">
                   	<div class="col-xs-6">
                       	<label class="sr-only">First Name</label>
                       	<input class="form-control" type="text" name="fname" value="<?php echo set_value('fname'); ?>" placeholder="First Name">               
						<?php echo form_error('fname'); ?>
                    </div>
                    <div class="col-xs-6">
                       	<label class="sr-only">Last Name</label>
                       	<input class="form-control" type="text" name="lname" value="<?php echo set_value('lname'); ?>" placeholder="Last Name">     
                        <?php echo form_error('lname'); ?>                   
                    </div>                     
               	</div>           
           	</div>
            <div class="form-group">
            	<div class="row">
                	<div class="col-xs-8">
                        <label class="sr-only">Password</label>
                        <input class="form-control" type="password" name="pword" value="<?php echo set_value('pword'); ?>" placeholder="Password">
                        <?php echo form_error('pword'); ?>
                	</div>
            	</div>                        
           	</div>
            <div class="form-group">
            	<div class="row">
                	<div class="col-xs-8">
                        <label class="sr-only">Confirm Password</label>
                        <input class="form-control" type="password" name="pwordconf" value="<?php echo set_value('pwordconf'); ?>" placeholder="Confirm Password">
                        <?php echo form_error('pwordconf'); ?>
                	</div>
            	</div>
           	</div>
          	<div class="form-group">
            	<div class="row">
                	<div class="col-xs-8">
                        <label class="sr-only">Email</label>
                        <input class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email">
                        <?php echo form_error('email'); ?>
                	</div>
                </div>
           	</div>
          	<h3>Birthdate</h3>
           	<div class="form-group">
           		<div class="row">
               		<div class="col-xs-5">
                   		<label class="sr-only">Month</label>
                   		<select class="form-control" name="month">
                       		<option value="0">Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>                              
                       	</select>
                   	</div>
                   	<div class="col-xs-3">
                   		<label class="sr-only">Day</label>
                   		<select class="form-control" name="day">
                          	<option value="0">Day</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                       	</select>
                   	</div>
                   	<div class="col-xs-4">
                   		<label class="sr-only">Year</label>
                   		<select class="form-control" name="year">
                       		<option value="0">Year</option>
                            <option value="1999">1999</option>
                            <option value="1998">1998</option>
                            <option value="1997">1997</option>
                            <option value="1996">1996</option>
                            <option value="1995">1995</option>
                            <option value="1994">1994</option>
                            <option value="1993">1993</option>
                            <option value="1992">1992</option>
                            <option value="1991">1991</option>
                            <option value="1990">1990</option>
                            <option value="1989">1989</option>
                            <option value="1988">1988</option>
                            <option value="1987">1987</option>
                            <option value="1986">1986</option>
                            <option value="1985">1985</option>
                            <option value="1984">1984</option>
                            <option value="1983">1983</option>
                            <option value="1982">1982</option>
                            <option value="1981">1981</option>
                            <option value="1980">1980</option>
                       	</select>
               		</div>
               	</div>
                <?php echo form_error('bdate'); ?>
           	</div>
            <div class="form-group">
          	  	<div class="row">
					<div class="col-xs-4">
                       	<div class="radio">
                       		<label>
                           		<input type="radio" name="gender" value="M" checked>
                           		Male
                       		</label>
                       	</div>
               	    </div>
                    <div class="col-xs-4">
                       	<div class="radio">
                       		<label>
                          		<input type="radio" name="gender" value="F" >
                           		Female
                       		</label>
                       	</div>
                    </div>
            	</div>
			</div>
           	<div class="form-group">
              	<div class="row">
                	<div class="col-xs-12">
	                	<button class="btn btn-success">Create Account</button>
                    </div>
                </div>   
       		</div>
		</form>
	</div>
</div> <!-- content end -->
    