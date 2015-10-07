<div class="container main">
	<div class="col-xs-4">
    	<div class="profile">
        	<img src="<?php echo assets_url(). $path ?>" class="img-thumbnail img-responsive">	
			<form class="form" action="<?php $this->input->server('PHP_SELF')?>" enctype="multipart/form-data" method="POST">
			<input type="file" name="userfile" size="20" />
			<button class="btn btn-block btn-success" type="submit" name="upload" value="upload">Upload</button>
			<?php echo $error ?>
        </div>
    </div>
    <div class="col-xs-8">
    	<div class="row">
            <div class="list-group">
                <div class="list-group-item" id="acc-tab">Account</div>
                    <div class="hide" id="acc">
                    	<div class="col-xs-7">
                        	<table class="table">
                                <tr>
                                    <td>Username: </td>
                                    <td><?php echo $uname ?></td>
                                    <td><a href="#" id="username-edit">Change</a></td>
                                </tr>
                                <tr class="hide" id="username-form">
                                    <td colspan="3">
                                    	<div class="col-xs-7">
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label">Username</label>
                                                    <input type="text" class="form-control input-sm" id="username_form_user">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" class="form-control input-sm" id="username_form_pword">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success" type="button" onclick="username()">Save</button>
                                                </div>
                                            </form>
                                            <div id="username_form_result"></div>
                                        </div>
                                    </td>
                                </tr>                               
                                <tr>
                                    <td>Password </td>
                                    <td>**************</td>
                                    <td><a href="#" id="pass-edit">Change</a></td>
                                </tr>
                                <tr class="hide" id="pass-form">
                                    <td colspan="3">
                                    	<div class="col-xs-7">
                                            <form class="form-horizontal">
                                            	<div class="form-group">
                                                	<label class="control-label">Password</label>
                                                    <input type="password" class="form-control input-sm" id="pword_form_pword">
                                           	    </div>
                                                <div class="form-group">
                                	                <label class="control-label">New password</label>
                            	                    <input type="password" class="form-control input-sm" id="pword_form_newpword">
                           	                    </div>
                       	                        <div class="form-group">
                	                                <label class="control-label">Confirm new password</label>
               	                                    <input type="password" class="form-control input-sm" id="pword_form_newpwordconf">
           	                                    </div>
       	                                        <div class="form-group">
	                                                <button class="btn btn-success" type="button" onclick="password()">Save</button>
                    	                          </div>
                  	                        </form>
                                            <div id="pword_form_result"></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>                    	
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="list-group">
                <div class="list-group-item" id="pass-tab">Personal Information</div>
                    <div class="hide" id="pass">
                        <div class="col-xs-7">
                        	<table class="table">                              
                                <tr>
                                    <td>Name </td>
                                    <td><?php echo $fname." ".$mname." ".$lname ?></td>
                                    <td><a href="#" id="name-edit">Change</a></td>
                                </tr>
                                <tr class="hide" id="name-form">
                                    <td colspan="3">
                                    	<div class="col-xs-7">
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" class="form-control input-sm" id="name_form_fname">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Middle Name</label>
                                                    <input type="text" class="form-control input-sm" id="name_form_mname">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" class="form-control input-sm" id="name_form_lname">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" class="form-control input-sm" id="name_form_pword">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success" type="button" onclick="fullname()">Save</button>
                                                </div>
                                            </form>
                                            <div id="name_form_result"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Birth Date </td>
                                    <td><?php echo $bdate ?></td>
                                    <td><a href="#" id="bdate-edit">Change</a></td>
                                </tr>
                                <tr class="hide" id="bdate-form">
                                    <td colspan="3">
                                    	<div class="col-xs-10">
                                            <form class="form-horizontal">
                                            	<div class="form-group">
                                                    <div class="col-xs-4">
                                                        <label class="sr-only">Month</label>
                                                        <select class="form-control input-sm" id="bdate_form_month">
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
                                                    <div class="col-xs-4">
                                                        <label class="sr-only">Day</label>
                                                        <select class="form-control input-sm" id="bdate_form_day">
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
                                                        <select class="form-control input-sm" id="bdate_form_year">
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
                                                <div class="form-group">
                                                	<div class="col-xs-9">
                                                        <label class="control-label">Password</label>
                                                        <input type="password" class="form-control input-sm" id="bdate_form_pword">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success" type="button" onclick="bdate()">Save</button>
                                                </div>
                                            </form>
                                            <div id="bdate_form_result"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Guardian </td>
                                    <td><?php echo $g_fname." ".$g_mname." ".$g_lname ?></td>
                                    <td><a href="#" id="gname-edit">Change</a></td>
                                </tr>
                                <tr class="hide" id="gname-form">
                                    <td colspan="3">
                                    	<div class="col-xs-7">
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label">Guardian's First Name</label>
                                                    <input type="text" class="form-control input-sm" id="g_name_form_fname">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Guardian's Middle Name</label>
                                                    <input type="text" class="form-control input-sm" id="g_name_form_mname">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Guardian's Last Name</label>
                                                    <input type="text" class="form-control input-sm" id="g_name_form_lname">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" class="form-control input-sm" id="g_name_form_pword">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success" type="button" onclick="gfullname()">Save</button>
                                                </div>
                                            </form>
                                            <div id="g_name_form_result"></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                    	</div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="list-group">       
                <div class="list-group-item" id="contact-tab">Contact Details</div>          
                    <div class="hide" id="contact">
                    	<div class="col-xs-8">
                            <table class="table">
                                <tr>
                                    <td>E-mail: </td>
                                    <td><?php echo $email ?></td>
                                    <td><a href="#" id="email-edit">Change</a></td>
                                </tr>
                                <tr class="hide" id="email-form">
                                    <td colspan="3">
                                    	<div class="col-xs-7">
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label">E-mail</label>
                                                    <input type="text" class="form-control input-sm" id="email_form_email">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" class="form-control input-sm" id="email_form_pword">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success" type="button" onclick="emailadd()">Save</button>
                                                </div>
                                            </form>
                                            <div id="email_form_result"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone number: </td>
                                    <td><?php echo $contact ?></td>
                                    <td><a href="#" id="phone-edit">Change</a></td>
                                </tr>
                                <tr class="hide" id="phone-form">
                                    <td colspan="3">
                                    	<div class="col-xs-7">
                                            <form class="form-horizontal" action="#" method="POST">
                                                <div class="form-group">
                                                    <label class="control-label">Phone number</label>
                                                    <input type="text" class="form-control input-sm" name="contact-form-contact">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" class="form-control input-sm" name="contact-form-pword">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success" type="button" onclick="contact">Save</button>
                                                </div>
                                            </form>
											<div id="contact_form_result"></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
        </div>  
    </div>
</div>
    