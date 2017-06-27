<?php

function parquecv_ahoy() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'parquecv', get_template_directory() . '/library/translation' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'parquecv_scripts_and_styles', 999 );

  
  // ie conditional wrapper

  // launching this stuff after theme setup
  parquecv_theme_support();
 

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'parquecv_register_sidebars' );

  // cleaning up excerpt
  add_filter( 'excerpt_more', 'parquecv_excerpt_more' );

} /* end parquecv ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'parquecv_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
  $content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes

add_image_size( '300x300', 300, 300, true );
add_image_size( '600x600', 600, 600, true );


add_filter( 'image_size_names_choose', 'parquecv_custom_image_sizes' );
function parquecv_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        '300x300' => '300px by 300px'
    ) );
}

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function parquecv_register_sidebars() {
  register_sidebar(array(
    'id' => 'sidebar1',
    'name' => __( 'Posts Sidebar', 'parquecv' ),
    'description' => __( 'The Posts sidebar.', 'parquecv' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'sidebar2',
    'name' => __( 'Page Sidebar', 'parquecv' ),
    'description' => __( 'The Page sidebar.', 'parquecv' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'sidebar-home',
    'name' => __( 'Homepage Sidebar', 'parquecv' ),
    'description' => __( 'The Homepage sidebar.', 'parquecv' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));


} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function parquecv_comments( $comment, $args, $depth ) { ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
          echo get_avatar($comment, 60);
        ?>
    
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php esc_html_e( 'Your comment is awaiting moderation.', 'parquecv' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'parquecv' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'parquecv' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><?php comment_time(__( 'F jS, Y', 'parquecv' )); ?></time>
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

add_filter( 'comment_form_defaults', 'parquecv_remove_comment_form_allowed_tags' );
function parquecv_remove_comment_form_allowed_tags( $defaults ) {

  $defaults['comment_notes_after'] = '';
  return $defaults;

}