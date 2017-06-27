<?php get_header(); ?>
		<div class="front-wrapper">
			<div id="content">
				<?php if ( get_theme_mod('parquecv_slider_area') ):
		                    $slider_class = 'slider-hide';
		                    else:
		                    $slider_class = '';
		                    endif;
            	?>
				<div id="slide-wrap" class="<?php echo esc_attr( $slider_class ); ?>">

		<div id="load-cycle"></div>
		
		<?php 	
			if ( get_theme_mod('parquecv_slider_cat') ){
				$args = array('posts_per_page' => -1,'post_status' => 'publish', 'category_name' => get_theme_mod('parquecv_slider_cat') );
			} else {
				$args = array('posts_per_page' => 10,'post_status' => 'publish','post__in' => get_option("sticky_posts"));
			}
			$fPosts = new WP_Query( $args );
		?>

		<?php if ( $fPosts->have_posts() ) : ?>

			<div class="cycle-slideshow" 
			<?php if ( get_theme_mod('parquecv_slider_effect') ) :
			echo 'data-cycle-fx="' . wp_kses_post( get_theme_mod('parquecv_slider_effect') ) . '" data-cycle-tile-count="10"';
			else:
			echo 'data-cycle-fx="scrollHorz"';
			endif;?> 
			data-cycle-slides="> div.slides" 
			<?php if ( get_theme_mod('parquecv_slider_timeout') ): 
			$slider_timeout = wp_kses_post( get_theme_mod('parquecv_slider_timeout') );
			echo 'data-cycle-timeout="' . $slider_timeout . '000"';
			else:
			echo 'data-cycle-timeout="5000"';
			endif; ?> 
			data-cycle-pager="#custom-pager" data-cycle-pager-template="">


				<?php while ( $fPosts->have_posts() ) : $fPosts->the_post();  ?>

					<div class="slides">

						<div id="post-<?php the_ID(); ?>" <?php post_class('post-theme'); ?>>

							<?php 
								$image_full = parquecv_catch_that_image(); 
								$gallery_full = parquecv_catch_gallery_image_full(); 
							?>

							<?php if ( has_post_thumbnail()) : ?>

								<div class="slide-thumb">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail( "full" ); ?>
									</a>
									<div class="bg-overlay"></div>
								</div>

								<?php elseif(has_post_format('image') && !empty($image_full)) : ?>
									<div class="slide-thumb">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<img class="attachment-full" src="<?php echo esc_url($image_full); ?>">
										</a><div class="bg-overlay"></div>
									</div>

								<?php elseif(has_post_format('gallery') && !empty($gallery_full)) : ?>  
									<div class="slide-thumb">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<img class="attachment-full" src="<?php echo esc_url($gallery_full); ?>">
										</a>
										<div class="bg-overlay"></div>
									</div>
									
								<?php else: ?>
									<div class="slide-noimg"></div>

							<?php endif; ?>

						</div>


						<div class="slide-copy-wrap">
							<div class="table">
								<div class="table-cell"> 
									<div class="slide-copy">
										<h2 class="slide-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Read %s', 'parquecv' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
										<?php the_excerpt(); ?> 
										<a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Ver mais','parquecv' ); ?></a>
									</div>
								</div>
							</div>
						</div>

					</div>
					

				<?php endwhile; wp_reset_postdata(); ?>
			

				<div id="custom-pager" class="center external">
					<?php while ( $fPosts->have_posts() ) : $fPosts->the_post();  ?>
						<?php 
							$image_thumb = parquecv_catch_that_image_thumb(); 
							$gallery_thumb = parquecv_catch_gallery_image_thumb(); 
						
						if ( has_post_thumbnail()) :

							the_post_thumbnail( "thumbnail" ); 
						
						elseif(has_post_format('image') && !empty($image_thumb)) : 
									
							echo wp_kses_post( $image_thumb ); 
										
						elseif(has_post_format('gallery') && !empty($gallery_thumb)) : 
								
							echo wp_kses_post( $gallery_thumb ); 
									
						else: ?>
							
							<div class="slide-noimg"></div>

						<?php endif; ?>
					<?php endwhile; ?>
				</div>

				

			</div>

		<?php endif; ?>

		<?php wp_reset_postdata(); ?>

		</div> <!-- slider-wrap -->
				<div id="blog" class="wrap cf">
					<div id="main" role="main">
						<div id='masonry' class="blog-list container">
						<?php $args2= array('post__not_in' => get_option( 'sticky_posts' ) ,'paged' => $paged);
						$blogPosts = new WP_Query( $args2 ); ?>
						<?php while ( $blogPosts -> have_posts() ) : $blogPosts -> the_post(); ?>
				  						<?php get_template_part( 'home-content/home', get_post_format() ); ?>
				  				<?php endwhile;  ?>
								<div class="clear"></div>
			     				<div class="gutter-sizer"></div>
						</div>
						<div class="pagination">
							<?php $older_text = __('Older Entries','parquecv'); next_posts_link($older_text);?>
						</div>
						<?php wp_reset_postdata(); ?>
					</div>
				</div> <!-- inner-content -->
			</div> <!-- content -->
		</div><!-- front-wrapper -->

<?php get_footer(); ?>