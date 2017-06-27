<?php

/*-----------------------------------------------------------------------------------*/
/* custom functions below */
/*-----------------------------------------------------------------------------------*/
define('parquecv_THEMEURL', get_template_directory_uri());
define('parquecv_IMAGES', parquecv_THEMEURL.'/images'); 
define('parquecv_JS', parquecv_THEMEURL.'/js');
define('parquecv_CSS', parquecv_THEMEURL.'/css');
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

add_filter( 'post_thumbnail_html', 'parquecv_remove_thumbnail_dimensions', 10, 3 );

function parquecv_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

function parquecv_oembed() {

    global $post;

    if ( $post && $post->post_content ) {

        // Get the absurd shortcode regexp.
        $video_regex = '#' . get_shortcode_regex() . '#i';
        
        $pattern_array = array( $video_regex );

        // Get the patterns from the embed object.
        if ( ! function_exists( '_wp_oembed_get_object' ) ) {
            include ABSPATH . WPINC . '/class-oembed.php';
        }
        $oembed = _wp_oembed_get_object();
        $pattern_array = array_merge( $pattern_array, array_keys( $oembed->providers ) );

        // Or all the patterns together.
        $pattern = '#(' . array_reduce( $pattern_array, function ( $carry, $item ) {
            if ( strpos( $item, '#' ) === 0 ) {
                // Assuming '#...#i' regexps.
                $item = substr( $item, 1, -2 );
            } else {
                // Assuming glob patterns.
                $item = str_replace( '*', '(.+)', $item );
            }
            return $carry ? $carry . ')|('  . $item : $item;
        } ) . ')#is';

        // Simplistic parse of content line by line.
        $lines = explode( "\n", $post->post_content );

        foreach ( $lines as $line ) {
            $line = trim( $line );

            if ( preg_match( $pattern, $line, $matches ) ) {
                if ( strpos( $matches[0], '[' ) === 0 ) {
                    $ret = do_shortcode( $matches[0] );
                    $audio = explode('"', $matches[0]);
                    if( array_key_exists(1, $audio)){
                      return $audio[1];
                    }
                } else {
                    $ret = wp_oembed_get( $matches[0] );
                }
                return $ret;
            }
        }
    }
}

function parquecv_author_excerpt() {
      $text_limit = '50'; //Words to show in author bio excerpt
      $read_more  = "Read more"; //Read more text
      $end_of_txt = "...";
      $name_of_author = get_the_author();
      $url_of_author  = get_author_posts_url(get_the_author_meta('ID'));
      $short_desc_author = wp_trim_words(strip_tags(
                          get_the_author_meta('description')), $text_limit, 
                          $end_of_txt.'<br/>
                        <a href="'.$url_of_author.'" style="font-weight:bold;">'.$read_more .'</a>');

      return $short_desc_author;
}

 function parquecv_catch_that_image() {
  global $post;
  $pattern = '|<img.*?class="([^"]+)".*?/>|';
  $transformed_content = apply_filters('the_content',$post->post_content);
  preg_match($pattern,$transformed_content,$matches);
  if (!empty($matches[1])) {
    $classes = explode(' ',$matches[1]);
    $id = preg_grep('|^wp-image-.*|',$classes);
    if (!empty($id)) {
      $id = str_replace('wp-image-','',$id);
      if (!empty($id)) {
        $id = reset($id);
        $transformed_content = wp_get_attachment_image($id,'full');  
        return $transformed_content;
      }
    }
  }
  
}

function parquecv_catch_that_image_thumb() {
  global $post;
  $pattern = '|<img.*?class="([^"]+)".*?/>|';
  $transformed_content = apply_filters('the_content',$post->post_content);
  preg_match($pattern,$transformed_content,$matches);
  if (!empty($matches[1])) {
    $classes = explode(' ',$matches[1]);
    $id = preg_grep('|^wp-image-.*|',$classes);
    if (!empty($id)) {
      $id = str_replace('wp-image-','',$id);
      if (!empty($id)) {
        $id = reset($id);
        $transformed_content = wp_get_attachment_image($id,'thumbnail');  
         return $transformed_content;
      }
    }
  }
 
}

function parquecv_catch_gallery_image_full()  { 
    global $post;
    $gallery = get_post_gallery( $post, false );
    if ( !empty($gallery['ids']) ) {
      $ids = explode( ",", $gallery['ids'] );
      $total_images = 0;
      foreach( $ids as $id ) {
        
        $title = get_post_field('post_title', $id);
        $meta = get_post_field('post_excerpt', $id);
        $link = wp_get_attachment_url( $id );
        $image  = wp_get_attachment_image( $id, 'full');
        $total_images++;
        
        if ($total_images == 1) {
          $first_img = $image;
          return $first_img;
        }
      }
    } 
}

function parquecv_catch_gallery_image_thumb()  { 
    global $post;
    $gallery = get_post_gallery( $post, false );
    if ( !empty($gallery['ids']) ) {
      $ids = explode( ",", $gallery['ids'] );
      $total_images = 0;
      foreach( $ids as $id ) {
        
        $title = get_post_field('post_title', $id);
        $meta = get_post_field('post_excerpt', $id);
        $link = wp_get_attachment_url( $id );
        $image  = wp_get_attachment_image( $id, 'thumbnail');
        $total_images++;
        
        if ($total_images == 1) {
          $first_img = $image;
          return $first_img;
        }
      }
    } 
}

/* social icons*/
function parquecv_social_icons()  { 

  $social_networks = array( array( 'name' => __('Facebook','parquecv'), 'theme_mode' => 'parquecv_facebook','icon' => 'fa-facebook' ),
                            array( 'name' => __('Twitter','parquecv'), 'theme_mode' => 'parquecv_twitter','icon' => 'fa-twitter' ),
                            array( 'name' => __('Google+','parquecv'), 'theme_mode' => 'parquecv_google','icon' => 'fa-google-plus' ),
                            array( 'name' => __('Pinterest','parquecv'), 'theme_mode' => 'parquecv_pinterest','icon' => 'fa-pinterest' ),
                            array( 'name' => __('Linkedin','parquecv'), 'theme_mode' => 'parquecv_linkedin','icon' => 'fa-linkedin' ),
                            array( 'name' => __('Youtube','parquecv'), 'theme_mode' => 'parquecv_youtube','icon' => 'fa-youtube' ),
                            array( 'name' => __('Tumblr','parquecv'), 'theme_mode' => 'parquecv_tumblr','icon' => 'fa-tumblr' ),
                            array( 'name' => __('Instagram','parquecv'), 'theme_mode' => 'parquecv_instagram','icon' => 'fa-instagram' ),
                            array( 'name' => __('Flickr','parquecv'), 'theme_mode' => 'parquecv_flickr','icon' => 'fa-flickr' ),
                            array( 'name' => __('Vimeo','parquecv'), 'theme_mode' => 'parquecv_vimeo','icon' => 'fa-vimeo-square' ),
                            array( 'name' => __('RSS','parquecv'), 'theme_mode' => 'parquecv_rss','icon' => 'fa-rss' )
                      );


  for ($row = 0; $row < 11; $row++)
  {
     
      if (get_theme_mod( $social_networks[$row]["theme_mode"])): ?>
         <a href="<?php echo esc_url( get_theme_mod($social_networks[$row]['theme_mode']) ); ?>" class="social-tw" title="<?php echo esc_url( get_theme_mod( $social_networks[$row]['theme_mode'] ) ); ?>" target="_blank">
          <i class="fa <?php echo $social_networks[$row]['icon']; ?>"></i> 
        </a>
      <?php endif;
  }

  if(get_theme_mod('parquecv_email')): ?>
        <a href="mailto:<?php echo esc_attr(get_theme_mod('parquecv_email')); ?>" class="social-tw" title="<?php echo esc_attr( get_theme_mod('parquecv_email')); ?>" target="_blank">
          <i class="fa fa-envelope"></i> 
        </a>
  <?php endif;                        
}

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/library/class/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'parquecv_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to parquecv_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into parquecv_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function parquecv_register_required_plugins() {
 
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
 
 
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => __('WP Gallery Custom Links','parquecv'),
            'slug'      => 'wp-gallery-custom-links',
            'required'  => false,
        ),

        array(
            'name'      => __('Instagram Feed','parquecv'),
            'slug'      => 'instagram-feed',
            'required'  => false,
        ),

    );
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
    'id'           => 'parquecv',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
  );
 
    tgmpa( $plugins, $config );
 
}