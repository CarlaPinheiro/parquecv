<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

	</head>

	<body <?php body_class(); ?>>

		<div id="container">
			<?php 	if ( get_theme_mod('parquecv_slider_area') ):
                    $relative_header = 'relative-header';
                    else:
                    $relative_header = '';
                    endif;
        	?>
			<header class="header<?php if( is_home() ): echo " " . esc_attr( $relative_header ); endif; ?>" role="banner">
				<div id="top-area">
					<div class="wrap">
						<div class="site-desc left-area">
							<h1><?php bloginfo('description'); ?></h1>
						</div>
						<div class="right-area">
							<?php 
					           	if(function_exists('parquecv_social_icons')) :
					           		echo parquecv_social_icons(); 
					           	endif;
					        ?>
						</div>
						<span class="clear"></span>
					</div>
					<span class="opacity-overlay"></span>
				</div>

				<div id="inner-header" class="wrap cf">
					<div class="nav-wrapper">
					<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ): ?>
					<p id="logo" class="h1"><?php the_custom_logo(); ?></p>
					<?php else : ?>
					<p id="logo" class="h1"><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a></p>
					<?php endif; ?>
					
					<div id="responsive-nav"><span class="fa fa-bars nav-icon"></span></div>
       					 <div class="clear no-display"></div>
       					 <nav role="navigation" id="main-navigation">
       					 	<?php if ( has_nav_menu('main-nav') ) { ?>
								<?php wp_nav_menu(array(
		    					'container' => false,                           
		    					'container_class' => 'menu cf',                 
		    					'menu_class' => 'nav top-nav cf',               
		    					'theme_location' => 'main-nav',                 
		    					'before' => '',                                 
			        			'after' => '',                                  
			        			'link_before' => '',                            
			        			'link_after' => '',                             
			        			'depth' => 0,                                   
		    					'fallback_cb' => ''                             
								)); ?>
							<?php } else { ?>
								<ul class="nav top-nav cf">
  								<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
								</ul>
							<?php } ?>
						</nav>
					</div>
						<span class="clear"></span>

				</div>

				<span class="opacity-overlay"></span>

			</header>
