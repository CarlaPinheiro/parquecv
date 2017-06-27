<?php

?>

<?php get_header(); ?>

			<div id="content">
				<div id="inner-content" class="wrap cf">
					
					<div id="main" role="main">
						
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<div class="main-content-area">
								<?php 
									$thumb_id = get_post_thumbnail_id();
									$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
									$thumb_url = $thumb_url_array[0]; 
								?>
								<div class="class-featured-img">
									<span style="background-image:url( <?php echo $thumb_url; ?> );"></span>
								</div>
								<div class="class-info">
									<header class="article-header">
											<h2 class="entry-title single-title post-title" itemprop="headline"><?php the_title(); ?></h2>
									</header> <?php // end article header ?>
									<section class="entry-content cf" itemprop="articleBody">
										<?php the_content(); 

										wp_link_pages( array(
									      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'parquecv' ) . '</span>',
									      'after'       => '</div>',
									      'link_before' => '<span>',
									      'link_after'  => '</span>',
									    ) );

										?>
									</section>
								</div>
								<span class="clearfix"></span>
							</div>

							</article> <?php // end article ?>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php esc_html_e( 'Oops, Post Not Found!', 'parquecv' ); ?></h1>
										<p><?php esc_html_e( 'Uh Oh. Something is missing. Try double checking things.', 'parquecv' ); ?></p>
									</header>
							</article>

						<?php endif; ?>

					</div>

				</div>

			</div>

<?php get_footer(); ?>