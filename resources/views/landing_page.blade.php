<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gender Based Violence Reporting and Tracking Platform</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">    
    <link rel="shortcut icon" href="favicon.ico">  
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
    <!-- FontAwesome JS-->
	<script defer src="{{ asset('landing_page_assets/assets/fontawesome/js/all.min.js') }}"></script>
    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('landing_page_assets/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="{{ asset('landing_page_assets/assets/plugins/prism/prism.css') }}">
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{ asset('landing_page_assets/assets/css/theme-1.css') }}">
    <!-- GitHub Button -->
    <script async defer src="https://buttons.github.io/buttons.js"></script> 
</head> 

<body data-spy="scroll">
	
   

    <!---//Facebook button code-->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
    <!-- ******HEADER****** --> 
    <header id="header" class="header">  
        <div class="container">            
            <h1 class="logo float-left">
                <a class="scrollto" href="#promo">
                    <span class="logo-title">GBVRT</span>
                </a>
            </h1><!--//logo-->              
            <nav id="main-nav" class="main-nav navbar-expand-md float-right" role="navigation">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><!--//nav-toggle-->
                           
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item sr-only"><a class="nav-link scrollto" href="#promo">Home</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" href="#features">Features</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" href="#docs">Guide</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" href="#license">How To</a></li>                        
                        <li class="nav-item last"><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div>
    </header><!--//header-->
    
    <!-- ******PROMO****** -->
    <section id="promo" class="promo section offset-header">
        <div class="container text-center">
            <h2 class="title"><span class="highlight">GBVRT</span></h2>
            <p class="intro">A platform for reporting gender based violence related cases.</p>
            <div class="btns">
                <a class="btn btn-cta-secondary" href="{{ route('login.page') }}" target="_blank">Sign in</a>
                <a class="btn btn-cta-primary" href="{{ route('signup.page') }}" target="_blank">Register</a>
            </div>
            
            <br>
            
            <!--//meta-->
        </div><!--//container-->
       
    </section><!--//promo-->
    
    <!-- ******ABOUT****** --> 
    <section id="about" class="about section">
        <div class="container">
            <h2 class="title text-center">What is GBVRT?</h2>
            <p class="intro text-center">GBVRT stands for Gender Based Violence Tracking and Monitoring System, which is tool that lets people easily report cases of gender based violence in the community. It also enables organisations that fight such forms of violence to keep track of these violence occurances and also take necessary actions against them. </p>
            <div class="row">
                <div class="item col-lg-4 col-md-6 col-12">
                    <div class="icon-holder">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Report Violence Cases</h3>
                        <p>The GBVRT platform is built to enable fast access to violence reporting tools for all users.</p>
                    </div><!--//content-->
                </div><!--//item-->
                <div class="item col-lg-4 col-md-6 col-12">
                    <div class="icon-holder">
                        <i class="far fa-clock"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Partner Organistations</h3>
                        <p>Using our system, organisations that deal in the fight against gender based violence can easily track violence occurrances in their area of operation.</p>
                    </div><!--//content-->
                </div><!--//item-->
                <div class="item col-lg-4 col-md-6 col-12">
                    <div class="icon-holder">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Counseling</h3>
                        <p>Counselling services are are also availed to users as a feature through partner organisations.</p>
                    </div><!--//content-->
                </div><!--//item-->           
                <div class="clearfix visible-md"></div>    
                <div class="item col-lg-4 col-md-6 col-12">
                    <div class="icon-holder">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Free Access</h3>
                        <p>Anybody can signup for a GBVRT account for free and access all the available services and features.</p>
                    </div><!--//content-->
                </div><!--//item-->                
                <div class="item col-lg-4 col-md-6 col-12">
                    <div class="icon-holder">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Easy to Use</h3>
                        <p>The GBVRT platform is designed to be simple to use with a basic user interface and easy to locate features.</p>
                    </div><!--//content-->
                </div><!--//item-->
                <div class="item col-lg-4 col-md-6 col-12">
                    <div class="icon-holder">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Privacy</h3>
                        <p>GBVRT does not use user data in anyway without the prior consent of the users</p>
                    </div><!--//content-->
                </div><!--//item-->               
            </div><!--//row-->            
        </div><!--//container-->
    </section><!--//about-->
    
    <!-- ******FEATURES****** --> 
    <section id="features" class="features section">
        <div class="container text-center">
            <h2 class="title">Features</h2>
            <ul class="feature-list list-unstyled">
                <li><i class="fas fa-check"></i>Free Account Creation</li>
                <li><i class="fas fa-check"></i>Easy to use</li>
                <li><i class="fas fa-check"></i>Always available</li>
                <li><i class="fas fa-check"></i>Privacy of user data</li>
            </ul>
        </div><!--//container-->
    </section><!--//features-->
    
    <!-- ******DOCS****** --> 
    <section id="docs" class="docs section">
        <div class="container">
            <div class="docs-inner">
            <h2 class="title text-center">Get Started</h2>            
            <div class="block">
                <h3 class="sub-title text-center">SignUp</h3>
                <p><a href="{{ route('signup.page') }}" target="_blank">Register</a> to start using our platform.</p>
                <p>At GBVRT, we know that gender based violence is a crime to humanity and that is why we offer a free to use platfrom for reporting such crimes. You only have to create an account and start reporting these crimes.</p>
               
            
            </div><!--//block-->
            
            <div class="block">
                <h3 class="sub-title text-center">Counselling</h3>
                <p>Our partner organisations offer free counselling through phone calls to try and remove the emotional distress that comes from the effect of gender based violence on victims.</p>
            </div><!--//block-->
            
         
           
            </div><!--//docs-inner-->         
        </div><!--//container-->
    </section><!--//features-->
    
    <!-- ******LICENSE****** --> 
    <section id="license" class="license section">
        <div class="container">
            <div class="license-inner">
            <h2 class="title text-center">How To Use GBVRT</h2>
                <div class="info">
                    <p>Register using the Sign Up Button below to create an Account.
                       Then Login with your created email and password.
                       In the dashboard, click the Report Case button and Enter Report in 
                       the fields.
                    </p>
                    
                </div><!--//info-->
                <div class="cta-container">
                    <div class="speech-bubble">                    
                        <p class="intro">Please note that <strong>creating an account is free</strong>, and no one is going to ask you for any payments while using our platform.</p>
                        <div class="icon-holder  text-center"><i class="far fa-smile"></i></div>
                    </div><!--//speech-bubble-->
                    <div class="btn-container  text-center">
                        <a class="btn btn-cta-secondary" href="{{ route('signup.page') }}" target="_blank">Sign Up</a>                   
                    </div><!--//btn-container-->
                </div><!--//cta-container-->
            </div><!--//license-inner-->
        </div><!--//container-->
    </section><!--//how-->
    
    <!-- ******CONTACT****** --> 
    <section id="contact" class="contact section has-pattern">
        <div class="container">
            <div class="contact-inner">
                <h2 class="title  text-center">Contact Us</h2>
                <p class="intro  text-center">Contact us today by sending us an email or give us a call at any time.<br />Feel free to get in touch if you have any questions or suggestions.
                <br /> <br /> Telephone: +256 765 5354 334. <br />Email: gbvrt@gmail.com</p>
                
                
                
               
                <div class="clearfix"></div>
                
            </div><!--//contact-inner-->
        </div><!--//container-->
    </section><!--//contact-->  
      
    <!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="container text-center">
            <small class="copyright"><span>&#169</span> GBVRT SYSTEM 2021</small>
        </div><!--//container-->
    </footer><!--//footer-->
     
    <!-- Javascript -->          
    <script type="text/javascript" src="{{ asset('landing_page_assets/assets/plugins/jquery-3.4.1.min.js') }}"></script>   
    <script type="text/javascript" src="{{ asset('landing_page_assets/assets/plugins/jquery.easing.1.3.js') }}"></script>   
    <script type="text/javascript" src="{{ asset('landing_page_assets/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>     
    <script type="text/javascript" src="{{ asset('landing_page_assets/assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('landing_page_assets/assets/plugins/prism/prism.js') }}"></script>    
    <script type="text/javascript" src="{{ asset('landing_page_assets/assets/js/main.js') }}"></script>  
    
        
</body>
</html> 

