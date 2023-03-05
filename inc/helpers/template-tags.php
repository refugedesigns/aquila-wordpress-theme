<?php

function get_the_post_custom_thumbnail($post_id, $size="featured_large", $additional_attributes=[]) {
    if($post_id === null) {
        $post_id = get_the_ID();
    }

    if(has_post_thumbnail($post_id)) {
        
        $custom_thumbnail = wp_get_attachment_image(
            get_post_thumbnail_id($post_id),
            $size,
            false,
            $additional_attributes
        );
    }

    return $custom_thumbnail;
}

function the_post_custom_thumbnail($post_id, $size="featured_large", $additional_attributes=[]) {
    echo get_the_post_thumbnail($post_id, $size, $additional_attributes);
}