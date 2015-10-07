<div class="container main">
	<div class="col-xs-4">
		<div class="profile">
        	<img src="<?php echo assets_url() . $path ?>" class="img-thumbnail img-responsive">
        </div>
    </div>
    <div class="col-xs-8">
    	<div class="row">
            <div class="list-group-item">Privacy Settings</div>
			<div class="col-xs-6">
				<table class="table">
					<tr>
						<td><b>Course/Year</b></td>
						<td>
							<form action="<?php echo base_url() . "index.php/settings/privacy" ?> " method='POST'>
								<?php
									switch($p_course)
									{
										case '0': echo "<button class='btn btn-success' value='course' name='var' type='submit'> Show on profile </button>";
												break;
										case '1': echo "<button class='btn btn-danger' value='course' name='var' type='submit'> Hide from profile </button>";
												break;
									}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td><b>Birth Date</b></td>
						<td>
							<form action="<?php echo base_url() . "index.php/settings/privacy" ?> " method='POST'>
								<?php
									switch($p_bdate)
									{
										case '0': echo "<button class='btn btn-success' value='bdate' name='var' type='submit'> Show on profile </button>";
												break;
										case '1': echo "<button class='btn btn-danger' value='bdate' name='var' type='submit'> Hide from profile </button>";
												break;
									}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td><b>Gender</b></td>
						<td>
							<form action="<?php echo base_url() . "index.php/settings/privacy" ?> " method='POST'>
								<?php
									switch($p_gender)
									{
										case '0': echo "<button class='btn btn-success' value='gender' name='var' type='submit'> Show on profile </button>";
												break;
										case '1': echo "<button class='btn btn-danger' value='gender' name='var' type='submit'> Hide from profile </button>";
												break;
									}
								?>
							</form>
						</td>
					</tr>
					<tr>
						<td><b>Email</b></td>
						<td>
							<form action="<?php echo base_url() . "index.php/settings/privacy" ?> " method='POST'>
								<?php
									switch($p_email)
									{
										case '0': echo "<button class='btn btn-success' value='email' name='var' type='submit'> Show on profile </button>";
												break;
										case '1': echo "<button class='btn btn-danger' value='email' name='var' type='submit'> Hide from profile </button>";
												break;
									}
								?>
							</form>
						</td>
					</tr>		
				</table>
			</div>
        </div>  
    </div>
</div>
    