<div class="container main">
	<div class="col-xs-4">
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
                            </table>
                        </div>
                    </div>
            </div>
        </div>  
    </div>
</div>
    