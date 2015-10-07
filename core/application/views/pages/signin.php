<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400|Open+Sans:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo assets_url();?>css/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo assets_url();?>css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo assets_url();?>css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo assets_url();?>css/origami.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo assets_url();?>css/responsive.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo assets_url();?>css/style-orange.css"/>
    <!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php echo assets_url();?>css/font-awesome/css/font-awesome-ie7.min.css">
    <![endif]-->
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="<?php echo assets_url();?>css/ie8.css"/>
    <![endif]-->
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo assets_url();?>js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo assets_url();?>js/jquery.easing.js"></script>
    <script type="text/javascript" src="<?php echo assets_url();?>js/jquery-ui-1.10.3.custom.js"></script>
    <script type="text/javascript" src="<?php echo assets_url();?>js/jquery.cycle2.js"></script>
    <script type="text/javascript" src="<?php echo assets_url();?>js/origami.js"></script>
    <script type="text/javascript" src="<?php echo assets_url();?>js/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo assets_url();?>js/responsive-nav.js"></script>
    <script type="text/javascript" src="<?php echo assets_url();?>js/jquery.lavalamp.min.js"></script>
    <script type="text/javascript" src="<?php echo assets_url();?>js/script.js"></script>
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <title>CRASS</title>
</head>
<body>
    <!-- HEADER -->
    <header>
       <!-- /.md-nav-wrap -->
        <div id="md-spotlight" class="md-spotlight">
            <div class="md-pt-slide">
                <img src="<?php echo assets_url();?>img/signin.jpg" alt="">
            </div>  
            <div class="wrap1120">
                <div class="grid_16">
                    <div class="md-intro"> 
                        <h1><font color="lightgreen"><strong>SIGN IN</strong></font>
                        
                        <div class="md-btn-group">
                            <div class="row">
            <div class="col-xs-4 col-xs-offset-4" style="padding-left:50px; padding-top:-50px;">
               <div class="row">
                   <div class="alert">
                        <?php 
                           if(form_error('user')){
                        echo "<div class='alert alert-warning'>Enter your email address.</div>";
                           }
                           else if(form_error('pass')){
                            echo "<div class='alert alert-warning'>Enter your password.</div>";
                           }
                      echo $error; 
                             ?>
                    </div>
            </div>
            <div class="col-xs-8 col-xs-offset-2">
                <form class="form-horizontal" action="<?php echo base_url()."index.php/auth/signin" ?>" method="POST">
                    <div class="form-group">
                        <label class="sr-only">User/Email</label>
                        <input type="text" class="form-control input-lg" placeholder="Email" value="<?php echo set_value('user'); ?>" name="user">
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Password</label>
                        <input type="password" class="form-control input-lg" placeholder="Password" name="pass">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </div>
                </form>
            </div>
            <div>
                <p class="text-center"><a href="<?php echo base_url()."index.php/auth/register" ?>">REGISTRATION AND RESERVATION</a></p>
            </div>
           
        </div>
                        </div>
                    </div>
                    
                
                <div class="clear"></div>
            </div>
        </div>
    </header>
    
</body>
</html>