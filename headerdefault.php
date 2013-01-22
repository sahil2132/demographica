<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!doctype html>
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
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" /> 
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

?>
</title>
	
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="<?php echo get_bloginfo('template_directory'); ?>/js/libs/modernizr-2.0.6.min.js"></script>
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
<script language="JavaScript" src="<?php echo get_bloginfo('template_directory'); ?>/scripts/gen_validatorv31.js" type="text/javascript"></script>

<!------------------------------------------------------------------------------------------------------------->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
	<?php
    	global $sa_options;
		$sa_settings = get_option( 'sa_options', $sa_options );
	?>
	<div id="wrapper">
		<header>
			<div id="header">
				<div id="social">
                	<a class="facebook" href="http://www.facebook.com/Demographica" target="_blank"></a>
                    <a class="twitter" href="http://twitter.com/#!/Demographica" target="_blank"></a>
                    <a class="dollop" href="#newsletterdropdown">sign up to<br>our newsletter</a>
                    <a class="call">Call Us<br>+27 11 447 7373</a>
                </div>
	    		<div id="logo"><a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"></a></div>
	    	</div>
    		<div id="main-menu">
    			<?php wp_nav_menu( array('menu' => 'mainmenu' )); ?>
    			<div class="header-newsletter">
    				<a href="#close" class="close-btn-blue"></a>
    				<?php get_sidebar( 'newsletter-top' ); ?>
    			</div>
    		</div>
  		</header>
  		<div id="main" role="main">
