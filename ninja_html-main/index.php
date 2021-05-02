<?php 

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'designstring');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("error2: Could not connect. " . mysqli_connect_error2());
}
	
// Define variables and initialize with empty values
$name = $email = "";
$name_err = $email_err = "";

// Processing form data when form is submitted

if(isset($_POST['submit']))
{
    // Validate name
    $input_name = ($_POST["name"]);
    if(empty($input_name)){
        $name_err = "<p><label class='text-danger'>Please enter a name.</label></p>";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/",$name)))){
        $name_err = "<p><label class='text-danger'>Please enter a valid name..</label></p>";
	} else{
        $name = $input_name;
    }
    
	// Validate email
$input_email = ($_POST["email"]);
    if(empty($input_email))
 {
  $email_err .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email =($_POST["email"]);
  if(!filter_var($input_email, FILTER_VALIDATE_EMAIL))
  {
   $email_err .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
    
			
				
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($contact_err)){
		
	
        // Prepare an insert statement	
        $sql = "INSERT INTO contact_form (name, email) VALUES ('".$name."','".$email."')";

        if($stmt = mysqli_prepare($link, $sql)){
           
            // Set parametersX
            $param_name = $name;
            $param_email = $email;

  // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
				echo "";
				require 'mailer/PHPMailerAutoload.php';

			$mail = new PHPMailer;

			$mail->SMTPDebug =0;                               // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'yokiidesignstring145@gmail.com';                 // SMTP username
			$mail->Password = 'yokii@145';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                     // TCP port to connect to
			
			$mail->setFrom('yokiidesignstring145@gmail.com');
			$mail->addAddress('info@designstring.com');     // Add a recipient
// 			$mail->addAddress($email);               // Name is optional
			//$mail->addReplyTo($email, 'Thank you for your suggestion....!!!!');
			
			//$mail->addCC('yokiidevar145@gmail.com');
			// $mail->addBCC('bcc@example.com');

			//$mail->addAttachment($url); // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML
			
			//$mail->Subject = $titledescrp;
		
			$mail->Body  = '
								<html>
								<head>
								  <title></title>
								</head>
								<body>
									<img src="images\x_logo3.png" alt="">
									<p style="color:black;"><strong>Dear Designstring Players,</strong><br> This is yogeshwaran M from Coimbatore location i finished my task. Here i attached the details.</p>
													
										
									<table style="width: 50%;">
									<p style="color:black;"><strong>The User Details :</strong></p>
										<tbody>
											
											<tr><td style="border:none;"><strong>Name:</strong> '. $name .'</td></tr>
											<tr><td style="border:none;"><strong>Email:</strong> '. $email .'</td></tr>
										</tbody>
									</table>
								</body>
								</html>
							';
					
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				//header('Location: reply_mail.php');
				
			if(!$mail->send()) {
				
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} 
			else {
				
				header('Location: thank_you.php');
			}
			}
			exit();

            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        //mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);

?>
<!DOCTYPE html>
<html lang="zxx">  
    
<head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>Design String</title>
        <meta name="description" content="">
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.html">
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/fav1.png">
        <!-- Bootstrap v4.4.1 css -->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <!-- font-awesome css -->
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <!-- flaticon css -->
        <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon.css">
        <!-- animate css -->
        <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
        <!-- owl.carousel css -->
        <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
        <!-- slick css -->
        <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
        <!-- off canvas css -->
        <link rel="stylesheet" type="text/css" href="assets/css/off-canvas.css">
        <!-- magnific popup css -->
        <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
        <!-- Main Menu css -->
        <link rel="stylesheet" href="assets/css/rsmenu-main.css">
        <!-- spacing css -->
        <link rel="stylesheet" type="text/css" href="assets/css/rs-spacing.css">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="style.css"> 
        <!-- responsive css -->
        <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
        <!-- responsive Fonts -->
		<style>
		
		</style>
    </head>
    <body class="defult-home">
        
        <!--Preloader area start here-->
        <div id="loader" class="loader">
            <div class="loader-container"></div>
        </div>
        <!--Preloader area End here--> 
     
		<!-- Main content Start -->
        <div class="main-content">
            
            <!--Full width header Start-->
            <div class="full-width-header">
                <!--Header Start-->
              <?php include"header.php"?>
                <!--Header End-->
            </div>
            <!--Full width header End-->
            <!-- Banner Section Start -->
            <div  class="rs-why-choose pt-120 pb-120 md-pt-75 md-pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 md-pb-60">
                                <h1 class=" " >
                                    Products <span style="font-size:38px;">built with<br>
									the same commitment<br>
									& passion as yours!</span>
                                </h1>
                        </div>
                        <div class="col-lg-6">
                           <div class="image-part">
                               <img src="assets/images/resources/hero_image.png" alt="">
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner Section End -->
            <!-- Process Section Start -->
            <div id="Why"  class="rs-process style6 white-bg pt-120 pb-120 md-pt-70 md-pb-80">
                <div class="container">
                        <h2 class="title new-title mb-50">Why Designstring</h2>
                    <div class="tab-area">
                        <div class="row">
                            <div class="col-lg-6 ">
                                <ul class="nav nav-tabs">
                                    <li>
                                        <a class="tab-item active"  href="#one" data-toggle="tab">
											<img src="assets/images/resources/rating_icon_hover.png"> <span style="color:#03228f; font-size:22px;"> Rating</span>
                                           
                                           <p align="justify">  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text. ever since the 1500s.
										   </p><br>
										   <p align="justify">
												 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
										   </p><br>
										   <p align="justify">
												 Lorem Ipsum is simply dummy text of the printing and typesetting industry.
										   </p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="tab-item" href="#two" data-toggle="tab">
										<img src="assets/images/resources/easy_icon_hover.png"> <span style="color:#03228f; font-size:22px;"> Fast & Easy</span>
                                            <p align="justify" >
												 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
										   </p><br>
										    <p align="justify">
												 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
										   </p><br>
										    <p align="justify">
												 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
										   </p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="tab-item" href="#three" data-toggle="tab">
										<img src="assets/images/resources/streamline_icon_hover.png"> <span style="color:#03228f; font-size:22px;"> Streamline</span>
                                          
                                            <p align="justify">
												Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
										   </p><br>
										    <p align="justify">
												 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
										   </p><br>
										    <p align="justify">
												 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
										   </p>
                                        </a>
                                    </li>             
                                </ul>
                            </div>
							<div class="col-lg-6 pr-40 md-pr-15 md-mb-30">
                                <div class="tab-content">
                                    <div class="tab-pane active show fade" id="one">
                                       <div class="image-wrap">
                                           <img src="assets/images/resources/rating.png" alt="">
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="two">
                                        <div class="image-wrap">
                                            <img src="assets/images/resources/FastEasy.png" alt="">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="three">
                                        <div class="image-wrap">
                                            <img src="assets/images/resources/steamline.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <!-- Process Section End -->
			<!-- Project Section Start -->
            <div id="about" id="rs-portfolio" class="rs-project gray-color style9 pt-120 md-pt-80" >
                <div class="container">
                        <div class="row ">
							<div class="col-md-9">
								<h2 class="title black-color mb-45 md-mb-30">
								About Us 
								</h2> 
								<h3 style="color:#03228f;"><span style="color:#ffa31a; font-size:40px;">"</span> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
								<h6 align="justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

								<br><br>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</h6>
								
							</div>
							<div class="col-md-3" style="background-image:url('assets/images/resources/bg_pattern.png');">
								
							</div>
						</div>
		
                    <div class="rs-carousel owl-carousel" data-loop="true" data-items="4" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="4" data-md-device-nav="true" data-md-device-dots="false">
                    
						<div class="project-item">
                            <div class="project-img">
                                <a href="#"><img src="https://ds-storage.sgp1.cdn.digitaloceanspaces.com/website/assets/team/yash.jpg" alt="images"></a>
                            </div>
							   <div class="project-content">
                                <h3 class="title"><a href="#" style="color:white;">Yash<br><span style="font-size:17px;">CEO</span></a></h3>
                                 
                            </div>
                        </div>
                        <div class="project-item">
                            <div class="project-img">
                                <a href="#"><img src="https://ds-storage.sgp1.cdn.digitaloceanspaces.com/website/assets/team/yash.jpg" alt="images"></a>
                            </div>
                        </div>
                        <div class="project-item">
                            <div class="project-img">
                                <a href="#"><img src="https://ds-storage.sgp1.cdn.digitaloceanspaces.com/website/assets/team/yash.jpg" alt="images"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Section End -->
			<!-- Contact Section Start -->
            <div id="contact" class="rs-contact pt-120 md-pt-80 ">
                <div class="container ">
                    <div class="row">
                        <div class="col-lg-7 md-mb-60">
                          <h2>Subscribe</h2>
						  <h5>Lorem Ipsum is simply dummy text of the <br>printing and typesetting industry.</h5>
                        </div> 
                        <div class="col-lg-5 pl-70 md-pl-15">
                            <div class="contact-widget">
                               <div class="sec-title2 mb-40">
                                   <h2 class="title testi-title">Fill The Form Below</h2>
                               </div>
                                <form  method="post" id="wearethere" name="myform" action="#wearethere" enctype="multipart/form-data" novalidate="novalidate">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12 mb-20 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                                <input class="from-control" type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="Name" >
												<span class="help-block"><?php echo $name_err;?></span>
											</div> 
                                            <div class="col-lg-12 mb-20 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                                <input class="from-control" type="text" id="email" name="email" value="<?php echo $email; ?>"  placeholder="E-Mail" >
												<span class="help-block"><?php echo $email_err;?></span>
										   </div>
                                        </div>
                                        <div class="btn-part text-right">                                            
                                            <div class="form-group mb-0 btn-part mt-0">
                                         
												<input type="hidden" name="action" value="sendEmail"/>
												<button  name="submit" type="submit" value="Submit" class="btn btn-warning"><b>Submit Now</b><a href="#wearethere"></a></button>
											</div>
                                        </div> 
                                    </fieldset>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div><br>
            </div>
            <!-- Contact Section Start -->
			</div> 
        <!-- Main content End -->
        <!-- Footer Start -->
       <?php include"footer.php"?>
        <!-- Footer End -->

        <!-- modernizr js -->
        <script src="assets/js/modernizr-2.8.3.min.js"></script>
        <!-- jquery latest version -->
        <script src="assets/js/jquery.min.js"></script>
        <!-- Bootstrap v4.4.1 js -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- Menu js -->
        <script src="assets/js/rsmenu-main.js"></script> 
        <!-- op nav js -->
        <script src="assets/js/jquery.nav.js"></script>
        <!-- owl.carousel js -->
        <script src="assets/js/owl.carousel.min.js"></script>
        <!-- wow js -->
        <script src="assets/js/wow.min.js"></script>
        <!-- Skill bar js -->
        <script src="assets/js/skill.bars.jquery.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script> 
         <!-- counter top js -->
        <script src="assets/js/waypoints.min.js"></script>
        <!-- swiper js -->
        <script src="assets/js/swiper.min.js"></script>   
        <!-- particles js -->
        <script src="assets/js/particles.min.js"></script>  
        <!-- magnific popup js -->
        <script src="assets/js/jquery.magnific-popup.min.js"></script>      
        <!-- plugins js -->
        <script src="assets/js/plugins.js"></script>
        <!-- pointer js -->
        <script src="assets/js/pointer.js"></script>
        <!-- contact form js -->
        <script src="assets/js/contact.form.js"></script>
        <!-- main js -->
        <script src="assets/js/main.js"></script>
    </body>
</html>