<div id="sidebar-home" class="sidebar m-all t-1of3 d-2of7 last-col cf" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-home' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar-home' ); ?>

	<?php else : ?>

		<?php
			
		?>

		<div class="no-widgets">
			<p><?php esc_html_e( );  ?></p>
		</div>
		
		

	<?php endif; ?>

</div>