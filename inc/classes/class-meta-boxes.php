<?php 
/**
 * Add custom meta boxes
 * 
 * @package Aquila
 */ 

 namespace AQUILA_THEME\Inc;
 
 use AQUILA_THEME\Inc\Traits\Singleton;
 
 class Meta_Boxes {
    use Singleton;
    
    protected function __construct() {
        // load classes
        $this->setup_hooks();     
    }
    
    public function setup_hooks() {
        add_action('add_meta_boxes',  [$this, 'add_custom_meta_boxes']);
        add_action('save_post', [$this, 'save_post_meta_data']);
    }

    public function add_custom_meta_boxes() {
        $screens = ['post'];
        foreach($screens as $screen) {
            add_meta_box(
                'hide-page-title',
                __('Hide page title', 'Aquila'),
                [$this, 'custom_meta_boxes'],
                $screen,
                'side'
            );
        }
    }

    public function custom_meta_boxes($post) {
        $value = get_post_meta($post->ID, '_hide_page_title', true);
        wp_nonce_field(plugin_basename(__FILE__), 'hide_title_metabox_nonce');
        ?>
        <label for="aquila-field"><?php esc_html_e('Hide page title'); ?></label>
        <select name="aquila_hide_title_field" id="aquila-field" class="postbox">
            <option value=""><?php esc_html_e('Select', 'Aquila') ?></option>
            <option value="yes" <?php selected($value, 'yes') ?> ><?php esc_html_e('Yes', 'Aquila') ?></option>
            <option value="no" <?php selected($value, 'no') ?> ><?php esc_html_e('No', 'Aquila') ?></option>
        </select>
        <?php
    }

    public function save_post_meta_data($post_id) {
        /**
         * we get $_POST variable when the post is created or updatedd
         * Use it to check if the current user is authorized to perform that action
         */

        if(!current_user_can('edit_post', $post_id)) {
            return;
        }

        /**
         * Verify is the nonce received is valid
         */

        if(!isset($_POST['hide_title_metabox_nonce']) || !wp_verify_nonce($_POST['hide_title_metabox_nonce'], plugin_basename(__FILE__))) {
            return;
        }
        
        if(array_key_exists('aquila_hide_title_field', $_POST)) {
            update_post_meta(
                $post_id,
                '_hide_page_title',
                $_POST['aquila_hide_title_field']
            );
        }
    }
 }