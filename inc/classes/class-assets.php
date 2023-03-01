<?php /**
 * Load theme Assets
 * 
 * @package Aquila
 */

 namespace AQUILA_THEME\Inc;
 
 use AQUILA_THEME\Inc\Traits\Singleton;
 
 class Assets {
    
    use Singleton;
    
    public function __construct() {
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        // add actions and filters

        add_action('wp_enqueue_scripts', [$this, 'register_styles']);
        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
    }

    function register_styles()
    {
        // register styles
        wp_register_style('style-css', get_stylesheet_uri(), [], filemtime(AQUILA_DIR_PATH . '/style.css'), "all");
        wp_register_style('bootstrap-css', AQUILA_DIR_URI . '/assets/src/library/css/bootstrap.min.css', [], false, 'all');

        // Enqueue styles
        wp_enqueue_style('style-css');
        wp_enqueue_style('bootstrap-css');
    }

    function register_scripts()
    {
        // register scripts
        wp_register_script("main-js", AQUILA_DIR_URI . '/assets/main.js', [], filemtime(get_template_directory() . '/assets/main.js'), true);
        wp_register_script('bootstrap-js', AQUILA_DIR_URI . '/assets/src/library/js/bootstrap.bundle.min.js', ['jquery'], false, true);

        // Enqueue scripts
        wp_enqueue_script('main-js');
        wp_enqueue_script('bootstrap-js');
    }
 }