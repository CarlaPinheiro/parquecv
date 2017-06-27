			<footer class="footer" role="contentinfo">
				<?php if ( shortcode_exists( 'instagram-feed' ) ) { echo do_shortcode('[instagram-feed num=12 cols=6 imagepadding=0 showheader=false  showfollow=false showbutton=false]'); } ?>
				<div id="inner-footer" class="wrap cf">
					<div class="source-org copyright">
						&#169; <?php echo date_i18n(__('Y','parquecv')) . ' '; bloginfo( 'name' ); ?>
						<span><?php if(is_home()): ?>
							- <a href="<?php echo esc_url( __( 'http://localhost:8888/wordpress/', 'parquecv' ) ); ?>"><?php printf( __( '', '' ), '' ); ?></a> <span><?php _e('',''); ?></span> <a href="<?php echo esc_url( __( 'http://localhost:8888/wordpress/', 'parquecv' ) ); ?>"><?php printf( esc_html( '%s', 'parquecv' ), 'Parque Centro Veterinário' ); ?></a>
						<?php endif; ?>
						</span>
					</div>

					<div class="social-icons footer-social">
		           		<?php echo parquecv_social_icons(); ?>
                	</div> <!-- social-icons-->

				</div>

			</footer>
			<a href="#" class="scrollToTop"><span class="fa fa-chevron-circle-up"></span></a>
		</div>

		<?php wp_footer(); ?>
	</body>

</html> 