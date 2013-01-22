
<?php
/*
Template Name: Contactus main form
*/
?>
<?php 
$your_email ='techtic.mukesh@gmail.com';// <<=== update to your email address

session_start();
$errors = '';
$name = '';
$visitor_email = '';
$user_message = '';

	
if(isset($_POST['submit']))
{
	
	  $name = $_POST['name']; echo "<br/>";
	  $visitor_email = $_POST['email']; echo "<br/>";
	  $industry== $_POST['industry'];
	  $user_message = $_POST['message']; echo "<br/>"; 
	///------------Do Validations-------------
	if(empty($name)||empty($visitor_email))
	{
		$errors .= "\n Name and Email are required fields. ";	
	}
	if(IsInjected($visitor_email))
	{
		$errors .= "\n Bad email value!";
	}
	if(empty($_SESSION['6_letters_code'] ) ||
	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		$errors .= "<div style='border:1px solid #CCC; color:#FF0000; padding:5px; margin-left:20px;'> The captcha code does not match!</div>";
	}
	
			if(empty($errors))
			{
					
					
			$to= "warren@demographica.co.za";
			$from  = $visitor_email;
	
	
	 		 
			if($_POST['industry']=='Retail')
					{
						$subject = "Contact Page on the Demographica Website";
					}
					elseif($_POST['industry']=='FMCG')
					{
						$subject = "Contact Page on the Demographica Website";
					}
					elseif($_POST['industry']=='Franchise')
					{
						$subject = "Contact Page on the Demographica Website";
					}
					elseif($_POST['industry']=='Motor')
					{
						$subject = "Contact Page on the Demographica Website";
					}
					elseif($_POST['industry']=='Financial')
					{
						$subject = "Contact Page on the Demographica Website";
					}
					elseif($_POST['industry']=='Government')
					{
						$subject = "Contact Page on the Demographica Website";
					}
					elseif($_POST['industry']=='Telecoms')
					{
						$subject = "Contact Page on the Demographica Website";
					}
					elseif($_POST['industry']=='Agencies')
					{
						$subject = "Contact Page on the Demographica Website";
					}
					else{
						$subject = "Contact Page on the Demographica Website";
					}
			
			
			
			
			//$message="hi";
		    $message = "<html>
						<body>
							<table width='73%' border='0' cellspacing='2' cellpadding='2'>
								  <tr>
									<td colspan='2'><strong>Hi,</strong></td>
								  </tr>
								  <tr>
									<td colspan='2'>-----------------------------------------------------------------</td>
								  </tr>
								   <tr>
									<td><strong>Name</strong></td>
									<td align='left'>$name</td>
								  </tr>
								   <tr>
									<td><strong>Email</strong></td>
									<td align='left'>$visitor_email</td>
								  </tr>
								  <tr>
									<td><strong>Industry</strong></td>
									<td align='left'>$industry</td>
								  </tr>
								  <tr>
									<td><strong>Message</strong></td>
									<td align='left'>$user_message</td>
								  </tr>
											 
								  <tr>
									<td colspan='2' >-----------------------------------------------------------------</td>
								  </tr>
								</table>
						</body>
					</html>"; 
				$headers = "From: $from";
				
				  // Generate a boundary string
				   $semi_rand = md5(time());
						  $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
						  
						  // Add the headers for a file attachment
						  $headers .= "\nMIME-Version: 1.0\n" .
									  "Content-Type: multipart/mixed;\n" .			  
									  " boundary=\"{$mime_boundary}\"";
								
						
						  // Add a multipart boundary above the plain message
						  $message = "This is a multi-part message in MIME format.\n\n" .
									 "--{$mime_boundary}\n" .      
									 "Content-Type: text/html; charset=\"iso-8859-1\"\n" .      
									 "Content-Transfer-Encoding: 7bit\n\n" .
									 $message . "\n\n";
									 // Add a multipart boundary above the plain message
						
				
				
				// Send the message
				$ok = mail($to, $subject, $message, $headers);
				
				if ($ok)
				{	
					if($_POST['industry']=='Retail')
					{
						echo "<script>window.location='http://www.demographica.co.za/thank-you-retail/'</script>";
					}
					elseif($_POST['industry']=='FMCG')
					{
						echo "<script>window.location='http://www.demographica.co.za/thank-you-fmcg/'</script>";
					}
					elseif($_POST['industry']=='Franchise')
					{
						echo "<script>window.location='http://www.demographica.co.za/thank-you-franchise/'</script>";
					}
					elseif($_POST['industry']=='Motor')
					{
						echo "<script>window.location='http://www.demographica.co.za/thank-you-motor/'</script>";
					}
					elseif($_POST['industry']=='Financial')
					{
						echo "<script>window.location='http://www.demographica.co.za/thank-you-financial/'</script>";
					}
					elseif($_POST['industry']=='Government')
					{
						echo "<script>window.location='http://www.demographica.co.za/thank-you-government/'</script>";
					}
					elseif($_POST['industry']=='Telecoms')
					{
						echo "<script>window.location='http://www.demographica.co.za/thank-you-telecoms/'</script>";
					}
					elseif($_POST['industry']=='Agencies')
					{
						echo "<script>window.location='http://www.demographica.co.za/thank-you-telecoms/'</script>";
					}
					else{
						echo "<script>window.location='http://www.demographica.co.za/thank-you-contact-us/'</script>";
					}
				}
				else
				{
					echo "<script>window.location='http://www.demographica.co.za/thank-you-contact-us/'</script>";
				}
				
				
					
				
	
			}
}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>
<?php

//get_header(); ?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> 
<style media="screen" type="text/css">
	#container {
		height:100%;
	}
</style> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" /> 
<title>
Want to get in touch? | Demographica</title>
	
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="http://www.demographica.co.za/wp-content/themes/demographica/style.css" />
<link rel="pingback" href="http://www.demographica.co.za/xmlrpc.php" />
<script src="http://www.demographica.co.za/wp-content/themes/demographica/js/libs/modernizr-2.0.6.min.js"></script>
<!--------------------------------------contact-form--js------and -- css --------------------------------------------------------------->

<!-- define some style elements-->
<style>
label,a, body 
{
	font-family : Arial, Helvetica, sans-serif;
	font-size : 12px; 
}
.err
{
	font-family : Verdana, Helvetica, sans-serif;
	font-size : 12px;
	color: red;
}
</style>	
<!-- a helper script for vaidating the form-->
<script language="JavaScript" src="http://www.demographica.co.za/wp-content/themes/demographica/scripts/gen_validatorv31.js" type="text/javascript"></script>

<!------------------------------------------------------------------------------------------------------------->
<link rel="alternate" type="application/rss+xml" title="Demographica &raquo; Feed" href="http://www.demographica.co.za/feed/" />
<link rel="alternate" type="application/rss+xml" title="Demographica &raquo; Comments Feed" href="http://www.demographica.co.za/comments/feed/" />
<link rel="alternate" type="application/rss+xml" title="Demographica &raquo; About us Comments Feed" href="http://www.demographica.co.za/about-us/feed/" />
<link rel='stylesheet' id='admin-bar-css'  href='http://www.demographica.co.za/wp-includes/css/admin-bar.css?ver=3.4.2' type='text/css' media='all' />
<link rel='stylesheet' id='contact-form-7-css'  href='http://www.demographica.co.za/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=3.3' type='text/css' media='all' />
<script type='text/javascript' src='http://www.demographica.co.za/wp-includes/js/jquery/jquery.js?ver=1.7.2'></script>
<script type='text/javascript' src='http://www.demographica.co.za/wp-content/plugins/mailchimp-widget/js/mailchimp-widget-min.js?ver=3.4.2'></script>
<script type='text/javascript' src='http://www.demographica.co.za/wp-includes/js/comment-reply.js?ver=3.4.2'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://www.demographica.co.za/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://www.demographica.co.za/wp-includes/wlwmanifest.xml" /> 
<link rel='prev' title='Previous Post' href='http://www.demographica.co.za/' />
<link rel='next' title='Want to get in touch?' href='http://www.demographica.co.za/contact-us/' />
<meta name="generator" content="WordPress 3.4.2" />
<link rel='canonical' href='http://www.demographica.co.za/about-us/' />
<style type="text/css" media="print">#wpadminbar { display:none; }</style>
<style type="text/css" media="screen">
	html { margin-top: 28px !important; }
	* html body { margin-top: 28px !important; }
</style>
</head>

<body class="page page-id-73 page-parent page-template page-template-page-about-php logged-in admin-bar">
		<div id="wrapper">
		<header>
			<div id="header">
				<div id="social">
                	<a class="facebook" href="http://www.facebook.com/Demographica" target="_blank"></a>
                    <a class="twitter" href="http://twitter.com/#!/Demographica" target="_blank"></a>
                    <a class="dollop" href="#newsletterdropdown">sign up to<br>our newsletter</a>
                    <a class="call">Call Us<br>+27 11 447 7373</a>
                </div>
	    		<div id="logo"><a class="logo" href="http://www.demographica.co.za/"></a></div>
	    	</div>
    		<div id="main-menu">
    			<div class="menu-mainmenu-container"><ul id="menu-mainmenu" class="menu"><li id="menu-item-108" class="first parent menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-73 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-108"><a href="http://www.demographica.co.za/about-us/">about us</a>
<ul class="sub-menu">
	<li id="menu-item-626" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-73 current_page_item menu-item-626"><a href="http://www.demographica.co.za/about-us/">About us</a></li>
	<li id="menu-item-577" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-577"><a href="http://www.demographica.co.za/work-here/">work here</a></li>
	<li id="menu-item-578" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-578"><a href="http://www.demographica.co.za/about-us/staff-profiles/">Staff</a></li>
	<li id="menu-item-657" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-657"><a href="http://www.demographica.co.za/coming-to-a-shelf-near-you/">Press</a></li>
</ul>
</li>
<li id="menu-item-1140" class="nolink parent menu-item menu-item-type-custom menu-item-object-custom menu-item-1140"><a href="#nolink">Our Solutions</a>
<ul class="sub-menu">
	<li id="menu-item-679" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-679"><a href="http://www.demographica.co.za/retail/">Retail</a></li>
	<li id="menu-item-691" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-691"><a href="http://www.demographica.co.za/fmcg/">FMCG</a></li>
	<li id="menu-item-748" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-748"><a href="http://www.demographica.co.za/franchise/">Franchise</a></li>
	<li id="menu-item-747" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-747"><a href="http://www.demographica.co.za/motor-solutions/">Motor</a></li>
	<li id="menu-item-749" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-749"><a href="http://www.demographica.co.za/financial-solutions/">Financial</a></li>
	<li id="menu-item-746" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-746"><a href="http://www.demographica.co.za/government-solutions/">Government</a></li>
	<li id="menu-item-745" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-745"><a href="http://www.demographica.co.za/telecoms/">Telecoms</a></li>
	<li id="menu-item-744" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-744"><a href="http://www.demographica.co.za/agencies-solutions/">Agencies</a></li>
</ul>
</li>
<li id="menu-item-112" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-112"><a href="http://www.demographica.co.za/category/pinkpaper/">Bible downloads</a></li>
<li id="menu-item-753" class="nolink parent menu-item menu-item-type-custom menu-item-object-custom menu-item-753"><a href="#">Media Planning Tools</a>
<ul class="sub-menu">
	<li id="menu-item-754" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-754"><a target="_blank" href="http://www.demographica.co.za/pdf/Demographica-RateCardAgency.pdf">Rate Card</a></li>
	<li id="menu-item-755" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-755"><a target="_blank" href="http://www.demographica.co.za/calculator/">Calculator</a></li>
	<li id="menu-item-756" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-756"><a target="_blank" href="http://www.demographica.co.za/pdf/DemographicaCondensed.pdf">Info Doc</a></li>
	<li id="menu-item-757" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-757"><a target="_blank" href="http://www.demographica.co.za/pdf/UserGroups.pdf">User Groups</a></li>
	<li id="menu-item-766" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-766"><a href="http://www.demographica.co.za/case-studies/">Case Studies</a></li>
</ul>
</li>
<li id="menu-item-834" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-834"><a href="http://www.demographica.co.za/shop/">Shop</a></li>
<li id="menu-item-119" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119"><a href="http://www.demographica.co.za/contact-us/">contact us</a></li>
</ul></div>    			<div class="header-newsletter">
    				<a href="#close" class="close-btn-blue"></a>
    				<ul class="ulnewsletter">
	<li id="text-3" class="widget-container widget_text">			<div class="textwidget"><div class="wpcf7" id="wpcf7-f1052-w1-o1"><form action="/about-us/#wpcf7-f1052-w1-o1" method="post" class="wpcf7-form">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="1052" />
<input type="hidden" name="_wpcf7_version" value="3.3" />
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f1052-w1-o1" />
<input type="hidden" name="_wpnonce" value="823a1d36d3" />
</div>
<p>Sign up to our newsletter and receive relevant content every month! Don't worry - we take privacy seriously and will never share your details</p>
<p><span class="wpcf7-form-control-wrap your-email"><input type="text" name="your-email" value="" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email wpcf7-use-title-as-watermark" size="40" title="your email" /></span> <input type="submit" value="Sign up!" class="wpcf7-form-control  wpcf7-submit" /></p>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div></div>
		</li></ul>

    			</div>
    		</div>
  		</header>
  		<div id="main" role="main">
		<div id="container">
			<div id="content" role="main">
			

<div class="single">
                <div style="width: 920px;">
					

				<div id="post-117" class="post-117 page type-page status-publish hentry">
											<h1 class="entry-title">Want to get in touch?</h1>
					
					<div class="entry-content">
						<table width="920" cellpadding="10px">
<tbody>
<tr>
<td>

<?php
if(!empty($errors)){
echo "<p class='err'>".nl2br($errors)."</p>";
}
?>
<div id='contact_form_errorloc' class='err'></div>
<form method="post"  name="contact_form" action="<?php echo get_bloginfo('template_directory'); ?>/html-contact-form.php"> 
<p>Complete the following form, and we will get in touch with you!<br/><br />
<span class="small">* All fields are required</span></p>
<p>
<label for='name'>Name: </label><br><br>
<input type="text" class="wpcf7-text" name="name" size="40" value='<?php echo htmlentities($name) ?>'>
</p>
<p>
<label for='email'>Email: </label><br><br>
<input type="text" class="wpcf7-text" name="email" size="40" value='<?php echo htmlentities($visitor_email) ?>'>
</p>
<p>Industry<br/><br />
			<span class="wpcf7-form-control-wrap industry"><select name="industry" class="wpcf7-form-control  wpcf7-select wpcf7-validates-as-required"><option value="Retail">Retail</option><option value="FMCG">FMCG</option><option value="Franchise">Franchise</option><option value="Motor">Motor</option><option value="Financial">Financial</option><option value="Government">Government</option><option value="Telecoms">Telecoms</option><option value="Agencies">Agencies</option><option value="Other">Other</option></select></span></p>
<p>
<label for='message'>Message:</label> <br><br>
<textarea name="message" cols="40" rows="10"><?php echo htmlentities($user_message) ?></textarea>
</p>
<p>
<img src="<?php echo get_bloginfo('template_directory'); ?>/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><a href='javascript: refreshCaptcha();'><img src="<?php echo get_bloginfo('template_directory'); ?>/images/refresh5.jpg" alt="refresh" /></a><br><br/>
<label for='message'>Are you Human?</label><br><br/>
<input id="6_letters_code" name="6_letters_code" class="wpcf7-text" type="text"><br>
</p>
<input type="submit"  name='submit' value="contact me" class="wpcf7-submit" >
</form>
	
</td>
<td><iframe width="480" height="560" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.za/maps?ie=UTF8&amp;cid=3418664597370659509&amp;q=Demographica&amp;gl=ZA&amp;hl=en&amp;ll=-26.145056,28.044117&amp;spn=0.006295,0.006295&amp;t=m&amp;iwloc=A&amp;output=embed"></iframe></td>
</tr>
</tbody>
</table>
<p>Email: <a href="mailto:info@demographica.co.za">info@demographica.co.za</a> Phone: <span class="light-blue">+27 11 447 7373</span></p>
<p>Physical: <span class="light-blue">Block 2, 257 Oxford Road, Illovo, Johannesburg, Gauteng, South Africa, 2196</span> Postal address: <span class="light-blue">Postnet Suite #83, Private Bag x11, Birnham Park, 2015</span></p>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<script language="JavaScript">
// Code for validating the form
// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
// for details
var frmvalidator  = new Validator("contact_form");
//remove the following two lines if you like error message box popups
frmvalidator.EnableOnPageErrorDisplaySingleBox();
frmvalidator.EnableMsgsTogether();

frmvalidator.addValidation("name","req","Please provide your name"); 
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
					 </div>
				</div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php //get_sidebar(); ?>
<?php //get_footer(); ?>

 </div>
  		  		
  		<div id="logos">
  			<div class="center">
            	<hr/>
  				<table width="100%" style="text-align: center;">
  					<tr>
  						<td style="vertical-align:middle;"><a href="http://www.thesaci.co.za/" target="_blank"><img src="http://www.demographica.co.za/wp-content/themes/demographica/images/saci-footer-logo.png" alt="The SACI" /></a></td>
                        <td style="vertical-align:middle;"><a href="http://www.bizcommunity.com/Article/196/14/67367.html" target="_blank"><img src="http://www.demographica.co.za/wp-content/themes/demographica/images/assegai-logo.png" alt="Demograpgica" /></a></td>
                    	<td style="vertical-align:middle;"><a href="http://www.nationalbusinessawards.co.za/2012-photos/" target="_blank"><img src="http://www.demographica.co.za/wp-content/themes/demographica/images/nba-logo.png" alt="Demograpgica" /></a></td>
  						<td style="vertical-align:middle;"><a href="http://www.dmasa.org/dmasa/dma_cofe.php" target="_blank"><img src="http://www.demographica.co.za/wp-content/themes/demographica/images/dlists-footer-logo.png" alt="Center of Excellence D-Lists" /></a></td>
  						<td style="vertical-align:middle;"><a href="http://www.dmasa.org/" target="_blank"><img src="http://www.demographica.co.za/wp-content/themes/demographica/images/dma-footer-logo.png" alt="Direct Marketinging Association of SA" /></a></td>
  						<td style="vertical-align:middle;"><a href="http://www.dmma.co.za/" target="_blank"><img src="http://www.demographica.co.za/wp-content/themes/demographica/images/dmma-footer-logo.png" alt="Digital Media and Marketing Association" /></a></td>
  					</tr>
  				</table>
  			</div>
  		</div>
  		
  		<footer>
			<div id="footer">
				<div id="footer-address">
					<p><strong>Phone:</strong> +27 11 447 7373 <strong>Physical:</strong> Block 2, 257 Oxford Road, Illovo, Johannesburg, Gauteng, South Africa, 2196</p>
				</div>
				<div id="footer-links">
					<div class="menu-footermenu-container"><ul id="menu-footermenu" class="menu"><li id="menu-item-245" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-245"><a href="http://www.demographica.co.za/">Home</a></li>
<li id="menu-item-248" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-73 current_page_item menu-item-248"><a href="http://www.demographica.co.za/about-us/">About us</a></li>
<li id="menu-item-250" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-250"><a href="http://www.demographica.co.za/coming-to-a-shelf-near-you/">Press</a></li>
<li id="menu-item-247" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-247"><a href="http://www.demographica.co.za/contact-us/">Contact us</a></li>
</ul></div>				</div>
				<div id="footer-newsletter">
					<ul class="ulnewsletter">
	<li id="text-4" class="widget-container widget_text">			<div class="textwidget"><div class="wpcf7" id="wpcf7-f1052-w2-o1"><form action="/about-us/#wpcf7-f1052-w2-o1" method="post" class="wpcf7-form">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="1052" />
<input type="hidden" name="_wpcf7_version" value="3.3" />
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f1052-w2-o1" />
<input type="hidden" name="_wpnonce" value="823a1d36d3" />
</div>
<p>Sign up to our newsletter and receive relevant content every month! Don't worry - we take privacy seriously and will never share your details</p>
<p><span class="wpcf7-form-control-wrap your-email"><input type="text" name="your-email" value="" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email wpcf7-use-title-as-watermark" size="40" title="your email" /></span> <input type="submit" value="Sign up!" class="wpcf7-form-control  wpcf7-submit" /></p>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div></div>
		</li></ul>

				</div>
				<div style="clear: both;"></div>
			</div>
  		</footer>
  	</div>
  	<script type='text/javascript' src='http://www.demographica.co.za/wp-includes/js/admin-bar.js?ver=3.4.2'></script>
<script type='text/javascript' src='http://www.demographica.co.za/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.15'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpcf7 = {"loaderUrl":"http:\/\/www.demographica.co.za\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","sending":"Sending ..."};
/* ]]> */
</script>
<script type='text/javascript' src='http://www.demographica.co.za/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=3.3'></script>
	<script type="text/javascript">
		(function() {
			var request, b = document.body, c = 'className', cs = 'customize-support', rcs = new RegExp('(^|\\s+)(no-)?'+cs+'(\\s+|$)');

			request = true;

			b[c] = b[c].replace( rcs, '' );
			b[c] += ( window.postMessage && request ? ' ' : ' no-' ) + cs;
		}());
	</script>
			<div id="wpadminbar" class="nojq nojs" role="navigation">
			<div class="quicklinks">
				<ul id="wp-admin-bar-root-default" class="ab-top-menu">
		<li id="wp-admin-bar-wp-logo" class="menupop"><a class="ab-item" tabindex="10" aria-haspopup="true" href="http://www.demographica.co.za/wp-admin/about.php" title="About WordPress"><span class="ab-icon"></span></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-wp-logo-default" class="ab-submenu">
		<li id="wp-admin-bar-about" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/about.php">About WordPress</a>		</li></ul><ul id="wp-admin-bar-wp-logo-external" class="ab-sub-secondary ab-submenu">
		<li id="wp-admin-bar-wporg" class=""><a class="ab-item" tabindex="10" href="http://wordpress.org/">WordPress.org</a>		</li>
		<li id="wp-admin-bar-documentation" class=""><a class="ab-item" tabindex="10" href="http://codex.wordpress.org/">Documentation</a>		</li>
		<li id="wp-admin-bar-support-forums" class=""><a class="ab-item" tabindex="10" href="http://wordpress.org/support/">Support Forums</a>		</li>
		<li id="wp-admin-bar-feedback" class=""><a class="ab-item" tabindex="10" href="http://wordpress.org/support/forum/requests-and-feedback">Feedback</a>		</li></ul></div>		</li>
		<li id="wp-admin-bar-site-name" class="menupop"><a class="ab-item" tabindex="10" aria-haspopup="true" href="http://www.demographica.co.za/wp-admin/">Demographica</a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-site-name-default" class="ab-submenu">
		<li id="wp-admin-bar-dashboard" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/">Dashboard</a>		</li></ul><ul id="wp-admin-bar-appearance" class=" ab-submenu">
		<li id="wp-admin-bar-themes" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/themes.php">Themes</a>		</li>
		<li id="wp-admin-bar-customize" class=" hide-if-no-customize"><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/customize.php?url=http%3A%2F%2Fwww.demographica.co.za%2Fabout-us%2F">Customize</a>		</li>
		<li id="wp-admin-bar-widgets" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/widgets.php">Widgets</a>		</li>
		<li id="wp-admin-bar-menus" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/nav-menus.php">Menus</a>		</li>
		<li id="wp-admin-bar-background" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/themes.php?page=custom-background">Background</a>		</li>
		<li id="wp-admin-bar-header" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/themes.php?page=custom-header">Header</a>		</li></ul></div>		</li>
		<li id="wp-admin-bar-updates" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/update-core.php" title="4 Plugin Updates, 2 Theme Updates"><span class="ab-icon"></span><span class="ab-label">6</span></a>		</li>
		<li id="wp-admin-bar-comments" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/edit-comments.php" title="0 comments awaiting moderation"><span class="ab-icon"></span><span id="ab-awaiting-mod" class="ab-label awaiting-mod pending-count count-0">0</span></a>		</li>
		<li id="wp-admin-bar-new-content" class="menupop"><a class="ab-item" tabindex="10" aria-haspopup="true" href="http://www.demographica.co.za/wp-admin/post-new.php" title="Add New"><span class="ab-icon"></span><span class="ab-label">New</span></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-new-content-default" class="ab-submenu">
		<li id="wp-admin-bar-new-post" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/post-new.php">Post</a>		</li>
		<li id="wp-admin-bar-new-media" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/media-new.php">Media</a>		</li>
		<li id="wp-admin-bar-new-link" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/link-add.php">Link</a>		</li>
		<li id="wp-admin-bar-new-page" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/post-new.php?post_type=page">Page</a>		</li>
		<li id="wp-admin-bar-new-user" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/user-new.php">User</a>		</li></ul></div>		</li>
		<li id="wp-admin-bar-edit" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/post.php?post=73&#038;action=edit">Edit Page</a>		</li></ul><ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
		<li id="wp-admin-bar-search" class=" admin-bar-search"><div class="ab-item ab-empty-item" tabindex="-1"><form action="http://www.demographica.co.za/" method="get" id="adminbarsearch"><input class="adminbar-input" name="s" id="adminbar-search" tabindex="10" type="text" value="" maxlength="150" /><input type="submit" class="adminbar-button" value="Search"/></form></div>		</li>
		<li id="wp-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item" tabindex="10" aria-haspopup="true" href="http://www.demographica.co.za/wp-admin/profile.php" title="My Account">Howdy, Simone<img alt='' src='http://1.gravatar.com/avatar/fcb772148d9ebf4a11350db78c81f3f3?s=16&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D16&amp;r=G' class='avatar avatar-16 photo' height='16' width='16' /></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-user-actions" class=" ab-submenu">
		<li id="wp-admin-bar-user-info" class=""><a class="ab-item" tabindex="-1" href="http://www.demographica.co.za/wp-admin/profile.php"><img alt='' src='http://1.gravatar.com/avatar/fcb772148d9ebf4a11350db78c81f3f3?s=64&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D64&amp;r=G' class='avatar avatar-64 photo' height='64' width='64' /><span class='display-name'>Simone</span><span class='username'>simone</span></a>		</li>
		<li id="wp-admin-bar-edit-profile" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-admin/profile.php">Edit My Profile</a>		</li>
		<li id="wp-admin-bar-logout" class=""><a class="ab-item" tabindex="10" href="http://www.demographica.co.za/wp-login.php?action=logout&#038;_wpnonce=89014fe70c">Log Out</a>		</li></ul></div>		</li></ul>			</div>
		</div>

		
  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
  


  <!-- scripts concatenated and minified via build script -->
  <script defer src="http://www.demographica.co.za/wp-content/themes/demographica/js/plugins.js"></script>
  <script defer src="http://www.demographica.co.za/wp-content/themes/demographica/js/script.js"></script>
  <!-- end scripts -->


  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
       mathiasbynens.be/notes/async-analytics-snippet -->
  <script>
    var _gaq=[['_setAccount','UA-18383518-1'],['_trackPageview'],['_trackPageLoadTime']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
 <div id="case-study-container">
 	<div class="main-hover">
 		
 	</div>
 </div>