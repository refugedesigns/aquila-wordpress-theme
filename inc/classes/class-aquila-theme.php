<?php 
/**
 * Boostrap the theme
 * 
 * @package Aquila
 */ 

 namespace AQUILA_THEME\Inc;
 
 use AQUILA_THEME\Inc\Traits\Singleton;
 
 class AQUILA_THEME {
    use Singleton;
    
    protected function __construct() {
        // load classes
        Assets::get_instance();
        Menus::get_instance();
        Meta_Boxes::get_instance();
        $this->setup_hooks();     
    }
    
    public function setup_hooks() {
        add_action('after_setup_theme',  [$this, 'theme_setup']);
    }

    public function theme_setup() {
        add_theme_support('title-tag');

        add_theme_support('custom-logo', [
            'header-text' => ['site-title', 'site-description'],
            'height' => 100,
            'width' => 400,
            'flex-height' => true,
            'flex-width' => true,
        ]);

        add_theme_support('custom-background', [
            'background-color' => '#ffffff',
            'default-image' => '',
        ]);

        add_theme_support('post-thumbnails');

        //Register image size 
        add_image_size('featured_thumbnail', 350, 233, true);

        add_theme_support('customize-selective-refresh-widgets');
        
        add_theme_support('automatic-feed-links');
        
        add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style']);

        add_theme_support('wp-block-styles');

        add_theme_support('align-wide');
    }
 }