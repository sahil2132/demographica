<!DOCTYPE html>
<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php wp_title(''); ?></title>

<link rel="stylesheet" media="screen" type="text/css" href="<? bloginfo('template_directory'); ?>/css/bootstrap.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<? bloginfo('template_directory'); ?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<? bloginfo('template_directory'); ?>/style.css" />
<link rel="shortcut icon" href="<? bloginfo('template_directory'); ?>/images/favicon.png" />

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php wp_enqueue_script('bootstrap', get_bloginfo('template_directory').'/js/bootstrap.js', array('jquery'), '1.0', true ); ?>
<?php wp_enqueue_script('tab', get_bloginfo('template_directory').'/js/bootstrap-tab.js', array('jquery'), '1.0', true ); ?>
<?php wp_enqueue_script('theme', get_bloginfo('template_directory').'/js/theme.js', array('jquery'), '1.0', true ); ?>

<?php wp_head(); ?>

</head>

<body <?php echo body_class(); ?>>

<div id="wrap">


	<?php tylUser(); ?>


</div>

<?php wp_footer(); ?>

</body>
</html>