<?php

/*******************************************************************
* These are settings for the Theme Customizer in the admin panel. 
*******************************************************************/
if ( ! function_exists( 'parquecv_theme_customizer' ) ) :
  function parquecv_theme_customizer( $wp_customize ) {
  
    /* color scheme option */
    $wp_customize->add_setting( 'parquecv_color_settings', array (
      'default' => '#e53748',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'parquecv_color_settings', array(
      'label'    => __( 'Theme Accent Color 1', 'parquecv' ),
      'section'  => 'colors',
      'settings' => 'parquecv_color_settings',
    ) ) );

    $wp_customize->add_setting( 'parquecv_color_settings_2', array (
      'default' => '#3aa0a2',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'parquecv_color_settings_2', array(
      'label'    => __( 'Theme Accent Colo 2', 'parquecv' ),
      'section'  => 'colors',
      'settings' => 'parquecv_color_settings_2',
    ) ) );
    
    /* social media option */
    $wp_customize->add_section( 'parquecv_social_section' , array(
      'title'       => __( 'Social Media Icons', 'parquecv' ),
      'priority'    => 32,
      'description' => __( 'Optional media icons in the header', 'parquecv' ),
    ) );
    
    $wp_customize->add_setting( 'parquecv_facebook', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );

    /* author bio in posts option */
    $wp_customize->add_section( 'parquecv_posts_section' , array(
      'title'       => __( 'Post Settings', 'parquecv' ),
      'priority'    => 35,
      'description' => ''
    ) );

    $wp_customize->add_setting( 'parquecv_related_posts', array (
      'sanitize_callback' => 'parquecv_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('related_posts', array(
      'settings' => 'parquecv_related_posts',
      'label' => __('Disable the Related Posts?', 'parquecv'),
      'section' => 'parquecv_posts_section',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'parquecv_author_area', array (
      'sanitize_callback' => 'parquecv_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('author_info', array(
      'settings' => 'parquecv_author_area',
      'label' => __('Disable the Author Information?', 'parquecv'),
      'section' => 'parquecv_posts_section',
      'type' => 'checkbox',
    ));
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_facebook', array(
      'label'    => __( 'Enter your Facebook url', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_facebook',
      'priority'    => 101,
    ) ) );
  
    $wp_customize->add_setting( 'parquecv_twitter', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_twitter', array(
      'label'    => __( 'Enter your Twitter url', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_twitter',
      'priority'    => 102,
    ) ) );
    
    $wp_customize->add_setting( 'parquecv_google', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_google', array(
      'label'    => __( 'Enter your Google+ url', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_google',
      'priority'    => 103,
    ) ) );
    
    $wp_customize->add_setting( 'parquecv_pinterest', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_pinterest', array(
      'label'    => __( 'Enter your Pinterest url', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_pinterest',
      'priority'    => 104,
    ) ) );
    
    $wp_customize->add_setting( 'parquecv_linkedin', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_linkedin', array(
      'label'    => __( 'Enter your Linkedin url', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_linkedin',
      'priority'    => 105,
    ) ) );
    
    $wp_customize->add_setting( 'parquecv_youtube', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_youtube', array(
      'label'    => __( 'Enter your Youtube url', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_youtube',
      'priority'    => 106,
    ) ) );
    
    $wp_customize->add_setting( 'parquecv_tumblr', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_tumblr', array(
      'label'    => __( 'Enter your Tumblr url', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_tumblr',
      'priority'    => 107,
    ) ) );
    
    $wp_customize->add_setting( 'parquecv_instagram', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_instagram', array(
      'label'    => __( 'Enter your Instagram url', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_instagram',
      'priority'    => 108,
    ) ) );
    
    $wp_customize->add_setting( 'parquecv_flickr', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_flickr', array(
      'label'    => __( 'Enter your Flickr url', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_flickr',
      'priority'    => 109,
    ) ) );
    
    $wp_customize->add_setting( 'parquecv_vimeo', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_vimeo', array(
      'label'    => __( 'Enter your Vimeo url', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_vimeo',
      'priority'    => 110,
    ) ) );
    
    $wp_customize->add_setting( 'parquecv_rss', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_rss', array(
      'label'    => __( 'Enter your RSS url', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_rss',
      'priority'    => 112,
    ) ) );
    
    $wp_customize->add_setting( 'parquecv_email', array (
      'sanitize_callback' => 'sanitize_email',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_email', array(
      'label'    => __( 'Enter your email address', 'parquecv' ),
      'section'  => 'parquecv_social_section',
      'settings' => 'parquecv_email',
      'priority'    => 113,
    ) ) );

   /* slider options */
    
    $wp_customize->add_section( 'parquecv_slider_section' , array(
      'title'       => __( 'Slider Settings', 'parquecv' ),
      'priority'    => 33,
      'description' => __( 'Adjust the behavior of the image slider.', 'parquecv' ),
    ) );

    $wp_customize->add_setting( 'parquecv_slider_area', array (
      'sanitize_callback' => 'parquecv_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('slider_area', array(
      'settings' => 'parquecv_slider_area',
      'label' => __('Disable home page slider?', 'parquecv'),
      'section' => 'parquecv_slider_section',
      'type' => 'checkbox',
    ));
    
    $wp_customize->add_setting( 'parquecv_slider_effect', array(
      'default' => __('scrollHorz','parquecv'),
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control( 'effect_select_box', array(
      'settings' => 'parquecv_slider_effect',
      'label' => __( 'Select Effect:', 'parquecv' ),
      'section' => 'parquecv_slider_section',
      'type' => 'select',
      'choices' => array(
        'scrollHorz' => __('Horizontal (Default)','parquecv'),
        'scrollVert' => __('Vertical','parquecv'),
        'tileSlide' => __('Tile Slide','parquecv'),
        'tileBlind' => __('Blinds','parquecv'),
        'shuffle' => __('Shuffle','parquecv'),
      ),
    ));

    $cat_array = array();

    $categories = get_categories( array(
        'orderby' => 'name'
    ) );
    foreach ( $categories as $category ) {
      
      $cat_array[esc_html( $category->slug )] = esc_html( $category->name );
      
    } 

    $wp_customize->add_setting( 'parquecv_slider_cat', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control( 'cat_select_box', array(
      'settings' => 'parquecv_slider_cat',
      'label' => __( 'Select A Category:', 'parquecv' ),
      'section' => 'parquecv_slider_section',
      'type' => 'select',
      'choices' => $cat_array
    ));
    
    $wp_customize->add_setting( 'parquecv_slider_timeout', array (
      'sanitize_callback' => 'parquecv_sanitize_integer',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'parquecv_slider_timeout', array(
      'label'    => __( 'Autoplay Speed in Seconds', 'parquecv' ),
      'section'  => 'parquecv_slider_section',
      'settings' => 'parquecv_slider_timeout',
    ) ) );
    
  
  }
endif;
add_action('customize_register', 'parquecv_theme_customizer');

/**
 * Sanitize checkbox
 */
if ( ! function_exists( 'parquecv_sanitize_checkbox' ) ) :
  function parquecv_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
      return 1;
    } else {
      return '';
    }
  }
endif;


/**
 * Sanitize integer input
 */
if ( ! function_exists( 'parquecv_sanitize_integer' ) ) :
  function parquecv_sanitize_integer( $input ) {
    return absint($input);
  }
endif;