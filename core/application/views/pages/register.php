<div style="background:#E7F3E7;">
<div class="container">
  <div class="row">
      <div class="col-xs-7">
        <h1> Reservation Instructions</h1>
             <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Fill Up the registration form<span class="text-muted"></span></h2>
          <p class="lead">Use your real information. It will be used during the interview</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="<?php echo assets_url();?>img/reg_1.png" alt="Register">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="<?php echo assets_url();?>img/reg_2.png" alt="Choose a building">
        </div>
        <div class="col-md-7">
          <h2 class="featurette-heading">Choose a building and a room<span class="text-muted"></span></h2>
          <p class="lead">After you register successfully choose a building and a room that you like.</p>
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Print the reservation slip<span class="text-muted"></span></h2>
          <p class="lead">Please proceed to the dormitory office for screening and interview within 2 weeks.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="<?php echo assets_url();?>img/reg_3.png" alt="Print the slip">
        </div>
      </div>

      <hr class="featurette-divider">
        </div>
        <div class="col-xs-5">
          <h1>Register</h1>
            <p class="lead">to reserve a room</p>
          <form class="form" action="<?php echo base_url()."index.php/auth/register" ?>" method="POST">
        <div class="form-group">
                  <div class="row">
                      <div class="col-xs-6">
						  <label class="sr-only">ID Number</label>
						  <input class="form-control input-lg" type="text" name="id_number" value="<?php echo set_value('id_number'); ?>" placeholder="ID Number"> 
						  <?php echo form_error('id_number'); ?>
						</div>  
                    </div>           
                </div>
              <div class="form-group">
                  <div class="row">
                      <div class="col-xs-6">
                          <label class="sr-only">First Name</label>
                          <input class="form-control input-lg" type="text" name="fname" value="<?php echo set_value('fname'); ?>" placeholder="First Name"> 
                            <?php echo form_error('fname') ?>
                        </div>
                        <div class="col-xs-6">
                          <label class="sr-only">Last Name</label>
                          <input class="form-control input-lg" type="text" name="lname" value="<?php echo set_value('lname'); ?>" placeholder="Last Name">     
                            <?php echo form_error('lname'); ?>                   
                        </div>                     
                    </div>           
                </div>
                <div class="form-group">
					  <label class="sr-only">Password</label>
					  <input class="form-control input-lg" type="password" name="pword" value="<?php echo set_value('pword'); ?>" placeholder="Password">
						<?php echo form_error('pword'); ?>
              </div>
                <div class="form-group">
                  <label class="sr-only">Confirm Password</label>
                  <input class="form-control input-lg" type="password" name="pwordconf" value="<?php echo set_value('pwordconf'); ?>" placeholder="Confirm Password">
                    <?php echo form_error('pwordconf'); ?>
                </div>
                <div class="form-group">
					<label class="sr-only">Email</label>
					<input class="form-control input-lg" type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email">
					<?php echo form_error('email'); ?>
				</div>
				<div class="form-group">
					<label class="sr-only">Contact</label>
					<input class="form-control input-lg" type="text" name="contact" value="<?php echo set_value('contact'); ?>" placeholder="Contact Number">
					<?php echo form_error('contact'); ?>
				</div>
              <h3>Course & Year</h3>
              <div class="form-group">
                <div class="row">
                      <div class="col-xs-8">
                          <label class="sr-only">Course</label>
                          <select class="form-control input-lg" name="course">
                              <option value="0">Course</option>
                              <option value="1" <?php echo set_select('course','1') ?> >BSICT</option>
                              <option value="2" <?php echo set_select('course','2') ?> >BSIT</option>
                              <option value="3" <?php echo set_select('course','3') ?> >BSN</option>
                              <option value="4" <?php echo set_select('course','4') ?> >BSPharma</option>
                              <option value="5" <?php echo set_select('course','5') ?> >BSChemE</option>
                              <option value="6" <?php echo set_select('course','6') ?> >BSCE</option>
                              <option value="7" <?php echo set_select('course','7') ?> >BSECE</option>
                                <option value="8" <?php echo set_select('course','8') ?> >BSME</option>
                                <option value="9" <?php echo set_select('course','9') ?> >BSArchi</option>
                                <option value="10" <?php echo set_select('course','10') ?> >BSID</option>
                                <option value="11" <?php echo set_select('course','11') ?> >BSAccountancy</option>
                                <option value="12" <?php echo set_select('course','12') ?> >BSHRM</option>
                              <option value="13" <?php echo set_select('course','13') ?> >BSBA</option>                                    
                            </select>                           
                      </div>
                      <div class="col-xs-4">
                          <label class="sr-only">Level</label>
                          <select class="form-control input-lg" name="lv">
                              <option value="0">Level</option>
                              <option value="1" <?php echo set_select('lv','1') ?> >1</option>
                              <option value="2" <?php echo set_select('lv','2') ?> >2</option>
                                <option value="3" <?php echo set_select('lv','3') ?> >3</option>
                              <option value="4" <?php echo set_select('lv','4') ?> >4</option>
                                <option value="5" <?php echo set_select('lv','5') ?> >5</option>
                            </select>
                      </div>
                  </div>
                    <?php echo form_error('course'); ?>
              </div>
              <h3>Birthdate</h3>
                <div class="form-group">
                <div class="row">
                    <div class="col-xs-5">
                          <label class="sr-only">Month</label>
                          <select class="form-control input-lg" name="month">
                            <option value="0">Month</option>
                                <option value="1" <?php echo set_select('month','1') ?> >January</option>
                                <option value="2" <?php echo set_select('month','2') ?> >February</option>
                                <option value="3" <?php echo set_select('month','3') ?> >March</option>
                                <option value="4" <?php echo set_select('month','4') ?> >April</option>
                                <option value="5" <?php echo set_select('month','5') ?> >May</option>
                                <option value="6" <?php echo set_select('month','6') ?> >June</option>
                                <option value="7" <?php echo set_select('month','7') ?> >July</option>
                                <option value="8" <?php echo set_select('month','8') ?> >August</option>
                                <option value="9" <?php echo set_select('month','9') ?> >September</option>
                                <option value="10" <?php echo set_select('month','10') ?> >October</option>
                                <option value="11" <?php echo set_select('month','11') ?> >November</option>
                                <option value="12" <?php echo set_select('month','12') ?> >December</option>                              
                          </select>
                      </div>
                        <div class="col-xs-3">
                          <label class="sr-only">Day</label>
                          <select class="form-control input-lg" name="day">
                              <option value="0">Day</option>
                                <option value="1" <?php echo set_select('day','1') ?> >1</option>
                                <option value="2" <?php echo set_select('day','2') ?> >2</option>
                                <option value="3" <?php echo set_select('day','3') ?> >3</option>
                                <option value="4" <?php echo set_select('day','4') ?> >4</option>
                                <option value="5" <?php echo set_select('day','5') ?> >5</option>
                                <option value="6" <?php echo set_select('day','6') ?> >6</option>
                                <option value="7" <?php echo set_select('day','7') ?> >7</option>
                                <option value="8" <?php echo set_select('day','8') ?> >8</option>
                                <option value="9" <?php echo set_select('day','9') ?> >9</option>
                                <option value="10" <?php echo set_select('day','10') ?> >10</option>
                                <option value="11" <?php echo set_select('day','11') ?> >11</option>
                                <option value="12" <?php echo set_select('day','12') ?> >12</option>
                                <option value="13" <?php echo set_select('day','13') ?> >13</option>
                                <option value="14" <?php echo set_select('day','14') ?> >14</option>
                                <option value="15" <?php echo set_select('day','15') ?> >15</option>
                                <option value="16" <?php echo set_select('day','16') ?> >16</option>
                                <option value="17" <?php echo set_select('day','17') ?> >17</option>
                                <option value="18" <?php echo set_select('day','18') ?> >18</option>
                                <option value="19" <?php echo set_select('day','19') ?> >19</option>
                                <option value="20" <?php echo set_select('day','20') ?> >20</option>
                                <option value="21" <?php echo set_select('day','21') ?> >21</option>
                                <option value="22" <?php echo set_select('day','22') ?> >22</option>
                                <option value="23" <?php echo set_select('day','23') ?> >23</option>
                                <option value="24" <?php echo set_select('day','24') ?> >24</option>
                                <option value="25" <?php echo set_select('day','25') ?> >25</option>
                                <option value="26" <?php echo set_select('day','26') ?> >26</option>
                                <option value="27" <?php echo set_select('day','27') ?> >27</option>
                                <option value="28" <?php echo set_select('day','28') ?> >28</option>
                                <option value="29" <?php echo set_select('day','29') ?> >29</option>
                                <option value="30" <?php echo set_select('day','30') ?> >30</option>
                                <option value="31" <?php echo set_select('day','31') ?> >31</option>
                            </select>
                        </div>
                      <div class="col-xs-4">
                          <label class="sr-only">Year</label>
                          <select class="form-control input-lg" name="year">
                            <option value="0">Year</option>
								<option value="2014" <?php echo set_select('year','2014') ?> >2014</option>
								<option value="2013" <?php echo set_select('year','2013') ?> >2013</option>
								<option value="2012" <?php echo set_select('year','2012') ?> >2012</option>
								<option value="2011" <?php echo set_select('year','2011') ?> >2011</option>
								<option value="2010" <?php echo set_select('year','2010') ?> >2010</option>
								<option value="2009" <?php echo set_select('year','2009') ?> >2009</option>
								<option value="2008" <?php echo set_select('year','2008') ?> >2008</option>
								<option value="2007" <?php echo set_select('year','2007') ?> >2007</option>
								<option value="2006" <?php echo set_select('year','2006') ?> >2006</option>
								<option value="2005" <?php echo set_select('year','2005') ?> >2005</option>
								<option value="2004" <?php echo set_select('year','2004') ?> >2004</option>
								<option value="2003" <?php echo set_select('year','2003') ?> >2003</option>
								<option value="2002" <?php echo set_select('year','2002') ?> >2002</option>
								<option value="2001" <?php echo set_select('year','2001') ?> >2001</option>
								<option value="2000" <?php echo set_select('year','2000') ?> >2000</option>
                                <option value="1999" <?php echo set_select('year','1999') ?> >1999</option>
                                <option value="1998" <?php echo set_select('year','1998') ?> >1998</option>
                                <option value="1997" <?php echo set_select('year','1997') ?> >1997</option>
                                <option value="1996" <?php echo set_select('year','1996') ?> >1996</option>
                                <option value="1995" <?php echo set_select('year','1995') ?> >1995</option>
                                <option value="1994" <?php echo set_select('year','1994') ?> >1994</option>
                                <option value="1993" <?php echo set_select('year','1993') ?> >1993</option>
                                <option value="1992" <?php echo set_select('year','1992') ?> >1992</option>
                                <option value="1991" <?php echo set_select('year','1991') ?> >1991</option>
                                <option value="1990" <?php echo set_select('year','1990') ?> >1990</option>
                                <option value="1989" <?php echo set_select('year','1989') ?> >1989</option>
                                <option value="1988" <?php echo set_select('year','1988') ?> >1988</option>
                                <option value="1987" <?php echo set_select('year','1987') ?> >1987</option>
                                <option value="1986" <?php echo set_select('year','1986') ?> >1986</option>
                                <option value="1985" <?php echo set_select('year','1985') ?> >1985</option>
                                <option value="1984" <?php echo set_select('year','1984') ?> >1984</option>
                                <option value="1983" <?php echo set_select('year','1983') ?> >1983</option>
                                <option value="1982" <?php echo set_select('year','1982') ?> >1982</option>
                                <option value="1981" <?php echo set_select('year','1981') ?> >1981</option>
                                <option value="1980" <?php echo set_select('year','1980') ?> >1980</option>
								<option value="1979" <?php echo set_select('year','1980') ?> >1979</option>
								<option value="1978" <?php echo set_select('year','1980') ?> >1978</option>
								<option value="1977" <?php echo set_select('year','1980') ?> >1977</option>
								<option value="1976" <?php echo set_select('year','1980') ?> >1976</option>
								<option value="1975" <?php echo set_select('year','1980') ?> >1975</option>
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
                                <input type="radio" name="gender" value="M" <?php echo set_radio('gender', 'M', TRUE)?> >
                                Male
                              </label>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="radio">
                              <label>
                                <input type="radio" name="gender" value="F" <?php echo set_radio('gender', 'F')?> >
                                Female
                              </label>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                <div class="checkbox">
                      <label>
                          <input type="checkbox" name="terms"> I agree to CRASS <a href="#">Terms of Service</a>
                        </label>
                    </div>   
                    <?php echo form_error('terms'); ?>
              </div>
                <div class="form-group">
                  <div class="row">
                      <div class="col-xs-12">
                          <button class="btn btn-block btn-lg btn-success">Register</button> 
                        </div>
                    </div>   
              </div>
          </form>
        </div>
    </div>
</div>
    </div>