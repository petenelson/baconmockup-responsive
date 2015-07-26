<?php


class Theme_Bacon_Mockup {

	static public $VERSION = '2015-03-08-01';


	function __construct() {

		add_action( 'init', array(&$this, 'init') );
		add_action( 'wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts') );
		add_filter('body_class', array(&$this, 'theme_body_class') );

	}


	function init() {
		remove_action( 'wp_head', 'wp_generator');
		remove_action( 'wp_head', 'feed_links', 2 ); 
		remove_action( 'wp_head', 'feed_links_extra', 3 ); 
		remove_action( 'wp_head', 'rsd_link'); // EditURI
		remove_action( 'wp_head', 'wlwmanifest_link');  // Windows Live Writer
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // pagination, rel='next' or rel='prev'
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

		add_action('login_head', array(&$this, 'custom_login_logo') );
		add_filter('login_headerurl', array(&$this, 'url_login') );
	}

	function wp_enqueue_scripts() {
		wp_enqueue_style( 'baconmockup-custom', get_bloginfo('template_url') . '/style.css', array(), Theme_Bacon_Mockup::$VERSION );
	}


	function theme_body_class($classes) {
	 
		$body_classes = get_post_meta(get_the_id(), 'body-class');

		if (isset($body_classes) && is_array($body_classes) && count($body_classes) > 0)
			$classes = array_merge($classes, $body_classes);
	 
		return $classes;
	}

	function custom_login_logo() {
		echo '<style type="text/css">
	    h1 a { background-image:url('.get_stylesheet_directory_uri().'/img/logo-login-274-63.png) !important; }
	    </style>';
	}

	function url_login(){
		return get_bloginfo( 'wpurl' );
	}


}


new Theme_Bacon_Mockup();
