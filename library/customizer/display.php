<?php

/**
* Apply Color Scheme
*/

  function parquecv_apply_color() {

  if( get_theme_mod('parquecv_color_settings') ){
    $color_one = esc_html( get_theme_mod('parquecv_color_settings') );
  } else{
    $color_one = '#e53748';
  }

  if( get_theme_mod('parquecv_color_settings_2') ){
    $color_two = esc_html( get_theme_mod('parquecv_color_settings_2') );
  } else{
    $color_two = '#3aa0a2';
  }
 
  $custom_css = "
  a,
  .blog-list .item .meta-cat a, 
  article.post .meta-cat a,
  .blog-list .item a.excerpt-read-more,
  .scrollToTop span,
  nav[role='navigation'] .nav > li.current_page_item > a,
  .slide-copy-wrap a:hover, .slide-copy-wrap a:focus{
  color: {$color_one};
  }
  button, 
  html input[type='button'], 
  input[type='reset'], 
  input[type='submit'],
  .ias-trigger a,
  .nav li ul.children, 
  .nav li ul.sub-menu,
  nav[role='navigation'] .nav li ul li a,
  #submit, .blue-btn, .comment-reply-link,
  .widget #wp-calendar caption,
  .slide-copy-wrap .more-link,
  .gallery .gallery-caption,
  #submit:active, #submit:focus, #submit:hover, .blue-btn:active, .blue-btn:focus, .blue-btn:hover, .comment-reply-link:active, .comment-reply-link:focus, .comment-reply-link:hover{
  background: {$color_one};
  }
  .ias-trigger a,
  #submit, .blue-btn, .comment-reply-link,
  .scrollToTop{
  border: 1px solid {$color_one};
  }
  #top-area .opacity-overlay{
  border-bottom: 1px solid {$color_one};
  }
  .opacity-overlay,
  footer.footer[role='contentinfo']{
  background: {$color_two};
  }
  .blog-list .item h2, .blog-list .widget-item h2, article.post h2.post-title, h2.post-title,
  .blog-list .item a, .blog-list .widget-item a, article.post h2.post-title a,
  .related-posts .section-title, #reply-title, body #comments-title,
  body .sidebar .widget .widgettitle, .item.widget .widgettitle{
  color: {$color_two};
  }";

  wp_enqueue_style( 'parquecv-stylesheet', get_template_directory_uri() . '/library/css/style.min.css', array(), '', 'all' );
  
  wp_enqueue_style( 'parquecv-main-stylesheet', get_stylesheet_uri(), array(), '', 'all' );
 
  wp_add_inline_style( 'parquecv-main-stylesheet', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'parquecv_apply_color', 999 );