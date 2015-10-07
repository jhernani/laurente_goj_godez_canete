<div class="container main"> <!-- content start -->
	<div class="col-xs-4">
    	<div class="profile">
        	<img src="<?php echo assets_url();?>profiles/profile-default.png" class="img-thumbnail img-responsive">
        </div>
    </div>
    <div class="col-xs-8">
    	<div class="page-header">
          <h1>Welcome to USC Dormitories</h1>
        </div>
        <div>
        	<p>Please use the form below to search for rooms.</p>
            <div class="col-xs-10 well">
                <form class="form" action="<?php echo base_url()."index.php/dorm" ?>" method="POST">
                	<h3>Search Room</h3>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-4">
                                <label class="control-label">Building Name</label>
                                <select class="form-control input-lg" name="blg">
                                    <option value="">Select</option>
                                    <option value="1">Saint Mary</option>
                                    <option value="2">Saint Joseph</option>
                                    <option value="3">Saint Arnold</option> 
                                    <option value="4">New building 1</option> 
                                    <option value="5">New building 2</option>                                    
                          		</select>
                                <?php echo form_error('blg')?>
                            </div>
							<div class="col-xs-4">
                                <label class="control-label">Type</label>
                                <select class="form-control input-lg" name="rm_type">
                                    <option value="">Select</option>
                                    <option value="0">Standard</option>
                                    <option value="1">Premium</option>                                   
                          		</select>
                                <?php echo form_error('rm_type')?>
                            </div>
							<div class="col-xs-4">
                                <label class="control-label">Capacity</label>
                                <select class="form-control input-lg" name="rm_cap">
                                    <option value="">Select</option>
                                    <option value="6">Room for 6</option>
                                    <option value="4">Room for 4</option>
                                    <option value="2">Room for 2</option>
                                    <option value="1">Room for 1</option>                                   
                          		</select>  
                                <?php echo form_error('rm_cap')?>
                            </div>
                        </div>           
                    </div>
                    <div class="form-group">
                        <div class="row">
                   			<div class="col-xs-6">
								<button class="btn btn-success btn-lg"type="submit">Search</button>
                            </div>
                        </div>           
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div> <!-- content end -->
    